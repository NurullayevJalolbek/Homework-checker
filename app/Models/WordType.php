<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class WordType extends Model
{
    use HasFactory;

    protected $fillable =['name'];

    public function words()
    {
        return $this->hasMany(Word::class);
    }





}
