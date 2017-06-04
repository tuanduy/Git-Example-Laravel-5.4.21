<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(Car_ColorTableSeeder::class);
    }
}


class ProductTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('product')->insert([
              array('name'=>'Quần đá banh 1', 'price'=>5200, 'product_id'=>2),
              array('name'=>'Quần đá banh 2', 'price'=>5600, 'product_id'=>2),
              array('name'=>'Quần đá banh 3', 'price'=>5700, 'product_id'=>2),
              array('name'=>'Quần đá banh 4', 'price'=>5900, 'product_id'=>2),
              array('name'=>'Vợt cầu lông 1', 'price'=>7300, 'product_id'=>3),
              array('name'=>'Vợt cầu lông 2', 'price'=>5200, 'product_id'=>3),
              array('name'=>'Vợt cầu lông 3', 'price'=>5600, 'product_id'=>3),
              array('name'=>'Vợt cầu lông 4', 'price'=>7100, 'product_id'=>3),
              array('name'=>'Mũ đẹp 1', 'price'=>5500, 'product_id'=>4),
              array('name'=>'Mũ đẹp 2', 'price'=>5200, 'product_id'=>4),
              array('name'=>'Mũ đẹp 3', 'price'=>5300, 'product_id'=>4),
              array('name'=>'Mũ đẹp 4', 'price'=>5400, 'product_id'=>4),
        ]);
    }
}
class CateNewsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('cate_news')->insert([
              ['name'=>'The gioi'],
              ['name'=>'The thao'],
              ['name'=>'Am nhac'],
              ['name'=>'Video'],
        ]);
    }
}
class NewsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('news')->insert([
              ['title'=>'tieu de 1','intro'=>'day la intro 4', 'cate_id'=>1],
              ['title'=>'tieu de 2','intro'=>'day la intro 2', 'cate_id'=>1],
              ['title'=>'tieu de 3','intro'=>'day la intro 1', 'cate_id'=>1],
              ['title'=>'tieu de 4','intro'=>'day la intro 2', 'cate_id'=>1],
        ]);
    }
}

class ImagesTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('images')->insert([
          ['name'=>'Hinh quan đá banh 1-1.png', 'product_id'=>1],
          ['name'=>'Hinh quan đá banh 1-2.png', 'product_id'=>1],
          ['name'=>'Hinh quan đá banh 1-3.png', 'product_id'=>1],
          ['name'=>'Hinh quan đá banh 1-4.png', 'product_id'=>1],
          ['name'=>'Hinh quan đá banh 2-1.png', 'product_id'=>2],
          ['name'=>'Hinh quan đá banh 2-2.png', 'product_id'=>2],
          ['name'=>'Hinh quan đá banh 2-3.png', 'product_id'=>2],
          ['name'=>'Hinh quan dá banh 3-1.png', 'product_id'=>3],
          ['name'=>'Hinh quan dá banh 3-2.png', 'product_id'=>3],
          ['name'=>'Hinh quan dá banh 3-3.png', 'product_id'=>3],
          ['name'=>'Hinh quan dá banh 3-4.png', 'product_id'=>3],
          ['name'=>'Hinh vợt cầu lông 1-1.png', 'product_id'=>5],
          ['name'=>'Hinh vợt cầu lông 1-2.png', 'product_id'=>5],
          ['name'=>'Hinh vợt cầu lông 1-3.png', 'product_id'=>5],
          ['name'=>'Hinh vợt cầu lông 1-4.png', 'product_id'=>5],
          ['name'=>'Hinh vot cầu lông 8-1.png', 'product_id'=>8],
          ['name'=>'Hinh vot cầu lông 8-12.png', 'product_id'=>8],
          ['name'=>'Hinh vot cầu lông 8-13.png', 'product_id'=>8],
          ['name'=>'Hinh vot cầu lông 8-4.png', 'product_id'=>8],
          ['name'=>'Hinh mu di bien 1-1.png', 'product_id'=>9],
          ['name'=>'Hinh mu di bien 1-2.png', 'product_id'=>9],
          ['name'=>'Hinh mu di bien 1-3.png', 'product_id'=>9],
          ['name'=>'Hinh mu di bien 1-4.png', 'product_id'=>9]
        ]);
    }
}
class CarTableSeeder extends seeder
{
    public function run()
    {
      DB::table('car')->insert([
        ['name'=>'BMW','price'=>500000000],
        ['name'=>'Audi','price'=>420000000],
        ['name'=>'Honda','price'=>330000000],
        ['name'=>'Suzuki','price'=>100000000],
        ['name'=>'Porsche','price'=>700000000],
        ['name'=>'Huyndai','price'=>230000000],
        ['name'=>'Komatsu','price'=>120000000]
      ]);
    }
}

class ColorTableSeeder extends seeder
{
    public function run()
    {
      DB::table('colors')->Insert([
        ['name'=>'red'],
        ['name'=>'blue'],
        ['name'=>'black'],
        ['name'=>'white']
      ]);
    }
}
class Car_ColorTableSeeder extends seeder
{
    public function run()
    {
      DB::table('car_colors')->insert([
        ['car_id'=>1,'colors_id'=>1],
        ['car_id'=>2,'colors_id'=>1],
        ['car_id'=>3,'colors_id'=>1],
        ['car_id'=>4,'colors_id'=>2],
        ['car_id'=>4,'colors_id'=>3],
        ['car_id'=>4,'colors_id'=>4],
        ['car_id'=>5,'colors_id'=>1]
      ]);
    }
}
