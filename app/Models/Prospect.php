<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Prospect extends Model
{
    use HasFactory;
    protected $fillable = [
        'agent_name',
        'client_name',
        'client_address',
        'date',
        'start_time',
        'end_time',
        'product',
        'observations',
        'sale_concluded',
        //'user_id',
        'duration',
    ];

    // Relation avec d'autres modèles, par exemple avec l'utilisateur qui a créé le prospect
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
