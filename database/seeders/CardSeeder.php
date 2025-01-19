<?php

namespace Database\Seeders;

use App\Models\Card;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CardSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Card::create([
            'card_name' => 'Sabo',
            'price' => 60.00,
            'stock' => 10,
            'rarity' => 'Full Art',
            'series' => 'One Piece',
            'set_code' => 'OP01',
            'image' => 'img/card/sabo.jpeg',
            'description' => 'A common character in the One Piece anime series. He is the main protagonist of the series.', 
        ]);
        Card::create([
            'card_name' => 'Kaku',
            'price' => 20.00,
            'stock' => 10,
            'rarity' => 'Super Rare',
            'series' => 'One Piece',
            'set_code' => 'OP01',
            'image' => 'img\card\kaku.jpeg',
            'description' => 'A Super Rare character in the One Piece anime series. He is the main protagonist of the series.', 
        ]);
        Card::create([
            'card_name' => 'Nami',
            'price' => 70.00,
            'stock' => 10,
            'rarity' => 'Alternate Art',
            'series' => 'One Piece',
            'set_code' => 'OP01',
            'image' => 'img\card\Nami.jpg',
            'description' => 'An Alternate Art character in the One Piece anime series. she is the main protagonist of the series.', 
        ]);

    }
}
