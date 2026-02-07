<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Memoire extends Model
{
    use HasFactory;


   protected $fillable = [
    'student_id',
    'titre',
    'annee',
    'fichier_pdf',
];


    protected $fillable = [
        'titre',
        'annee',
        'fichier_pdf',
        'student_id',
    ];


    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}
