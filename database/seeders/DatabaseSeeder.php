<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Authority;
use App\Models\Category;
use App\Models\Contact;
use App\Models\Product;
use App\Models\Review;
use App\Models\User;
use App\Models\userAuthority;
use Database\Factories\UserAuthorityFactory;
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
        User::truncate();
        Category::truncate();
        Product::truncate();
        Contact::truncate();
        Review::truncate();
        userAuthority::truncate();
        
        User::factory()->create([
            'name' => 'Muhammad Iqbal',
            'email' => 'iqbal@gmail.com',
            'password' => bcrypt('iqbal'),
            'user_type' => 'Admin',
            'user_status' => 'active'
        ]);
        User::factory()->create([
            'name' => 'Muhammad Hassan',
            'email' => 'hassan@gmail.com',
            'password' => bcrypt('hassan'),
            'user_type' => 'Support',
            'user_status' => 'active'
        ]);

        $category = Category::factory()->create([
            'categoryName' => 'Wiring and Cable'
        ]);

        Product::factory(15)->create([
            'productCatId' => $category->id,
            'productImage' => 'notfound.png'
        ]);

        Authority::factory()->create(['authority_name' => 'Dashboard', 'authority_route' => '/dashboard', 'position' => 1]);
        Authority::factory()->create(['authority_name' => 'Product', 'authority_route' => '/admin/products', 'position' => 2]);
        Authority::factory()->create(['authority_name' => 'Order', 'authority_route' => '/admin/orders', 'position' => 3]);
        Authority::factory()->create(['authority_name' => 'User Authorities', 'authority_route' => '/admin/authorities', 'position' => 4]);
        Authority::factory()->create(['authority_name' => 'Profile', 'authority_route' => '/admin/profile', 'position' => 5]);

        
        userAuthority::factory()->create(['email' => 'iqbal@gmail.com', 'authority_name' => 'Dashboard', 'authority_route' => '/dashboard', 'position' => 1, 'user' => 'iqbal@gmail.com']);
        userAuthority::factory()->create(['email' => 'iqbal@gmail.com', 'authority_name' => 'Product', 'authority_route' => '/admin/products', 'position' => 2, 'user' => 'iqbal@gmail.com']);
        userAuthority::factory()->create(['email' => 'iqbal@gmail.com', 'authority_name' => 'Order', 'authority_route' => '/admin/orders', 'position' => 3, 'user' => 'iqbal@gmail.com']);
        userAuthority::factory()->create(['email' => 'iqbal@gmail.com', 'authority_name' => 'User Authorities', 'authority_route' => '/admin/authorities', 'position' => 4, 'user' => 'iqbal@gmail.com']);
        userAuthority::factory()->create(['email' => 'iqbal@gmail.com', 'authority_name' => 'Profile', 'authority_route' => '/admin/profile', 'position' => 5, 'user' => 'iqbal@gmail.com']);

    }
}
