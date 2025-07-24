<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{

    // defining table name
    // protected $table = 'students';


    // limiting the fields that can be mass assigned
    protected $fillable = [
        'name',
        'age',
        'state_of_origin',
        'class'
    ];


    // formating data to a well readable format
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',
    ];



}
