<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Tag;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tags = [
            [
                'name' => 'Важно',
                'icon_class' => 'fas fa-shield-alt',
                'badge_class' => 'bg-success',
            ],
            [
                'name' => 'Финансы',
                'icon_class' => 'fas fa-percentage',
                'badge_class' => 'bg-info',
            ],
            [
                'name' => 'Технологии',
                'icon_class' => 'fas fa-mobile-alt',
                'badge_class' => 'bg-primary',
            ],
            [
                'name' => 'Акция',
                'icon_class' => 'fas fa-gift',
                'badge_class' => 'bg-danger',
            ],
        ];

        foreach($tags as $tag){
            Tag::firstOrCreate($tag);
        }
    }
}
