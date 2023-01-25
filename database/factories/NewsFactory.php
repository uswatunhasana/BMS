<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\News;
use App\Models\Category;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\News>
 */
class NewsFactory extends Factory
{

    protected $model = News::class;

    public function definition()
    {
            return [
                'title' => $this->faker->unique()->text(),
                'category_id' => Category::all()->random()->id,
                'content' => $this->faker->paragraph(2),
                'tags' => $this->faker->words(5),
                'thumbnail' => $this->faker->image(null, 360, 360, 'animals', true, true, 'cats', true, 'jpg'),
            ];
       
    }
}
