<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Seeder;
use App\Models\User;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
            $this->call([
                ProveedoresSeeder::class,
                CategoriasSeeder::class,
                ClientesSeeder::class,
                MarcasSeeder::class,
                OrigenesSeeder::class,
                AlmacenesSeeder::class,
                RoleSeeder::class,
                UsuariosSeeder::class,
                ProductosSeeder::class,
            ]);
            /* User::factory(20)->create(); */
    }
}
