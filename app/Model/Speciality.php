<?php

namespace Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;



class Speciality extends Model

{
    use HasFactory;

    protected $table = 'specialities';

    public $timestamps = false;
    protected $fillable = [
        'name',
    ];

}