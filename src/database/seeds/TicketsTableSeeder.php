<?php

use Illuminate\Database\Seeder;

class TicketsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        try {
            for ( $i = 0; $i < 5; $i++ ) {
                DB::table('clients')->insert([
                    'name' => Str::random(10),
                    'email' => Str::random(10).'@gmail.com'
                ]);

                for ( $c = 0; $c < 10; $c++ ) {
                    DB::table('tickets')->insert([
                        'code' => Str::random(10),
                        'title' => Str::random(10),
                        'content' => Str::random(10),
                        'client_id' => ( $i + 1 )
                    ]);
                }
            }
        } catch (\Exception $e) {
            throw $e;
        }
    }
}
