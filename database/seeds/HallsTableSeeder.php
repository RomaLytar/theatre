<?php

use Illuminate\Database\Seeder;

class HallsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $halls = [
            'muzsalon' =>  [
                'title' => 'Musical salon',
                'name' => 'muzsalon',
                'patternPath' => 'admin.hall_plans.patterns.muzsalon-hall',
                'sections' => [
                    'Section 1' => [
                        1 => 10,
                        2 => 10,
                        3 => 10,
                        4 => 10,
                        5 => 10,
                        6 => 10,
                        7 => 10,
                        8 => 10,
                        9 => 10,
                        10 => 10,
                    ],
                ]
            ],
            'small' =>  [
                'title' => 'Small Hall',
                'name' => 'small',
                'patternPath' => 'admin.hall_plans.patterns.small-hall',
                'sections' => [
                    'Parterre' => [
                        1 => 33,
                        2 => 32,
                        3 => 31,
                        4 => 29,
                        5 => 28,
                        6 => 27,
                        7 => 27,
                        8 => 23,
                        9 => 21,
                        10 => 20,
                        11 => 17,
                        12 => 13,
                        13 => 13,
                    ],
                    'Balcony 1' => [
                        1 => 18,
                    ],
                    'Balcony 2' => [
                        1 => 13,
                        2 => 11,
                        3 => 12,
                        4 => 14,
                        5 => 15,
                        6 => 16,
                        7 => 9,
                    ],
                ]
            ],
            'big' =>  [
                'title' => 'Big Hall',
                'name' => 'big',
                'patternPath' => 'admin.hall_plans.patterns.big-hall',
                'sections' => [
                    'Parterre' => [
                        1 => 36,
                        2 => 38,
                        3 => 38,
                        4 => 40,
                        5 => 42,
                        6 => 42,
                        7 => 44,
                        8 => 46,
                        9 => 48,
                        10 => 48,
                        11 => 50,
                        12 => 51,
                        13 => 49,
                        14 => 43,
                        15 => 43,
                        16 => 41,
                        17 => 39,
                        18 => 38,
                        19 => 35,
                        20 => 30,
                        21 => 27,
                        22 => 52,
                    ],
                    'Balcony first tier of the left side' => [
                        1 => 20,
                        2 => 18,
                    ],
                    'Balcony first tier of the central part' => [
                        1 => 40,
                        2 => 38,
                        3 => 36,
                        4 => 34,
                        5 => 32,
                        6 => 32,
                        7 => 34,
                    ],
                    'Balcony first tier of the right side' => [
                        1 => 20,
                        2 => 17,
                    ],
                    'Balcony second tier of the left side' => [
                        1 => 24,
                        2 => 18,
                    ],
                    'Balcony second tier of the central side' => [
                        1 => 38,
                        2 => 36,
                        3 => 36,
                        4 => 36,
                        5 => 36,
                    ],
                    'Balcony second tier of the right side' => [
                        1 => 24,
                        2 => 18,
                    ],
                ]
            ],
            'outdoor' =>  [
                'title' => 'Outdoor',
                'name' => 'outdoor',
                'patternPath' => '',
                'sections' => [
                    'Section 1' => [
                        1 => 300,
                    ],
                ]
            ],
        ];

        foreach($halls as $hallName => $hallData) {
            factory(\App\Models\Hall::class, 'hall', 1)->create(['name' => $hallData['name'], 'patternPath' => $hallData['patternPath']])->each(function($hall) use ($hallName, $hallData)  {
                $sections = $hallData['sections'];
                $hall->addMedia(storage_path('111.png'))->preservingOriginal()->toMediaCollection('posters');
                $hall->addMedia(storage_path('111.png'))->preservingOriginal()->toMediaCollection('hall-images');
                $hall->translate('en')->save(factory(\App\Models\HallTranslation::class, 'hall_translation')->create(['hall_id' => $hall->id, 'language' => 'en', 'title' => $hallData['title']]));
                $hall->translate('ru')->save(factory(\App\Models\HallTranslation::class, 'hall_translation')->create(['hall_id' => $hall->id, 'language' => 'ru', 'title' => $hallData['title']]));
                $hall->translate('ua')->save(factory(\App\Models\HallTranslation::class, 'hall_translation')->create(['hall_id' => $hall->id, 'language' => 'ua', 'title' => $hallData['title']]));
                $number = 1;
                foreach($sections as $sectionName => $rows) {
                    factory(\App\Models\Section::class, 'section', 1)->create(['hall_id' => $hall->id, 'number' => $number])->each(function($section) use ($sectionName, $rows)  {
                        $section->translate('en')->save(factory(\App\Models\SectionTranslation::class, 'section_translation')->create(['section_id' => $section->id, 'language' => 'en', 'title' => $sectionName]));
                        $section->translate('ru')->save(factory(\App\Models\SectionTranslation::class, 'section_translation')->create(['section_id' => $section->id, 'language' => 'ru', 'title' => $sectionName]));
                        $section->translate('ua')->save(factory(\App\Models\SectionTranslation::class, 'section_translation')->create(['section_id' => $section->id, 'language' => 'ua', 'title' => $sectionName]));
                        foreach($rows as $rowNumber => $seatsCount) {
                            factory(\App\Models\Row::class, 'row', 1)->create(['section_id' => $section->id, 'number' => $rowNumber])->each(function($row) use ($rowNumber, $seatsCount)  {
                                for($i = 1; $i <= $seatsCount; $i++) {
                                    factory(\App\Models\Seat::class, 'seat', 1)->create(['row_id' => $row->id, 'number' => $i]);
                                }
                            });
                        };
                    });
                    $number++;
                }
            });
        }
    }
}
