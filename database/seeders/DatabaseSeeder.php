<?php

namespace Database\Seeders;

use App\Models\Ksm;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        Ksm::create([
            'ksm_name' => 'THT-KL',
        ]);
        Ksm::create([
            'ksm_name' => 'Bedah',
        ]);
        Ksm::create([
            'ksm_name' => 'Obsgyn',
        ]);
        Ksm::create([
            'ksm_name' => 'Orthopaedi',
        ]);
        Ksm::create([
            'ksm_name' => 'Anak',
        ]);
        Ksm::create([
            'ksm_name' => 'Penyakit Dalam',
        ]);
        Ksm::create([
            'ksm_name' => 'Saraf',
        ]);
        Ksm::create([
            'ksm_name' => 'Kulit',
        ]);
    }
}
