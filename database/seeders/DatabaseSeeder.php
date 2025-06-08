<?php

namespace Database\Seeders;

use App\Models\News;
use App\Models\NewsCategory;
use App\Models\SettingWebsite;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Role::create(['name' => 'pengurus']);
        Role::create(['name' => 'jamaah']);

        User::create([
            'name' => 'Fajri - Developer',
            'email' => 'fajri@gariskode.com',
            'phone' => '089613390766',
            'address' => 'Jl. Sawahan V No.1, Sawahan, Kec. Padang Tim., Kota Padang, Sumatera Barat',
            'password' => bcrypt('password'),
        ])->assignRole('pengurus');

        SettingWebsite::create([
            'name' => 'Mushalla Nurul Haq',
            'logo' => 'logo.png',
            'favicon' => 'favicon.png',
            'email' => 'muhallanurulhaq@torkatatech.com',
            'phone' => '089613390766',
            'address' => 'jl tabek batu komplek melati arenatama selaras, blok L 11, Kota Padang, Sumatera Barat 25175',
            'latitude' => '-0.32177371869479526',
            'longitude' => '100.39795359131934',
            'about' => 'Mushalla Nurul Haq adalah tempat ibadah yang terletak di Kota Padang, Sumatera Barat. Kami menyediakan berbagai layanan keagamaan dan sosial untuk masyarakat sekitar.',
        ]);

        NewsCategory::create([
            'name' => 'Teknologi',
            'slug' => 'teknologi',
            'description' => 'Berita dan informasi terbaru seputar teknologi.',
        ]);
        NewsCategory::create([
            'name' => 'Bisnis',
            'slug' => 'bisnis',
            'description' => 'Berita dan informasi terbaru seputar bisnis.',
        ]);
        NewsCategory::create([
            'name' => 'Tips & Trik',
            'slug' => 'tips-trik',
            'description' => 'Berita dan informasi terbaru seputar tips dan trik digital.',
        ]);

        News::factory(4)->create();
    }
}
