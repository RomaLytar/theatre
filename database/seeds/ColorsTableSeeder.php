<?php

use Illuminate\Database\Seeder;

class ColorsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $colors = [
            'Фіолетовий' => '#EE82EE',
            'Томатний' => '#FF6347',
            'Синій сланець' => '#6A5ACD',
            'Світло-зелений морський' => '#20B2AA',
            'Жовто-зелений' => '#9ACD32',
            'Оливковий' => '#808000',
            'Синьо-зелений' => '#008080',
            'Помаранчевий' => '#FFA500',
            'Корал-світлий' => '#F08080',
            'Перу' => '#CD853F',
            'Темно-бордовий' => '#800000',
            'Червоний' => '#ff0000',
            'Темно-синій' => '#000080',
            'Зелений' => '#008000',
            'Морська хвиля' => '#00ffff',
            'Блідно-зелений' => '#98FB98',
            'Синій порошок' => '#B0E0E6',
            'Туманна троянда' => '#FFE4E1',
            'Навахо-білий' => '#FFDEAD',
        ];

        foreach ($colors as $colorName => $colorCode) {
            $color = [
                'title' => $colorName,
                'code' => $colorCode,
            ];
            \App\Models\Color::create($color);
        }
    }
}
