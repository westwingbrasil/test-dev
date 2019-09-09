<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $user_orders = [];
        for ($i = 1; $i <= 5; ++$i) {
            $user_id = DB::table('users')->insertGetId([
                'name' => 'Example '.$i,
                'email' => 'example'.$i.'@example.com'
            ], 'user_id');

            $max_orders = rand(1, 3);
            for ($j = 0; $j < $max_orders; ++$j) {
                $user_orders[] = [
                    'user_id' => $user_id,
                    'user_name' => 'Example '.$i,
                ];
            }
        }

        shuffle($user_orders);
        foreach ($user_orders as $idx => &$order) {
            $order_id = $idx + 1;
            $order['order_id'] = $order_id;

            DB::table('orders')->insert([
                'order_id' => $order['order_id'],
                'user_id' => $order['user_id']
            ]);
        }
        unset($order);

        $num_tickets = ceil(count($user_orders) * 2 / 3);
        $orders_with_tickets = array_rand($user_orders, $num_tickets);
        foreach ($orders_with_tickets as $i) {
            $order = $user_orders[$i];
            DB::table('tickets')->insert([
                'order_id' => $order['order_id'],
                'subject' => 'Ticket subject U'.$order['user_id'].'O'.$order['order_id'],
                'body' => 'This is my ticket for order '.$order['order_id'].', my name is '.$order['user_name'],
                'created_at' => DB::raw('(SELECT DATE_ADD(CURRENT_TIMESTAMP, INTERVAL FLOOR(RAND() * 121) SECOND))')
            ]);
        }
    }
}
