<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'matricule',
        'nom',
        'prenom',
        'email',
        'telephone',
        'filiere',

        'niveau'

        'niveau',

    ];

    public function memoires()
    {
        return $this->hasMany(Memoire::class);
    }


    public function presences()
    {
        return $this->hasMany(Presence::class);
    }

    public function paiements()

    public function soutenances()
    {
        return $this->hasMany(Soutenance::class);
    }

    public function recuPaiements()

    {
        return $this->hasMany(RecuPaiement::class);
    }
}
