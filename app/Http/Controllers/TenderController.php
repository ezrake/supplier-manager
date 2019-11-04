<?php

namespace App\Http\Controllers;

use App\Models\Tender;
use App\Http\Resources\Tender as TenderResource;
use App\Http\Requests\StoreTender;
use App\Http\Resources\Payments as PaymentResource;
use App\Http\Resources\Orders as OrderResource;
use Illuminate\Http\Request;

class TenderController extends Controller
{
    /**
     * Display a listing of the tenders.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tenders = Tender::paginate(15);
        $tendersResource = TenderResource($tenders);

        return response($tendersResource->toJson(), 200)
            ->header('Content-Type', 'application/json');
    }

    public function indexOrders(Request $request, Tender $tender)
    {
        $validated = $request->validate([
            'include' => 'sometimes|in:deleted',
            'delivered' => 'sometimes|boolean'
        ]);
        $orders = $tender->orders();

        isset($validated['include']) && $orders->withTrashed();
        isset($validated['delivered']) && $orders->where('delivered', $validated['delivered']);

        $queryString = $request->query();
        $orderResource = OrderResource::collection(
            $orders->paginate(15)->appends($queryString)
        );

        return response($orderResource->toJson(), 200)
            ->header('Content-Type', 'application/json');
    }

    public function indexPayments(Tender $tender)
    {
        $payments = $tender->payments();
        $paymentResource = PaymentResource::collection($payments->paginate(15));

        return response($paymentResource->toJson(), 200)
            ->header('Content-Type', 'application/json');
    }

    /**
     * Store a newly created tender in storage.
     *
     * @param  \App\Http\Requests\StoreTender  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTender $request)
    {
        $validated = $request->validated();
        $tender = Tender::create($validated);
        $tenderResource = new TenderResource($tender);

        return response($tenderResource->toJson(), 200)
            ->header('Content-Type', 'application/json');
    }

    /**
     * Display the specified tender.
     *
     * @param  \App\Models\Tender  $tender
     * @return \Illuminate\Http\Response
     */
    public function show(Tender $tender)
    {
        $tenderResource = new TenderResource($tender);

        return response($tenderResource->toJson(), 200)
            ->header('Content-Type', 'application/json');
    }

    /**
     * Update the tender resource in storage.
     *
     * @param  \App\Http\Requests\StoreTender  $request
     * @param  \App\Models\Tender  $tender
     * @return \Illuminate\Http\Response
     */
    public function update(StoreTender $request, Tender $tender)
    {
        $validated = $request->validated();
        $tender->fill($validated);
        $tender->save();
        $tenderResource = new TenderResource($tender);

        return response($tenderResource->toJson(), 200)
            ->header('Content-Type', 'application/json');
    }

    /**
     * Remove the specified tender from storage.
     *
     * @param  \App\Models\Tender  $tender
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tender $tender)
    {
        $tender->delete();
        return response('', 200);
    }
}
