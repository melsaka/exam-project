<?php

namespace Database\Factories;

use App\Models\Exam;
use App\Models\Subject;
use Illuminate\Database\Eloquent\Factories\Factory;

class ExamFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Exam::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'subject_id'    =>  create(new Subject)->id,
            'name'          =>  $this->faker->sentence,
            'description'   =>  $this->faker->paragraph,
        ];
    }
}
