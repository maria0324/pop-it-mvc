<?php

namespace Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;



class Doctor extends Model

{
    use HasFactory;

    protected $table = 'doctors';

    public $timestamps = false;
    protected $fillable = [
        'surname',
        'name',
        'patronymic',
        'address',
        'number',
        'id_post',
        'id_speciality',
    ];

}