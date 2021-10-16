<?php

namespace Database\Factories;

use App\Models\TaskTemplate;
use Illuminate\Database\Eloquent\Factories\Factory;
class TaskTemplateFactory extends Factory
{

    protected $model = TaskTemplate::class;

    public function definition(): array
    {
        $description = $this->faker->realText(rand(1000, 4000));
        $templates = 'задача '.rand(1, 20);
        $group_id = rand(1,3);

        return [
            'group_id' => $group_id,
            'description' => $description,
            'template' => $templates
        ];
    }


}
