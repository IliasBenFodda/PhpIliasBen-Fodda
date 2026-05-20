<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Onderwerp extends Model
{

    protected $table = 'onderwerpen';
    protected $fillable = [
        'name'
    ];

    public function nieuws()
    {
        return $this->belongsToMany(
            Nieuws::class,
            'nieuws_onderwerp'
        );
    }
}
