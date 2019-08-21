<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Http\Order as OrderResource;
use App\Http\Requests\StoreOrder;

class OrderController extends Controller
{
    /**
     * Display a listing of the orders.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = Order::paginate(15);
        $orders = OrderResource::collection($orders);

        return response($orders->toJson(), 200)
            ->header('Content-Type', 'application/json');
    }

    /**
     * Store a newly created order in storage.
     *
     * @param  \App\Http\Requests\StoreOrder  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreOrder $request)
    {
        $validated =  $request->validate();
        $order = Order::create($validated);
        $order = new OrderResource($order);

        return response($order->toJson(), 200)
            ->header('Content-Type', 'application/json');
    }

    /**
     * Display the specified order.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        $order = new OrderResource($order);

        return response($order->toJson(), 200)
            ->header('Content-Type', 'application/json');
    }

    /**
     * Update the specified order in storage.
     *
     * @param  \App\Http\Requests\StoreOrder  $request
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(StoreOrder $request, Order $order)
    {
        $validated = $request->validate();
        $order->fill($validated);
        $order->save();
        $order = new OrderResource($order);

        return response($order->toJson, 200)
            ->header('Content-Type', 'application/json');
    }

    /**
     * Remove the specified order from storage.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        $order->delete();
        return response('', 200);
    }
}
