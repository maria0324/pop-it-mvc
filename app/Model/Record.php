<?php

namespace Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;



class Record extends Model

{
    use HasFactory;



    public $timestamps = false;
    protected $fillable = [
        'id_doctor',
        'id_patient',
        'date',
        'id_status'

    ];

    protected $table = 'records';
    public function status()
    {
        return $this->belongsTo(Status::class, 'id_status','id');
    }


}