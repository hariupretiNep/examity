<?php

namespace App\Http\Controllers\Modules;

use Inertia\Inertia;
use App\Models\Question;
use App\Models\QuestionSection;
use App\Jobs\ProcessExamityEmail;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Modules\Questionnaire;
use App\Models\QuestionnaireQuestions;
use App\Http\Requests\UpdateQuestionnaireRequest;
use App\Http\Requests\Modules\Questionnaire\StoreQuestionnaireRequest;

class QuestionnaireController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $activeQuestionnaire = Questionnaire::where("expiry_date",">=",date("Y-m-d H:i:s"))->get();
        return Inertia::render('Questionnaire/List',["activeQuestionnaires"=>$activeQuestionnaire]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Inertia::render('Questionnaire/Add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreQuestionnaireRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreQuestionnaireRequest $request)
    {
        $formatedExpiryDate = date("Y-m-d H:i:s",strtotime($request->expiry_date));
        $newQuestionnaire = new Questionnaire();
        $newQuestionnaire->title = $request->title;
        $newQuestionnaire->expiry_date = $formatedExpiryDate;
        if($newQuestionnaire->save()){
            //Generate random 10 questions
            $randomQuestions = new Questionnaire();
            $recordStatus = $randomQuestions->generateRandomQuestions($newQuestionnaire);
            if($recordStatus){
                //Start sending invition link to student
                dispatch(new ProcessExamityEmail($newQuestionnaire));
                return redirect(route('questionnaire'))->with("success","Questionnaire generated successfully");
            }else{
                return redirect(route('questionnaire'))->with("failed","Unable to generate questionnaire");
            }
        }else{
            return redirect(route('questionnaire'))->with("failed","Questionnaire could not be created");
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Modules\Questionnaire  $questionnaire
     * @return \Illuminate\Http\Response
     */
    public function show(Questionnaire $questionnaire)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Modules\Questionnaire  $questionnaire
     * @return \Illuminate\Http\Response
     */
    public function edit(Questionnaire $questionnaire)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateQuestionnaireRequest  $request
     * @param  \App\Models\Modules\Questionnaire  $questionnaire
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateQuestionnaireRequest $request, Questionnaire $questionnaire)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Modules\Questionnaire  $questionnaire
     * @return \Illuminate\Http\Response
     */
    public function destroy(Questionnaire $questionnaire)
    {
        //
    }
}
