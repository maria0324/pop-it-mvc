<?php

namespace Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;



class Patient extends Model

{
    use HasFactory;

    protected $table = 'patient';

    public $timestamps = false;
    protected $fillable = [
        'surname',
        'name',
        'patronynic',
        'gender',
        'address',
        'polis',
        'number',
        'date_birth',
    ];

}