<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Http\Resources\Payments as PaymentResource;
use Illuminate\Http\StorePayments;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $payments = Payment::paginate(15);
        $payments = PaymentResource::collection($payments);

        return response($payments->toJson(), 200)
            ->header('Content-Type', 'application/json');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\StorePayments  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePayments $request)
    {
        $validated = $request->validate();
        $payment = Payment::create($validated);
        $payment = new PaymentResource($payment);

        return response($payment->toJson(), 200)
            ->header('Content-Type', 'application/json');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function show(Payment $payment)
    {
        $payment = new PaymentResource($payment);

        return response($payment->toJson(), 200)
            ->header('Content-Type', 'application/json');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\StorePayments  $request
     * @param  \App\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function update(StorePayments $request, Payment $payment)
    {
        $validated = $request->validate();
        $payment->fill($validated);
        $payment->save();
        $payment = new PaymentResource($payment);

        return response($payment->toJson(), 200)
            ->header('Content-Type', 'application/json');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Payment $payment)
    {
        $payment->delete();
        return response('', 200);
    }
}
