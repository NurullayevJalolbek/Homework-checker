<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class HomeworkSubmission extends Model
{
    use HasFactory;

    protected $table = 'homework_submissions';

    protected $fillable =[
        'student_id',
        'homework_id',
        'answers',
        'status',
        'score'
    ];

    protected $guarded =[
        'id'
    ];

    protected $casts = [
        'answers'=>'array'
    ];

    public function student(){
        return $this->belongsTo(User::class, 'student_id');
    }
    public function homework(){
        return $this-> belongsTo(Homework::class);
    }



}
