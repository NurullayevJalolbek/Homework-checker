<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class WordTranslation extends Model
{
    use HasFactory;
    protected $fillable =['word_id', 'language_id', 'translation'];

    public function word()
    {
        return $this->belongsTo(Word::class);
    }

    public function language(){
        return $this->belongsTo(Language::class);
    }

}
