<?php

namespace Tests\Feature;

use App\Models\Student;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class StudentTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function testFactory(): void
    {
        $student = Student::factory()->create();

        $this->assertDatabaseHas('students', [
            'id' => $student->id,
            'name' => $student->name,
            'nim' => $student->nim,
            'prodi' => $student->prodi,
        ]);
    }

    public function testIndex()
    {
        $student = Student::factory()->create();

        $response = $this->get('/students');
        $response->assertStatus(200);
        $response->assertJson([
            'data' => [
                [
                    'id' => $student->id,
                    'name' => $student->name,
                    'nim' => $student->nim,
                    'prodi' => $student->prodi,
                    'created_at' => $student->created_at->toISOString(),
                    'updated_at' => $student->updated_at->toISOString(),
                ],
            ],
        ]);
    }
}
