<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $guarded = [];

    public function lessons(){
        return $this->hasMany(Lesson::class, 'class_section', 'class_section');
    }

    public function lessons_with_class(){
        return $this->hasMany(Lesson::class, 'class_section', 'class');
    }

    public function materials(){
        return $this->hasMany(Material::class, 'class_section', 'class_section');
    }

    public function std_complaints(){
        return $this->hasMany(Complaint::class, 'reg_no', 'reg_no');
    }
}
