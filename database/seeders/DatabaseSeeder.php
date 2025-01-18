<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Image;
use App\Models\Product;
use App\Models\SiteSetting;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        \App\Models\User::factory(1)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $products = [
            [
                'name' => 'ORGANIC HONEY COLA KOMBUCHA',
                'description' => 'Discover the essence of pure indulgence with our Organic Honey Cola. Crafted with care using only the finest organic ingredients, this drink offers a delightful blend of familiar cola flavor infused with the natural sweetness of pure honey. Each sip tantalizes your taste buds with a harmonious balance of flavors, delivering a refreshing and satisfying experience that\'s unlike any other. But it\'s not just about taste—it\'s about making a conscious choice for your health and the environment. With organic certification and eco-friendly packaging, our Organic Honey Cola reflects our commitment to sustainability and quality.',
                'price' => 100,
                'image' => 'product-image/honey-cola.png'
            ],
            [
                'name' => 'ORGANIC PINEAPPLE & MANGO KOMBUCHA',
                'description' => 'Our organic pineapple and mango kombucha is a delightful subtle fusion of delicious natural tropical sweetness - with no added sugar, offering a refreshing and unique drink experience. This wonderful flavor combination brings you the tangy essence of beautifully ripe pineapples with the familiar sharpness of tropical mango. The natural kombucha effervescence and sourness of this blend bring a true taste sensation which has to be experienced. It is a harmony made in heaven! Imagine taking a sip and being greeted by the juicy, vibrant flavors of tropical paradise, followed by the tanginess and spice of the organic kombucha - flavors of cinnamon, nutmeg, rich pineapple, and zesty fermented kombucha - it\'s a match made for the gods.',
                'price' => 100,
                'image' => 'product-image/pineapple-mango-flavour.png'
            ],
            [
                'name' => 'ORGANIC CHERRY COLA',
                'description' => 'Introducing our Organic Cherry Cola—a beverage crafted with care and bursting with flavor. Our cola starts with the finest organic ingredients, ensuring a drink that\'s not just delicious but also free from synthetic additives and chemicals. But what sets our Cherry Cola apart is the infusion of real cherry flavor. We\'ve captured the essence of ripe cherries, adding a touch of natural sweetness and a burst of fruity freshness to every sip. It\'s a symphony of flavors, with the familiar taste of cola harmonizing perfectly with the vibrant notes of cherry. With each refreshing gulp, you\'ll taste the difference that real ingredients make. Gone are the artificial flavors and cloying sweetness of conventional colas.',
                'price' => 100,
                'image' => 'product-image/cherry-cola.png'
            ],
        ];

        // Create products and their associated images
        foreach ($products as $productData) {
            $product = Product::create([
                'name' => $productData['name'],
                'description' => $productData['description'],
                'price' => $productData['price']
            ]);
            Image::create([
                'image_path' => $productData['image'],
                'product_id' => $product->id
            ]);
        }


        SiteSetting::create(['payment_active' => true]);
    }
}
