<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Nieuws extends Model
{
    protected $table = 'nieuws';

    protected $fillable = [
        'title',
        'image',
        'content',
        'publication_date'
    ];

    protected $casts = [
        'publication_date' => 'date',
    ];

    public function onderwerpen()
    {
        return $this->belongsToMany(
            Onderwerp::class,
            'nieuws_onderwerp'
        );
    }
}
