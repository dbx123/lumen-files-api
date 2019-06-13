<?php

use Illuminate\Database\Seeder;
use App\Models\File;

class FilesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        File::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        File::create([
            'name' => 'publicdomainpictures.jpg',
            'size' => '21035',
            'path' => '/var/www/html/app/public/uploads/5d02787e0f01f_publicdomainpictures.jpg'
        ]);

        File::create([
            'name' => 'newoldstock.jpg',
            'size' => '18334',
            'path' => '/var/www/html/app/public/uploads/5d027903415d8_newoldstock.jpg'
        ]);

        File::create([
            'name' => 'pickupimage.jpg',
            'size' => '17872',
            'path' => '/var/www/html/app/public/uploads/5d02792a15666_pickupimage.jpg'
        ]);

        File::create([
            'name' => 'publicdomainarchive.jpg',
            'size' => '26545',
            'path' => '/var/www/html/app/public/uploads/5d027955d76f7_publicdomainarchive.jpg'
        ]);

        File::create([
            'name' => 'splitshire.jpg',
            'size' => '25366',
            'path' => '/var/www/html/app/public/uploads/5d02797e79d87_splitshire.jpg'
        ]);

        File::create([
            'name' => 'libreshot.jpg',
            'size' => '22622',
            'path' => '/var/www/html/app/public/uploads/5d0279a4c6d2b_libreshot.jpg'
        ]);

        File::create([
            'name' => 'skitterphoto.jpg',
            'size' => '24636',
            'path' => '/var/www/html/app/public/uploads/5d0279cae39e5_skitterphoto.jpg'
        ]);

        File::create([
            'name' => 'stocksnap.jpg',
            'size' => '19611',
            'path' => '/var/www/html/app/public/uploads/5d0279e8755e9_stocksnap.jpg'
        ]);

        File::create([
            'name' => 'pdpics.jpg',
            'size' => '20301',
            'path' => '/var/www/html/app/public/uploads/5d027a0dd71a8_pdpics.jpg'
        ]);
    }
}
