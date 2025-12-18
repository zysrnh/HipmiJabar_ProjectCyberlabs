<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        $password = Hash::make('password123');

        // 27 Kabupaten/Kota di Jawa Barat
        // 18 Kabupaten + 9 Kota
        $wilayahJabar = [
            // KABUPATEN (18)
            'Bandung',
            'Bandung Barat',
            'Bekasi',
            'Bogor',
            'Ciamis',
            'Cianjur',
            'Cirebon',
            'Garut',
            'Indramayu',
            'Karawang',
            'Kuningan',
            'Majalengka',
            'Pangandaran',
            'Purwakarta',
            'Subang',
            'Sukabumi',
            'Sumedang',
            'Tasikmalaya',
            
            // KOTA (9)
            'Kota Bandung',
            'Kota Banjar',
            'Kota Bekasi',
            'Kota Bogor',
            'Kota Cimahi',
            'Kota Cirebon',
            'Kota Depok',
            'Kota Sukabumi',
            'Kota Tasikmalaya',
        ];

        // Create BPC untuk setiap Kabupaten/Kota
        foreach ($wilayahJabar as $wilayah) {
            // Generate username: bpc_bandung, bpc_kota_bandung, dll
            $username = 'bpc_' . strtolower(str_replace(' ', '_', $wilayah));
            
            // Generate email: bpc.bandung@hipmi.com, bpc.kotabandung@hipmi.com
            $email = 'bpc.' . strtolower(str_replace(' ', '', $wilayah)) . '@hipmi.com';
            
            // Nama Admin
            $name = str_contains($wilayah, 'Kota') 
                ? 'Admin BPC ' . $wilayah 
                : 'Admin BPC Kabupaten ' . $wilayah;
            
            Admin::create([
                'name' => $name,
                'username' => $username,
                'email' => $email,
                'password' => $password,
                'category' => 'bpc',
                'domisili' => $wilayah,
            ]);
        }

        // BPD Jawa Barat (tidak perlu domisili)
        Admin::create([
            'name' => 'Admin BPD Jawa Barat',
            'username' => 'adminbpd',
            'email' => 'adminbpd@hipmi.com',
            'password' => $password,
            'category' => 'bpd',
            'domisili' => null,
        ]);
    }
}