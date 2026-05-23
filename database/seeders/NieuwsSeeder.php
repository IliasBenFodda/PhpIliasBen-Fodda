<?php

namespace Database\Seeders;

use App\Models\Nieuws;
use Illuminate\Database\Seeder;

class NieuwsSeeder extends Seeder
{
    public function run(): void
    {
        $items = [
            [
                'title' => 'Welkom op ons platform',
                'content' => 'We zijn blij je te verwelkomen op ons community platform. Hier vind je het laatste nieuws, FAQ en contactmogelijkheden.',
                'publication_date' => now()->subDays(2),
            ],
            [
                'title' => 'Nieuwe functies beschikbaar',
                'content' => 'We hebben nieuwe functies toegevoegd aan het platform, waaronder een verbeterd FAQ-systeem en een contactformulier.',
                'publication_date' => now()->subDay(),
            ],
            [
                'title' => 'Community evenement komende maand',
                'content' => 'Schrijf je in voor ons community evenement volgende maand. Meer details volgen binnenkort.',
                'publication_date' => now(),
            ],
        ];

        foreach ($items as $item) {
            Nieuws::updateOrCreate(
                ['title' => $item['title']],
                [
                    'content' => $item['content'],
                    'publication_date' => $item['publication_date'],
                    'image' => 'nieuws/placeholder.jpg',
                ]
            );
        }
    }
}
