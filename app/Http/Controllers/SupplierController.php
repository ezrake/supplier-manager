<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSupplier;
use Illuminate\Http\Request;
use App\Http\Resources\Order as OrderResource;
use App\Models\Supplier;
use App\Http\Resources\Supplier as SupplierResource;
use App\Http\Resources\Tender as TenderResource;

class SupplierController extends Controller
{
    /**
     * Display a listing of the suppliers.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $suppliers = Supplier::paginate(15);
        $suppliersResource = SupplierResource::collection($suppliers);

        return response($suppliersResource->toJson(), 200)
            ->header('Content-Type', 'application/json');
    }

    /**
     * Display a listing of the orders belonging to a supplier.
     *
     * @param \Illuminate\Http\Request
     * @param \App\Models\Supplier
     * @return \Illuminate\Http\Response
     */
    public function indexOrders(Request $request, Supplier $supplier)
    {
        $validated = $request->validate([
            'include' => 'sometimes|in:deleted',
            'delivered' => 'sometimes|boolean',
        ]);
        $orders = $supplier->orders();
        $queryString = $request->query();

        isset($validated['include']) && $orders->withTrashed();
        isset($validated['delivered']) && $orders->where('delivered', $validated['delivered']);

        $ordersResource = OrderResource::collection(
            $orders->paginate(15)->appends($queryString)
        );

        return response($ordersResource->toJson(), 200)
            ->header('Content-Type', 'application/json');
    }

    /**
     * Display the tender belonging to a supplier.
     *
     * @param \Illuminate\Http\Request
     * @param \App\Models\Supplier
     * @return \Illuminate\Http\Response
     */
    public function indexTender(Request $request, Supplier $supplier)
    {
        $validated = $request->validate([
            'include' => 'sometimes|in:orders'
        ]);
        $tender = $supplier->tender();

        if (isset($validated['include']) && $validated['include'] == 'orders') {
            $tender->with('orders');
            $tenderResource = new TenderResource($tender->get());
        } else {
            $queryString = $request->query();
            $tenderResource = new TenderResource($tender->paginate(15)->appends($queryString));
        }

        return response($tenderResource->toJson(), 200)
            ->header('Content-Type', 'application/json');
    }

    public function indexPayments(Supplier $supplier)
    {
        $payments = $supplier->payments()->orderBy('created_at')->paginate(15);
        $paymentResource = PaymentsResource::collection($payments);

        return response($paymentResource->toJson(), 200)
            ->header('Content-Type', 'application/json');
    }

    /**
     * Store a newly created supplier in storage.
     *
     * @param  \App\Http\Requests\StoreSupplier  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSupplier $request)
    {
        $validated = $request->validate();
        $supplier = Supplier::create($validated);
        $supplierResource = new SupplierResource($supplier);

        return response($supplierResource->toJson(), 200)
            ->header('Content-Type', 'application/json');
    }

    /**
     * Display the specified supplier.
     *
     * @param  \App\Models\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function show(Supplier $supplier)
    {
        $supplierResource = new SupplierResource($supplier);

        return response($supplierResource->toJson(), 200)
            ->header('Content-Type', 'application/json');
    }

    /**
     * Update the specified supplier in storage.
     *
     * @param  \App\Http\Requests\StoreSupplier  $request
     * @param  \App\Models\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function update(StoreSupplier $request, Supplier $supplier)
    {
        $validated = $request->validate();
        $supplier->fill($validated);
        $supplier->save();
        $supplierResource = new SupplierResource($supplier);

        return response($supplierResource->toJson(), 200)
            ->header('Content-Type', 'application/json');
    }

    /**
     * Remove the specified supplier from storage.
     *
     * @param  \App\Models\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function destroy(Supplier $supplier)
    {
        $supplier->delete();
        return response('', 200);
    }
}
