<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ItemsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        \DB::table('items')->insert([
            [
                'product_name' => '商品A',
                'arrival_source' => '入荷元A',
                'manufacturer' => '製造元A',
                'price' => '10000',
            ], [
                'product_name' => '商品B',
                'arrival_source' => '入荷元B',
                'manufacturer' => '製造元B',
                'price' => '15000',
            ], [
                'product_name' => '商品C',
                'arrival_source' => '入荷元C',
                'manufacturer' => '製造元C',
                'price' => '20000',
            ], [
                'product_name' => '商品D',
                'arrival_source' => '入荷元D',
                'manufacturer' => '製造元D',
                'price' => '20000',
            ], [
                'product_name' => '商品E',
                'arrival_source' => '入荷元E',
                'manufacturer' => '製造元E',
                'price' => '25000',
            ], [
                'product_name' => '商品F',
                'arrival_source' => '入荷元F',
                'manufacturer' => '製造元F',
                'price' => '30000',
            ], [
                'product_name' => '商品G',
                'arrival_source' => '入荷元G',
                'manufacturer' => '製造元G',
                'price' => '35000',
            ], [
                'product_name' => '商品H',
                'arrival_source' => '入荷元H',
                'manufacturer' => '製造元H',
                'price' => '40000',
            ], [
                'product_name' => '商品I',
                'arrival_source' => '入荷元I',
                'manufacturer' => '製造元I',
                'price' => '45000',
            ], [
                'product_name' => '商品J',
                'arrival_source' => '入荷元J',
                'manufacturer' => '製造元J',
                'price' => '50000',
            ], [
                'product_name' => '商品K',
                'arrival_source' => '入荷元K',
                'manufacturer' => '製造元K',
                'price' => '55000',
            ], [
                'product_name' => '商品L',
                'arrival_source' => '入荷元L',
                'manufacturer' => '製造元L',
                'price' => '60000',
            ]
        ]);
    }
}
