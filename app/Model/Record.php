<?php

namespace Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;



class Record extends Model

{
    use HasFactory;

    protected $table = 'records';

    public $timestamps = false;
    protected $fillable = [
        'id_doctor',
        'id_patient',
        'id_user',
        'date',
        'id_status',

    ];

}