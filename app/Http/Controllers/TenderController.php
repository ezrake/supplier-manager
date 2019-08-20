<?php

namespace App\Http\Controllers;

use App\Models\Tender;
use App\Http\Resources\Tender as TenderResource;
use Illuminate\Http\Request;
use App\Http\Requests\StoreTender;

class TenderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tenders = Tender::paginate(15);
        $tenders = TenderResource($tenders);

        return response($tenders->toJson(), 200)
            ->header('Content-Type', 'application/json');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTender $request)
    {
        $validated = $request->validate();
        $tender = Tender::create($validated);
        $tender = new TenderResource($tender);

        return response($tender->toJson(), 200)
            ->header('Content-Type', 'application/json');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Tender  $tender
     * @return \Illuminate\Http\Response
     */
    public function show(Tender $tender)
    {
        $tender = new TenderResource($tender);

        return response($tender->toJson(), 200)
            ->header('Content-Type', 'application/json');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Tender  $tender
     * @return \Illuminate\Http\Response
     */
    public function update(StoreTender $request, Tender $tender)
    {
        $validated = $request->validate();
        $tender->fill($validated);
        $tender->save();
        $tender = new TenderResource($tender);

        return response($tender->toJson(), 200)
            ->header('Content-Type', 'application/json');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Tender  $tender
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tender $tender)
    {
        $tender->delete();
        return response('', 200);
    }
}
