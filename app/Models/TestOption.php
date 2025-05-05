<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TestOption extends Model
{
    use HasFactory;

    protected $fillable =['test_id', 'option_text'];

    public function test(){
        return $this->belongsTo(Test::class);
    }
}
