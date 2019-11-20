<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Http\Requests\StoreOrder;
use App\Http\Resources\Order as OrderResource;
use App\Http\Resources\Payment as PaymentResource;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the orders.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $validated = $request->validate([
            'delivered' => 'sometimes|boolean'
        ]);
        $order = new Order();
        $dbQuery = $order->newQuery();

        isset($validated['delivered']) && $dbQuery->where('delivered', $validated['delivered']);

        $queryString = $request->query();
        $orders = $dbQuery->paginate(15)->appends($queryString);
        $ordersResource = OrderResource::collection($orders);

        return response($ordersResource->toJson(), 200)
            ->header('Content-Type', 'application/json');
    }

    public function indexPayments(Order $order)
    {
        $payments = $order->payments();

        $paymentResource = PaymentResource::collection($payments->paginate(15));

        return response($paymentResource->toJson(), 200)
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
        $validated =  $request->validated();
        $order = Order::create($validated);
        $orderResource = new OrderResource($order);

        return response($orderResource->toJson(), 200)
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
        $orderResource = new OrderResource($order);

        return response($orderResource->toJson(), 200)
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
        $validated = $request->validated();
        $order->fill($validated);
        $order->save();
        $orderResource = new OrderResource($order);

        return response($orderResource->toJson, 200)
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
