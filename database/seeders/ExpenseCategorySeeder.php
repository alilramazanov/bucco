<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ExpenseCategorySeeder extends Seeder
{


    public function run(){

        $names = [
            'Списания',
            'Расходы',
            'Оплаты'
        ];

        foreach ($names as $name){
            $data = [
                'name' => $name
            ];

            \DB::table('expense_categories')->insert($data);
        }


    }


}
