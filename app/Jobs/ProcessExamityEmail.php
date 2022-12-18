<?php

namespace App\Jobs;

use App\Mail\ExamInvitationForStudent;
use App\Models\Student;
use Illuminate\Support\Str;
use Illuminate\Bus\Queueable;
use App\Models\StudentInvitation;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use App\Models\Modules\Questionnaire;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;

class ProcessExamityEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $questionnaire;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Questionnaire $questionnaire)
    {
        $this->questionnaire = $questionnaire;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        //List all students and start mailing them with unique invitation link
        $allStudents = Student::all();
        foreach ($allStudents as $eachStudent) {
            $uniqueInvitationCode = self::generateUniqueInvitationCode($eachStudent->id);
            $invitation = new StudentInvitation();
            $invitation->student_id = $eachStudent->id;
            $invitation->questionnaire_id = $this->questionnaire->id;
            $invitation->invitation_code = $uniqueInvitationCode;
            $invitation->used = 0;
            if($invitation->save()){
                //Invitation recorded on db, start mailing the it to associated student.
                Mail::to($eachStudent->email)->send(new ExamInvitationForStudent($eachStudent,$uniqueInvitationCode));
            }
        }
    }

    private function generateUniqueInvitationCode($studentId){
        return "examity-invitation-".(string) date("ymdhis").$studentId."".Str::random(40);
    }
}
