<?php

namespace App\Http\Controllers;

use App\Models\Requisition;
use App\Http\Resources\Requisition as RequisitionResource;
use App\Http\Requests\StoreRequisition;

class RequisitionController extends Controller
{
    /**
     * Display a listing of the requisitions.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $requisitions = Requisition::paginate(15);
        $requisitions = RequisitionResource::collection($requisitions);

        return response($requisitions->toJson(), 200)
            ->header('Content-Type', 'application/json');
    }

    /**
     * Store a newly created requisition in storage.
     *
     * @param  \App\Http\Requests\StoreRequisition  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequisition $request)
    {
        $validated = $request->validate();
        $requisition = Requisition::create($validated);
        $requisition = new RequisitionResource($requisition);

        return response($requisition->toJson(), 200)
            ->header('Content-Type', 'application/json');
    }

    /**
     * Display the specified requisition.
     *
     * @param  \App\Models\Requisition  $requisition
     * @return \Illuminate\Http\Response
     */
    public function show(Requisition $requisition)
    {
        $requisition = new RequisitionResource($requisition);

        return response($requisition->toJson(), 200)
            ->header('Content-Type', 'application/json');
    }

    /**
     * Update the specified requisition in storage.
     *
     * @param  \App\Http\Requests\StoreRequisition  $request
     * @param  \App\Models\Requisition  $requisition
     * @return \Illuminate\Http\Response
     */
    public function update(StoreRequisition $request, Requisition $requisition)
    {
        $validated = $request->validate();
        $requisition->fill($validated);
        $requisition->save();
        $requisition = new RequisitionResource($requisition);

        return response($requisition->toJson(), 200)
            ->header('Content-Type', 'application/json');
    }

    /**
     * Remove the specified requisition from storage.
     *
     * @param  \App\Models\Requisition  $requisition
     * @return \Illuminate\Http\Response
     */
    public function destroy(Requisition $requisition)
    {
        $requisition->delete();
        return response('', 200);
    }
}
