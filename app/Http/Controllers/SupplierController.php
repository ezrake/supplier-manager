<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSupplier;
use App\Models\Supplier;
use App\Http\Resources\Supplier as SupplierResource;

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
        $suppliers = SupplierResource::collection($suppliers);

        return response($suppliers->toJson(), 200)
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
        $supplier = new SupplierResource($supplier);

        return response($supplier->toJson(), 200)
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
        $supplier = new SupplierResource($supplier);

        return response($supplier->toJson(), 200)
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
        $supplier = new SupplierResource($supplier);

        return response($supplier->toJson(), 200)
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
