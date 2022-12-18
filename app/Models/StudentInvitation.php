<?php

namespace App\Models;

use App\Models\Modules\Questionnaire;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentInvitation extends Model
{
    use HasFactory;

    public function student(){
        return $this->hasOne(Student::class,'id','student_id');
    }

    public function questionnaire(){
        return $this->hasOne(Questionnaire::class,'id','questionnaire_id');
    }
}
