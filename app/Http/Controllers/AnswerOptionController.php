<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAnswerOptionRequest;
use App\Http\Requests\UpdateAnswerOptionRequest;
use App\Models\AnswerOption;

class AnswerOptionController extends Controller
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
     * @param  \App\Http\Requests\StoreAnswerOptionRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAnswerOptionRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\AnswerOption  $answerOption
     * @return \Illuminate\Http\Response
     */
    public function show(AnswerOption $answerOption)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\AnswerOption  $answerOption
     * @return \Illuminate\Http\Response
     */
    public function edit(AnswerOption $answerOption)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateAnswerOptionRequest  $request
     * @param  \App\Models\AnswerOption  $answerOption
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAnswerOptionRequest $request, AnswerOption $answerOption)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\AnswerOption  $answerOption
     * @return \Illuminate\Http\Response
     */
    public function destroy(AnswerOption $answerOption)
    {
        //
    }
}
