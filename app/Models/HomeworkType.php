<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class HomeworkType extends Model
{
    use HasFactory;

    protected $fillable =[
        'name',
        'key',
    ];

    protected $guarded =['id'];

    public function homeworks(){
        return $this->hasMany(Homework::class, 'type_id');
    }
    

}
