<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Subject extends Model
{
    use HasFactory;

    protected  $fillable =['name', 'teacher_id'];

    public function teacher(){
        return $this->belongsTo(User::class, 'teacher_id');
    }

    public function homeworks(){
        return $this->hasMany(Homework::class);
    }

}
