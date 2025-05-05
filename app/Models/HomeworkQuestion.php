<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class HomeworkQuestion extends Model
{
    use HasFactory;

    protected $table = 'homework_questions';

    protected $fillable =[
        'homework_id',
        'questions',
        'correct_answers',
        'answer_template',
        'tip',
    ];

    protected $guarded = ['id'];


    protected  $casts = [
        'correct_answers'=>'array',
        'auestions'=>'array',
        'answer_template'=>'array',
        'tip'=>'array'
    ];

    public function getQuestionsAttribute($value){
        return json_decode($value, true);
    }

    public function setQuestionsAttribute ($value){
        $this->attributes['questions'] = json_encode($value, JSON_UNESCAPED_UNICODE);
    }

    public function getCorrectAnswerAttribute($value)
    {
        return json_decode($value, true);
    }
    public function setCorrectAnswerAttribute ($value){
        $this->attributes['correct_answers'] = json_encode($value, JSON_UNESCAPED_UNICODE);
    }
    public function homework(){
        return $this->belongsTo(Homework::class);
    }
    


}
