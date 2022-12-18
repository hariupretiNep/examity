<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    public function section(){
        return $this->belongsTo(QuestionSection::class);
    }

    public function answers(){
        return $this->hasMany(AnswerOption::class);
    }
}
