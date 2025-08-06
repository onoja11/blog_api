<?php

use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Post;
use Tests\TestCase;

uses(TestCase::class, RefreshDatabase::class);


it('can create a post', function () {
    $postData = Post::factory()->make()->toArray();
    $response = $this->postJson('/api/posts', $postData,);
    $response->assertStatus(201)->assertJsonFragment($postData);
});

it('can fetch all posts', function () {
    Post::factory(3)->create();
    $response = $this->getJson('/api/posts');
    $response->assertStatus(200)->assertJsonCount(3, 'data');
});

it('can fetch a single post', function () {
    $post = Post::factory()->create();
    $response = $this->getJson("/api/posts/{$post->id}");
    $response->assertStatus(200)->assertJsonFragment(['id' => $post->id]);
});

it('can update a post', function () {
    $post = Post::factory()->create();
    $updateData = ['title' => 'Updated Title', 'content' => 'Updated Content'];
    $response = $this->putJson("/api/posts/{$post->id}", $updateData);
    $response->assertStatus(200)->assertJsonFragment($updateData);
});

it('can delete a post', function () {
    $post = Post::factory()->create();
    $response = $this->deleteJson("/api/posts/{$post->id}");
    $response->assertStatus(204);
    $this->assertDatabaseMissing('posts', ['id' => $post->id]);
});

   
