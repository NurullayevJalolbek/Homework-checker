<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Language extends Model
{
    use HasFactory;

    protected $table = 'languages';

    protected $fillable =['name', 'code'];


    public function translations(){
        return $this->hasMany(WordTranslation::class);
    }
    public function descriptions(){
        return $this->hasMany(WordDescription::class);
    }
}
