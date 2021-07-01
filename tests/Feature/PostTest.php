<?php

namespace Tests\Feature;

use App\Models\Post;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PostTest extends TestCase
{
    use RefreshDatabase,WithFaker;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_stores_post()
    {
        $user = create(User::class);

        $data = [
            'title' => $this->faker->sentence(),
            'content' => $this->faker->text(200),
            'author_id' => $user->id
        ];

        $response = $this->json('POST',$this->baseUrl . "posts", $data);

        $response->assertStatus(201);
        $this->assertDatabaseHas('posts',$data); #pregunta si existe un registro con los datos que hemos creado

        $post = Post::all()->first();

        $response->assertJson([
            'data' => [
                'id' => $post->id,
                'title' => $post->title
            ]
        ]);
    }

    public function test_deletes_post(){
        create(User::class);
        $post = create(Post::class);

        $this->json('DELETE',$this->baseUrl . "posts/{$post->id}")
            ->assertStatus(204);

        $this->assertNull(Post::find($post->id));
    }
}
