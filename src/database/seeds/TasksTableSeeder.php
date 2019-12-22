<?php

use Illuminate\Database\Seeder;

class TasksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tasks')->insert([
            [ 'id' => 1, 'name' => 'An Old Task', 'created_at' => '2019-12-02 15:00:00', 'updated_at' => '2019-12-02 15:00:00' ],
        ]);
    }
}
