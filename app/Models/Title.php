<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Title extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function studentTitles(){
        return $this->hasMany(StudentTitle::class);
    }

}
