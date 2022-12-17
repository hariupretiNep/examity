<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Answer>
 */
class AnswerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $studentId = \App\Models\Student::all()->random()->id;
        $questionId = \App\Models\Question::all()->random()->id;

        return [
            'student_id' => $studentId,
            'question_id' => $questionId,
            'answer_id' => \App\Models\AnswerOption::where(["question_id"=>$questionId,"correct"=>1])->get()->pluck("id")[0]??1,
        ];
    }
}
