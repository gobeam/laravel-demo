<?php

namespace Tests\Feature;

use App\Category;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CategoryModuleTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    public function test_create_category()
    {
        $category = new Category();
        $data = [
            'title' => $this->faker->word,
            'status' => $this->faker->boolean
        ];
        $this->assertInstanceOf(Category::class, $category->create($data));
    }

    public function test_normal_user_cannot_view_and_add_category()
    {
        $options['role'] = "writer";
        $user = factory(User::class)->create($options);

        $response = $this->actingAs($user)->get(route('category.index'));
        $response->assertStatus(403);
//        $response->assertRedirect(route('home'));
        $postResponse = $this->actingAs($user)->post(route('category.store'), [
            'title' => $this->faker->word,
            'status' => $this->faker->boolean
        ]);
        $postResponse->assertStatus(403);

    }

    public function test_admin_user_can_view_add_category()
    {
        $options['role'] = "admin";
        $user = factory(User::class)->create($options);

        $response = $this->actingAs($user)->get(route('category.index'));
        $response->assertStatus(200);
        $postResponse = $this->actingAs($user)->post(route('category.store'), [
            'title' => $this->faker->word,
            'status' => $this->faker->boolean
        ]);
        $postResponse->assertRedirect(route('category.index'));
        $postResponse->assertStatus(302);
    }
}
