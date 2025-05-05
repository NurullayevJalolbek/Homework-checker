<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class VocabularyTestResult extends Model
{
    use HasFactory;

    protected $fillable = ['vocabulary_id', 'user_id', 'correct_answers', 'incorrect_answers', 'total_vocabularies', 'is_accepted'];


    protected $casts =['incorrect_answers'=>'array'];

    public function vocabulary()
    {
        return $this->belongsTo(Vocabulary::class);
    }
    public function users()
    {
        return $this->belongsTo(User::class);
    }
    
}
