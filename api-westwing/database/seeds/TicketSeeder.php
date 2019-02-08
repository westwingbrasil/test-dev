<?php

use Illuminate\Database\Seeder;
use  \Illuminate\Support\Facades\DB;

class TicketSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('ticket')->insert([
            'pedido_id' => 2,
            'titulo' => 'Bloqueio',
            'descricao' => 'Produtos bloqueados pela alfandega',
        ]);
        DB::table('ticket')->insert([
            'pedido_id' => 2,
            'titulo' => 'Regresso',
            'descricao' => 'Produtos despachados para regressar ao remetente',
        ]);
        DB::table('ticket')->insert([
            'pedido_id' => 1,
            'titulo' => 'Despacho',
            'descricao' => 'Remessa de computadores despachado para envio',
        ]);
        DB::table('ticket')->insert([
            'pedido_id' => 3,
            'titulo' => 'Tributação',
            'descricao' => 'Remessa pendente de pagamento da tributação',
        ]);
        DB::table('ticket')->insert([
            'pedido_id' => 1,
            'titulo' => 'Enviado',
            'descricao' => 'Remessa enviada a transportadora',
        ]);
    }
}
