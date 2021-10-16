<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class PositionTemplateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $Positions = [
            'тимлид',
            'мидл',
            'сеньор',
            'стажер',
            'Специалист по общению с странным заказчиком',
            'Архитектор',
            'Проектировщик баз данных',
            'Програмист 1с',
            'Верстальщик',
            'Андроид разработчик',
            'Бэкендер',
            'HR менеджер',
            'Проект менеджер',
            '.NET разработчик',
            'Сетевой администратор',
            'Тестировщик',
            'Дизайнер',
            'boss of this gym'
        ];

        foreach ($Positions as $position){
            \DB::table('position_templates')->insert([
                'group_id' => rand(1,3),
                'name' => $position
            ]);

        }




    }
}
