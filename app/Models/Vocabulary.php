<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Vocabulary extends Model
{
    use HasFactory;

    protected $fillable = ['word', 'level','due_date', 'total_vocabularies'];

    protected $casts =['word'=>'array'];
    public function testResults(){
        return $this->hasMany(VocabularyTestResult::class);
    }

    

}
