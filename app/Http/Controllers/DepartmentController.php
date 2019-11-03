<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Http\Resources\Department as DepartmentResource;
use App\Http\Resources\Requisition as RequisitionResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the departments.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $departments = Department::paginate(15);
        $departmentsResource = DepartmentResource::collection($departments);

        return response($departmentsResource->toJson(), 200)
            ->header('Content-Type', 'application/json');
    }

    /**
     * Display a listing of the requisitions under the department.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexRequisitions(Request $request, Department $department)
    {
        $dbQuery = $department->requisitions();

        $validated = $request->validate([
            'summary' => 'sometimes|boolean',
            'fields' => 'sometimes|fieldsIn:id,items,department_id,created_at,status,order_id',
            'status' => 'sometimes|in:waiting,rejected,approved,assigned,delivered'
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
     * Store a newly created department in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|unique:departments|max:255'
        ]);
        $department = Department::create($validated);
        $departmentResource = new DepartmentResource($department);

        return response($departmentResource->toJson(), 200)
            ->header('Content-Type', 'application/json');
    }

    /**
     * Display the specified department.
     *
     * @param  \App\Models\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function show(Department $department)
    {
        $departmentResource = new DepartmentResource($department);

        return response($departmentResource->toJson(), 200)
            ->header('Content-Type', 'application/json');
    }

    /**
     * Update the specified department in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Department $department)
    {
        $validated = $request->validate([
            'name' => 'required|unique:departments|max:255'
        ]);
        $department->name = $validated['name'];
        $department->save();
        $departmentResource = new DepartmentResource($department);

        return response($departmentResource->toJson(), 200)
            ->header('Content-Type', 'application/json');
    }

    /**
     * Remove the specified department from storage.
     *
     * @param  \App\Models\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function destroy(Department $department)
    {
        $department->delete();
        return response('', 200);
    }
}
