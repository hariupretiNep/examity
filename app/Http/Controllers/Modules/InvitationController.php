<?php

namespace App\Http\Controllers\Modules;

use Inertia\Inertia;
use App\Models\AnswerOption;
use Illuminate\Http\Request;
use App\Models\QuestionSection;
use App\Models\StudentInvitation;
use App\Http\Controllers\Controller;
use App\Models\Modules\Questionnaire;
use App\Http\Requests\Modules\Invitation\StartInvitationRequest;
use App\Http\Requests\Modules\Invitation\SubmitInvitationTestRequest;
use App\Models\Answer;

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
                    $finalData["questionnaire"] = ["title"=>$questionnaireDetail->title,"id"=>$questionnaireDetail->id,"expiry_date"=>$questionnaireDetail->expiry_date];
                    $finalData["student"] = ["name"=>$studentDetail->name,"id"=>$studentDetail->id,"email"=>$studentDetail->email];
                    $finalData["invitation_code"] = $invitationCode;
                    // Validate the questionnaire is already expired or not
                    if(strtotime($finalData["questionnaire"]["expiry_date"]) > strtotime(date("Y-m-d H:i:s"))){
                        return Inertia::render('Invitation/Start',["data"=>$finalData]);
                    }else{
                        die("The test is already expired");
                    }
                }
            }
        }else{
            die("Invitation code does not exist");
        }
    }

    public function startInvitationTest(StartInvitationRequest $invitationRequest) {
        //Student want to start test, validate and proceed
        $invitationRecord = StudentInvitation::where(["invitation_code"=>$invitationRequest->invitation_code,"student_id"=>$invitationRequest->student_id,"questionnaire_id"=>$invitationRequest->questionnaire_id])->first();
        if(!empty($invitationRecord)){
            $questionnaireDetails = Questionnaire::with("questions")->findOrFail($invitationRecord->id);
            $allQuestions = $questionnaireDetails->questions->toArray();
            $collectQuestionIds = $questionnaireDetails->questions->pluck("id")->toArray();
            $getAnswerOptions = AnswerOption::whereIn("question_id",$collectQuestionIds)->get(["id","answer","question_id"])->toArray();
            $prepareData = [];
            foreach ($allQuestions as $eachQuestion) {
                $prepareData[$eachQuestion["id"]] = ["que_id"=>$eachQuestion["id"],"question"=>$eachQuestion["question"]];
            }
            foreach ($getAnswerOptions as $eachOption) {
                $prepareData[$eachOption["question_id"]]["options"][] = $eachOption;
            }
            return response()->json(["data"=>$prepareData]);
        }else{
            die("Provided information not matched with our records");
        }
    }

    public function submitInvitationTest(SubmitInvitationTestRequest $request){
        $submittedAnswers = $request->answers;
        $record = Answer::insert($submittedAnswers);
        $invitationDetails = StudentInvitation::where("invitation_code",$request->invitation_code)->first();
        $invitationDetails->used = 1;
        $invitationDetails->save();
        if($record){
            return response()->json(["success"=>true]);
        }else{
            return response()->json(["success"=>false]);
        }
    }
}
