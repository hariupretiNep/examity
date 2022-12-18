<?php

namespace App\Http\Controllers\Modules;

use Inertia\Inertia;
use App\Models\AnswerOption;
use Illuminate\Http\Request;
use App\Models\QuestionSection;
use App\Models\StudentInvitation;
use App\Http\Controllers\Controller;
use App\Models\Modules\Questionnaire;

class InvitationController extends Controller
{
    public function accessInvitation($invitationCode){
        $getInvitationDetail = StudentInvitation::where("invitation_code",$invitationCode)->with("student")->first();
        if(!empty($getInvitationDetail)){
            if($getInvitationDetail->used == 1){
                die("You are not allowed to access the test more then one time");
            }else{
                //Proceed student for the online examination
                $finalData = [];
                $studentDetail = $getInvitationDetail->student;
                $questionnaireDetail = $getInvitationDetail->questionnaire;
                if(!empty($studentDetail) && !empty($questionnaireDetail)){
                    //get the list of questions
                    $questionnaireWithQuestions = Questionnaire::with("questions")->findOrFail($questionnaireDetail->id);
                    $finalData["questionnaire"] = ["title"=>$questionnaireWithQuestions->title,"id"=>$questionnaireWithQuestions->id,"expiry_date"=>$questionnaireWithQuestions->expiry_date];
                    $finalData["student"] = ["name"=>$studentDetail->name,"id"=>$studentDetail->id,"email"=>$studentDetail->email];
                    // Validate the questionnaire is already expired or not
                    if(strtotime($finalData["questionnaire"]["expiry_date"]) > strtotime(date("Y-m-d H:i:s"))){
                        $sectionIdWithName = $questionAnswerOptions = [];
                        $availableQuestions = $questionnaireWithQuestions->questions->toArray("id","que_sec_id","question");
                        $questionSectionIds = array_unique($questionnaireWithQuestions->questions->pluck("que_sec_id")->toArray());
                        $questionSectionName = QuestionSection::whereIn("id",$questionSectionIds)->get(["id","name"]);
                        foreach ($questionSectionName as $eachSection) {
                            $sectionIdWithName[$eachSection->id] = $eachSection->name;
                        }

                        $questionIds = array_unique($questionnaireWithQuestions->questions->pluck("id")->toArray());
                        $answerOptions = AnswerOption::whereIn("question_id",$questionIds)->get(["id","answer","question_id"])->toArray();
                        foreach ($answerOptions as $eachOptions) {
                            $questionAnswerOptions[$eachOptions["question_id"]][] = $eachOptions;
                        }
                        foreach ($availableQuestions as $eachQuestion) {
                            $answerOptions = [];
                            $answerOptions = array_key_exists($eachQuestion["id"],$questionAnswerOptions)?$questionAnswerOptions[$eachQuestion["id"]]:[];
                            $finalData["sectionWise"][$sectionIdWithName[$eachQuestion["que_sec_id"]]][] = ["question_id"=>$eachQuestion["id"],"question"=>$eachQuestion["question"],"options"=>$answerOptions];
                            $finalData["allquestion"][] = ["question_id"=>$eachQuestion["id"],"question"=>$eachQuestion["question"],"options"=>$answerOptions];
                        }
                        $allQuestions = (object) $finalData["allquestion"];
                        return Inertia::render('Invitation/Start',["questionnaire"=>$finalData,"questions"=>$allQuestions]);
                    }else{
                        die("The test is already expired");
                    }
                }
            }
        }else{
            die("Invitation code does not exist");
        }
    }
}
