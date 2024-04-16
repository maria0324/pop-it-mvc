<?php

namespace Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;



class RecordsAndPatients extends Model

{
    use HasFactory;

    protected $table = 'records_and_patients';

    public $timestamps = false;
    protected $fillable = [
        'id_record',
        'id_patient',
    ];

}