<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RecuPaiement extends Model
{
    use HasFactory;

    protected $table = 'recu_paiements';

    protected $fillable = [
        'student_id',
        'montant',
        'date_paiement',
        'reference'
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}
