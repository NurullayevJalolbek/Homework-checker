<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Word extends Model
{
    use HasFactory;

    protected $fillable =['word', 'word_tyoe_id'];

    public function type()
    {
        return $this->belongsTo(WordType::class);
    }

    public function translations(){
        return $this->hasMany(WordTranslation::class);
    }

    public function descriptions()
    {
        return $this->hasMany(WordDescription::class);
    }
    public function tests()
    {
        return $this->hasMany(Test::class);
    }
}
