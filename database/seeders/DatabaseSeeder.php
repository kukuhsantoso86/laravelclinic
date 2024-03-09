<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        \App\Models\User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin1@gmail.com',
            'role' => 'admin',
            'password' => Hash::make('zxcasd123'),
            'phone' => '123345456',
        ]);

        \App\Models\ProfileClinic::factory()->create([
            'name'=> 'klinik kukuh',
            'address' => 'jl .baru no. 12',
            'phone' => '123123123',
            'email' => 'drbaru@gmail.com',
            'doctor_name' => 'dr.baru',
            'unique_code' => '123123',
        ]);

        $this->call(DoctorSeeder::class);
    }
}
