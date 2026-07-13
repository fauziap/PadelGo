<?php

namespace Database\Seeders;

use App\Models\Book;
use App\Models\Court;
use App\Models\Schedule;
use Illuminate\Support\Str;
use Carbon\Carbon;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Sequence;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create([
            'first_name' => 'Admin',
            'last_name' => 'Padel',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('admin123'),
            'role' => 'admin',
        ]);

        Schedule::insert([
            ['start_time' => '10:00:00', 'end_time' => '13:00:00', 'created_at' => now(), 'updated_at' => now()],
            ['start_time' => '13:00:00', 'end_time' => '16:00:00', 'created_at' => now(), 'updated_at' => now()],
            ['start_time' => '16:00:00', 'end_time' => '19:00:00', 'created_at' => now(), 'updated_at' => now()],
            ['start_time' => '19:00:00', 'end_time' => '22:00:00', 'created_at' => now(), 'updated_at' => now()],
        ]);

        $courts = Court::factory()->count(3)->sequence(
            ['image_url' => '/images/Badminton1.jpeg', 'name' => 'Lapangan Kiri'],
            ['image_url' => '/images/Badminton2.jpg', 'name' => 'Lapangan Tengah'],
            ['image_url' => '/images/Badminton3.jpg', 'name' => 'Lapangan Kanan'],
        )->create();

        $scheduleIds = Schedule::pluck('id')->toArray();
        $courtIds = $courts->pluck('id')->toArray();
        $userId = User::first()->id;

        $dates = collect();
        for ($i = 0; $i < 7; $i++) {
            $dates->push(Carbon::today()->subDays($i));
        }

        foreach ($dates as $date) {
            $count = rand(1, 10); // jumlah booking acak antara 1-10

            Book::factory()->count($count)->state(new Sequence(
                fn($sequence) => [
                    'user_id' => $userId,
                    'court_id' => $courtIds[$sequence->index % count($courtIds)],
                    'schedule_id' => $scheduleIds[$sequence->index % count($scheduleIds)],
                    'booking_date' => $date->format('Y-m-d'),
                ]
            ))->create();
        }
    }
}
