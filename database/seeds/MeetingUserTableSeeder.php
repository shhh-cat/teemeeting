<?php

use Illuminate\Database\Seeder;

class MeetingUserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = App\User::all();
        App\Meeting::all()->each(function ($meeting) use ($users) {
            $meeting->users()->attach(
                $users->random(rand(1, 4))->pluck('id')->toArray()
            );
        });
    }
}
