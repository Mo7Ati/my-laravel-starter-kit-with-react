<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\Category;
use App\Models\Product;
use App\Models\Store;
use App\Models\StoreCategory;
use App\Models\User;
use Database\Factories\CategoryFactory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();
        // Category::factory(5)->create();
        // Store::factory(10)->create();
        // Product::factory(20)->create();


        // User::factory()->create([
        //     'name' => 'Dawly',
        //     'email' => 'dawly@ps.com',
        //     'password' => Hash::make('password'),
        // ]);

        Admin::create([
            'name' => 'Admin',
            'email' => 'admin@ps.com',
            'password' => 'password',
        ]);

        Store::create([
            'name' => [
                'en' => 'Dawly',
                'ar' => 'متجر السيد داولي',
            ],
            'description' => [
                'en' => 'Dawly Store',
                'ar' => 'متجر السيد داولي',
            ],
            'address' => [
                'en' => 'Dawly Address',
                'ar' => 'عنوان السيد داولي',
            ],
            'keywords' => [
                'en' => 'Dawly Keywords',
                'ar' => 'كلمات السيد داولي',
            ],
            'email' => 'store@ps.com',
            'phone' => '01234567890',
            'password' => '123456',
            'delivery_time' => 10,
            'delivery_area_polygon' => json_encode([]),
            'is_active' => true,
        ]);

        // StoreCategory::create([
        //     'name' => [
        //         'en' => 'Electronics',
        //         'ar' => 'إلكترونيات',
        //     ],
        //     'description' => [
        //         'en' => 'Electronics All Yo Want',
        //         'ar' => 'كل الإلكترونيات التي تحتاجها',
        //     ]
        // ]);
        // Category::create([
        //     'name' => [
        //         'en' => 'Electronics',
        //         'ar' => 'إلكترونيات',
        //     ],
        //     'description' => [
        //         'en' => 'Electronics All Yo Want',
        //         'ar' => 'كل الإلكترونيات التي تحتاجها',
        //     ]
        // ]);

        // Store::factory()->count(100)->create();
        // Product::factory()->count(50)->create();
        // Admin::factory()->count(100)->create();

        $this->call([
            // CustomerSeeder::class,
            // OrderSeeder::class,
        ]);
    }
}
