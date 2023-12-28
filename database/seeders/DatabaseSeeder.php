<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Diskon;
use App\Models\Supplier;
use App\Models\Member;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        User::create([
            'name' => 'Admin',
            'username' => 'admin',
            'password' => bcrypt('123'),
            'level' => 'Admin'
        ]);
        
        User::create([
            'name' => 'Kasir',
            'username' => 'kasir',
            'password' => bcrypt('321'),
            'level' => 'Kasir'
        ]);
        
        Member::create([
            'name' => 'Member',
            'username' => 'member',
            'password' => bcrypt('111'),
            'alamat' => 'alamat cuy',
            'no_telp' => '083926381927',
        ]);

        Diskon::create([
            'minimal_belanja' => 200000,
            'potongan' => 2
        ]);

        Supplier::create([
            'nama_supplier' => 'maulsup',
            'nama_perusahaan' => 'maulsup',
            'alamat' => 'jalanajalan',
            'no_telp' => '028342394',
        ]);
    }
}
