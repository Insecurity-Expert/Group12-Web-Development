<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Event;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'role' => 'admin',
            'password' => Hash::make('password123'),
        ]);

        User::factory() ->create([
            'name' => 'Test user',
            'email' => 'test@example.com',
            'role' => 'attendee',
            'password' => Hash::make('password'),
        ]);

        Event::create([
            'title' => 'Tech Summit 2026',
            'description' => 'A full-day summit on modern web development, featuring talks from industry speakers and hands-on sessions.',
            'location' => 'PUP Main S511',
            'start_date' => now()->addDays(7),
            'end_date' => now() -> addDays(7) -> addHours(8),
            'capacity' => 100,
            'is_published' => true,
        ]);

        Event::create([
            'title' => 'Laravel Workshop',
            'description' => 'A beginner-friendly, hands-on workshop covering the fundamentals of the Laravel framework.',
            'location' => 'PUP Main S510',
            'start_date' => now()->addDays(14),
            'end_date' => now()->addDays(14)->addHours(4),
            'capacity' => 30,
            'is_published' => true,
        ]);

        Event::create([
    'title' => 'UI/UX Design Bootcamp',
    'description' => 'An intensive bootcamp on user interface and experience design principles, with live critique sessions.',
    'location' => 'PUP Main S510',
    'start_date' => now()->addDays(21),
    'end_date' => now()->addDays(21)->addHours(6),
    'capacity' => 50,
    'is_published' => true,
        ]);
    }
}
