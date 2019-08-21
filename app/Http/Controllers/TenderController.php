<?php

namespace App\Http\Controllers;

use App\Models\Tender;
use App\Http\Resources\Tender as TenderResource;
use App\Http\Requests\StoreTender;

class TenderController extends Controller
{
    /**
     * Display a listing of the tenders.
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
     * Store a newly created tender in storage.
     *
     * @param  \App\Http\Requests\StoreTender  $request
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
     * Display the specified tender.
     *
     * @param  \App\Models\Tender  $tender
     * @return \Illuminate\Http\Response
     */
    public function show(Tender $tender)
    {
        $tender = new TenderResource($tender);

        return response($tender->toJson(), 200)
            ->header('Content-Type', 'application/json');
    }

    /**
     * Update the tender resource in storage.
     *
     * @param  \App\Http\Requests\StoreTender  $request
     * @param  \App\Models\Tender  $tender
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
     * Remove the specified tender from storage.
     *
     * @param  \App\Models\Tender  $tender
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tender $tender)
    {
        $tender->delete();
        return response('', 200);
    }
}
