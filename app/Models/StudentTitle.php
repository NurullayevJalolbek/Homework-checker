<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class StudentTitle extends Model
{
    use HasFactory; 

    protected $fillable = ['student_id', 'title_id', 'status'];

    public function student(){
        return $this->belongsTo(User::class, 'student_id');
    }

    public function title(){
        return $this->belongsTo(Title::class);
    }
}
