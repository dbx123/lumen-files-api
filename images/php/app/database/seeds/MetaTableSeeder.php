<?php

use Illuminate\Database\Seeder;
use App\Models\Meta;

class MetaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Meta::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        Meta::create([
            'file_id' => 1,
            'name'    => 'size',
            'value'   => '21035'
        ]);

        Meta::create([
            'file_id' => 1,
            'name'    => 'extension',
            'value'   => 'jpg'
        ]);

        Meta::create([
            'file_id' => 2,
            'name'    => 'size',
            'value'   => '18334'
        ]);

        Meta::create([
            'file_id' => 2,
            'name'    => 'extension',
            'value'   => 'jpg'
        ]);

        Meta::create([
            'file_id' => 3,
            'name'    => 'size',
            'value'   => '17872'
        ]);

        Meta::create([
            'file_id' => 3,
            'name'    => 'extension',
            'value'   => 'jpg'
        ]);

        Meta::create([
            'file_id' => 4,
            'name'    => 'size',
            'value'   => '26545'
        ]);

        Meta::create([
            'file_id' => 4,
            'name'    => 'extension',
            'value'   => 'jpg'
        ]);

        Meta::create([
            'file_id' => 5,
            'name'    => 'size',
            'value'   => '25366'
        ]);

        Meta::create([
            'file_id' => 5,
            'name'    => 'extension',
            'value'   => 'jpg'
        ]);

        Meta::create([
            'file_id' => 6,
            'name'    => 'size',
            'value'   => '22622'
        ]);

        Meta::create([
            'file_id' => 6,
            'name'    => 'extension',
            'value'   => 'jpg'
        ]);

        Meta::create([
            'file_id' => 7,
            'name'    => 'size',
            'value'   => '24636'
        ]);

        Meta::create([
            'file_id' => 7,
            'name'    => 'extension',
            'value'   => 'jpg'
        ]);

        Meta::create([
            'file_id' => 8,
            'name'    => 'size',
            'value'   => '19611'
        ]);

        Meta::create([
            'file_id' => 8,
            'name'    => 'extension',
            'value'   => 'jpg'
        ]);

        Meta::create([
            'file_id' => 9,
            'name'    => 'size',
            'value'   => '20301'
        ]);

        Meta::create([
            'file_id' => 9,
            'name'    => 'extension',
            'value'   => 'jpg'
        ]);
    }
}
