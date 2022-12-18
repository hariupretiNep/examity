<?php

namespace App\Models\Modules;

use App\Models\Question;
use Illuminate\Support\Facades\DB;
use App\Models\QuestionnaireQuestions;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Questionnaire extends Model
{
    use HasFactory;

    public function questions(){
        return $this->belongsToMany(Question::class,'questionnaire_questions','questionnaire_id','question_id');
    }

    public function generateRandomQuestions(Questionnaire $newQuestionnaire){
        $latestQuestionnaireId = $newQuestionnaire->id;
        //List 10 random questions, 5 from physics and 5 from Chemistry
        $randomQuestions = DB::select(DB::raw("WITH random10Questions as (SELECT qs.id,q.que_sec_id,q.id as question_id,q.question, ROW_NUMBER() 
        over(PARTITION by que_sec_id ORDER by RAND()) as section_wise_questions from questions q left join question_sections qs on q.que_sec_id = qs.id
        where qs.name like '%physics%' or qs.name like '%chemistry%') SELECT * FROM random10Questions where section_wise_questions <= 5"));

        $questionnaireQuestions = [];
        if(!empty($randomQuestions)){
            foreach ($randomQuestions as $eachQuestion) {
                $questionnaireQuestions[] = ["questionnaire_id"=>$latestQuestionnaireId,"question_id"=>$eachQuestion->question_id,"created_at"=>date("Y-m-d H:i:s")];
            }
        }
        return QuestionnaireQuestions::insert($questionnaireQuestions);
    }

}
