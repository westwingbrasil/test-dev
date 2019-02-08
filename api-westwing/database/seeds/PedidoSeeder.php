<?php

use Illuminate\Database\Seeder;
use  \Illuminate\Support\Facades\DB;

class PedidoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('pedido')->insert([
            'cliente_id' => 1,
            'titulo' => 'Computador Dell',
            'descricao' => 'Remessa de computador dell i7 - 9 geração',
        ]);
        DB::table('pedido')->insert([
            'cliente_id' => 2,
            'titulo' => 'Actions Figures',
            'descricao' => '5 bonecos de ação da LOTEM LTDA',
        ]);
        DB::table('pedido')->insert([
            'cliente_id' => 2,
            'titulo' => 'Iphone XR',
            'descricao' => 'Remessa de Iphone XR proveniente da CHINA',
        ]);
        DB::table('pedido')->insert([
            'cliente_id' => 3,
            'titulo' => 'Roupas esportivas',
            'descricao' => 'Remessa de roupas esportivas da marca Adidas e Nike',
        ]);
        DB::table('pedido')->insert([
            'cliente_id' => 5,
            'titulo' => 'Perfumes',
            'descricao' => 'Remessa de perfumes provenientes de PARIS',
        ]);
    }
}
