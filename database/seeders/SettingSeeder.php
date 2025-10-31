<?php

namespace Database\Seeders;

use App\Models\Settings;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use illinate\Support\Facades\DB;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Settings::create([
            'app_name' => 'Point of Sales | Barista PPKD Jakarta Pusat',
            'address' => 'Jl. Karet Pasar Baru Barat, Karet Tengsin, Kecamatan Tanah Abang, Kota Jakarta Pusat, Daerah Khusus
                        Ibukota Jakarta 10250',
            'phone_number' => '(021) 57950913'
        ]);
        // DB::table('settings')->create([]);
    }
}
