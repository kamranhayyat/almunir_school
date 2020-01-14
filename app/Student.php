<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $guarded = [];

    public function lessons(){
        return $this->hasMany(Lesson::class, 'class_section', 'class_section');
    }
}
