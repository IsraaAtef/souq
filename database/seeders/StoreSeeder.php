<?php

namespace Database\Seeders;

use App\Models\Store;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StoreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $user = User::get()->first();
        if(!$user){
            return;
        }

        Store::create([
            'name' => 'PalStore',
            'user_id' => $user->id         
        ]);
    }
}
