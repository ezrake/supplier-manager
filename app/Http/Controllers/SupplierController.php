<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSupplier;
use App\Models\Supplier;
use App\Http\Resources\Supplier as SupplierResource;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $suppliers = Supplier::paginate(15);
        $suppliers = SupplierResource::collection($suppliers);

        return response($suppliers->toJson(), 200)
            ->header('Content-Type', 'application/json');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate();
        $supplier = Supplier::create($validated);
        $supplier = new SupplierResource($supplier);

        return response($supplier->toJson(), 200)
            ->header('Content-Type', 'application/json');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function show(Supplier $supplier)
    {
        $supplier = new SupplierResource($supplier);

        return response($supplier->toJson(), 200)
            ->header('Content-Type', 'application/json');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\StoreSupplier  $request
     * @param  \App\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function update(StoreSupplier $request, Supplier $supplier)
    {
        $validated = $request->validate();
        $supplier->fill($validated);
        $supplier->save();
        $supplier = new SupplierResource($supplier);

        return response($supplier->toJson(), 200)
            ->header('Content-Type', 'application/json');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function destroy(Supplier $supplier)
    {
        $supplier->delete();
        return response('', 200);
    }
}
