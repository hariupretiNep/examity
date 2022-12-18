<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Modules\QuestionnaireController;

Route::prefix('/questionnaire')->group(function () {
    Route::get('/',[QuestionnaireController::class,'index'])->name("questionnaire");
    Route::get('/new',[QuestionnaireController::class,'create'])->name("addQuestionnaire");
    Route::post('/add',[QuestionnaireController::class,'store'])->name("createQuestionnaire");
});