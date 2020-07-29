<?php

namespace Tests\Feature;

use App\Blog;
use App\Category;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class BlogModuleTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testExample()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function test_create_blog()
    {
        $options['role'] = "writer";
        $user = factory(User::class)->create($options);
        $category = factory(Category::class)->create();
        $blog = new Blog();
        $data = [
            'title' => $this->faker->sentence($nbWords = 1, $variableNbWords = true),
            'description' => $this->faker->paragraph($nbSentences = 1, $variableNbSentences = true),
            'body' => $this->faker->text($maxNbChars = 1500),
            'status' => $this->faker->boolean,
            'created_at' => $this->faker->dateTimeBetween($startDate = '-1 years', $endDate = 'now'),
            "category_id" => $category->id,
            "user_id" => $user->id
        ];
        $this->assertInstanceOf(Blog::class, $blog->create($data));
    }

    public function testUnauthorizedCreateBlog()
    {
        $response = $this->post('/blog', []);
        $response->assertRedirect(route('login'));
        $response->assertStatus(302);
    }


    public function test_all_user_can_add_blog()
    {
        $options['role'] = "writer";
        $user = factory(User::class)->create($options);
        $category = factory(Category::class)->create();
        $data = [
            'title' => $this->faker->sentence($nbWords = 1, $variableNbWords = true),
            'description' => $this->faker->paragraph($nbSentences = 1, $variableNbSentences = true),
            'body' => $this->faker->text($maxNbChars = 1500),
            'status' => $this->faker->boolean,
            'created_at' => $this->faker->dateTimeBetween($startDate = '-1 years', $endDate = 'now'),
            "category_id" => $category->id,
            "user_id" => $user->id
        ];
        $response = $this->actingAs($user)->post(route('blog.store'), $data);
        $response->assertStatus(302);
        $response->assertRedirect(route('blog.index'))->assertSee('blog');
    }


    public function test_all_user_can_update_blog()
    {
        $options['role'] = "writer";
        $user = factory(User::class)->create($options);
        $category = factory(Category::class)->create();

        $option['category_id'] = $category->id;
        $option['user_id'] = $user->id;
        $blog = factory(Blog::class)->create($option);
        $data = [
            'title' => 'This is updated title',
            'description' => $this->faker->paragraph($nbSentences = 1, $variableNbSentences = true),
            'body' => $this->faker->text($maxNbChars = 1500),
            "category_id" => $category->id,
        ];
        $response = $this->actingAs($user)->put(route('blog.update', $blog->id), $data);
        $this->assertDatabaseHas('blogs', ["title" => 'This is updated title']);
        $response->assertStatus(302);
        $response->assertRedirect(route('blog.index'));
    }
}
