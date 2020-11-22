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
        // $this->call(UserSeeder::class);
        factory(App\Client::class, 10)->create();
        factory(App\Produit::class, 40)->create();
        factory(App\Facture::class, 10)->create();
        // factory(App\FactureProduit::class, 10)->create();
    }
}
