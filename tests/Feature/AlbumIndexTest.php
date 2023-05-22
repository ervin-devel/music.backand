<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AlbumIndexTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function testAlbumIndexStatus(): void
    {
        $response = $this->get('/admin/albums');

        $response->assertStatus(200);
    }
}
