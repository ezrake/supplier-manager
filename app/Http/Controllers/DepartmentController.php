<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Http\Resources\Department as DepartmentResource;
use Illuminate\Http\Request;

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
        $departments = DepartmentResource::collection($departments);

        return response($departments->toJson(), 200)
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
        $department = new DepartmentResource($department);

        return response($department->toJson(), 200)
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
        $department = new DepartmentResource($department);

        return response($department->toJson(), 200)
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
        $department = new DepartmentResource($department);

        return response($department->toJson(), 200)
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
