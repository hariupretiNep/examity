<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreQuestionSectionRequest;
use App\Http\Requests\UpdateQuestionSectionRequest;
use App\Models\QuestionSection;

class QuestionSectionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreQuestionSectionRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreQuestionSectionRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\QuestionSection  $questionSection
     * @return \Illuminate\Http\Response
     */
    public function show(QuestionSection $questionSection)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\QuestionSection  $questionSection
     * @return \Illuminate\Http\Response
     */
    public function edit(QuestionSection $questionSection)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateQuestionSectionRequest  $request
     * @param  \App\Models\QuestionSection  $questionSection
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateQuestionSectionRequest $request, QuestionSection $questionSection)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\QuestionSection  $questionSection
     * @return \Illuminate\Http\Response
     */
    public function destroy(QuestionSection $questionSection)
    {
        //
    }
}
