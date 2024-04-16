<?php

namespace Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;



class Status extends Model

{
    use HasFactory;

    protected $table = 'status';

    public $timestamps = false;
    protected $fillable = [
        'name',
    ];

}