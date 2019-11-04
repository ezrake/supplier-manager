<?php

namespace App\Http\Controllers;

use App\Models\Requisition;
use App\Http\Resources\Requisition as RequisitionResource;
use App\Http\Requests\StoreRequisition;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RequisitionController extends Controller
{
    /**
     * Display a listing of the requisitions.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $requisition = new Requisition();
        $dbQuery = $requisition->newQuery();

        $validated = $request->validate([
            'summary' => 'sometimes|boolean',
            'fields' => 'sometimes|fieldsIn:id,items,department_id,created_at,updated_at,status,order_id',
            'status' => 'sometimes|in:waiting,rejected,approved,assigned,delivered',
        ]);

        if (isset($validated['summary']) && $validated['summary']) {
            $dbQuery->addSelect(DB::raw('status, count(*) as amount'));
            $requisitionSummary = $dbQuery->groupBy('status')->get();

            return response(json_encode($requisitionSummary), 200)
                ->header('Content-Type', 'application/json');
        }
        //Add columns and status to  database query if they exist in query string
        isset($validated['fields']) && $dbQuery->addSelect(explode(',', $validated['fields']));
        isset($validated['status']) && $dbQuery->where('status', $validated['status']);

        $queryString = $request->query();
        $requisitions = $dbQuery->paginate(10)->appends($queryString);
        $requisitionsResource = RequisitionResource::collection($requisitions);

        return response($requisitionsResource->toJson(), 200)
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
        $requisitionResource = new RequisitionResource($requisition);

        return response($requisitionResource->toJson(), 200)
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
        $requisitionResource = new RequisitionResource($requisition);

        return response($requisitionResource->toJson(), 200)
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
        $requisitionResource = new RequisitionResource($requisition);

        return response($requisitionResource->toJson(), 200)
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
