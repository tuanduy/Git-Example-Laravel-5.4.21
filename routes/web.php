<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function (){
    return view('welcome');
});
Route::get('ifo', function()
{
  return ;
});
//1.2 Router structure
//route with conditions only number no limit
Route::get('codition/{number}', function($ten)
{
  return "Đây là số: ".$ten;
})->where(['number'=>'[0-9]+']);
//Route wiht conditions only characters no limit
Route::get('condition-char/{name}', function($name1)
{
  return "This is my Name: ".$name1;
})->where(['name'=> '[a-zA-Z]+']);
//Route with condition only letter must 6 characters
Route::get('condition-char-limit/{your_name}', function($name2)
{
  return "Are your name: ".$name2." ?";
})->where(['your_name' => '[a-z]{6}']);
//Route wiht conditions only characters and number no limit
Route::get('condition-char-number/{name_number}', function($name3)
{
  return "This is my Name: ".$name3;
})->where(['name_number'=> '[0-9a-zA-Z]+']);
//Route with multiplevariable and condition for variable
Route::get( 'name_numer_condition/{tenjk}/{stt}' , function($ten, $phone)
{
           return "Chào bạn: ".$ten." "."Số điện thoại: ".$phone;
})->where([ 'tenjk' => '[a-zA-Z]+'],[ 'stt' => '[0-9]+']);
//-End
//1.3 Route call view basic
Route::get('call-view/{your?}', function($you = ' ')
{
  $name = "i love you";
  return View('thisview',compact('name','you'));
});
//-End
//1.4. Route call function from controller
Route::get('test-action', 'Controller@testAction');
Route::get('test-action-val/{val}/{hjj}', 'Controller@testActionValue');
//-End
//1.5. Route Identification
Route::get('test-identification', 'Controller@testIdentification');
Route::get('identification',['as'=>'ide', function()
{
  return "This is identification";
}]);
//-End
//1.6. Route group
Route::group(['prefix'=>'thuc-don'], function ()
{
  Route::get('bun-bo', function()
  {
      echo "Đây là trang bún bò";
  });
  Route::get('bun-man', function()
  {
      echo "Đây là trang bún măng";
  });
  Route::get('bun-moc', function()
  {
      echo "Đây là trang bún mộc";
  });
});
//-End
//2. Create View
Route::get('goi-view', function()
{
  return View('layouts.sub_layout.sub_view');
});
Route::get('goi-view-2', function()
{
  return View('layouts.sub_layout.sub_view_2');
});
//2.1. View share
View::share('variable_name','Đây là nội dung cần chia sẽ !');
//2.2. View Composer
View::Composer('layouts.sub_layout.sub_view', function($bien){
  return $bien->with('thongtin','Đây là trang chia sẽ <br>');
});
//2.3 View check View Exists
Route::get('check-view', function()
{
  if (view()->exists('layouts.sub_layout.sub_view_2')) {
    return "Tồn tại view";
  }else {
    return "Không tồn tại view";
  }
});
//-End
//3. Blade template
Route::get('goi-master', function()
{
  return view('master.master_view');
});
Route::get('goi-sub', function()
{
  return view('master.sub_view');
});
Route::get('goi-layout', function()
{
  return view('master.layout_view');
});
//-End
//bài 11. URL
/*
 trả về giá trị đường dẫn trên thanh địa chỉ
*/
Route::get('url/full', function()
{
  return URL::full();
});
Route::get('url/asset', function()
{
  return asset('css/mystyle.css',true);
});
/*
Dùng để nhúng vào thẻ <a> href để dẫn đến 1 trang khác
hoặc get một dường dẫn mới về
*/
Route::get('url/to', function()
{
//  return URL::to('test-action-val',['dsfsdfs','123465']);
  return URL::to('test-action-val',['dsfsdfs','123465'], true);
});
/*
chỉ sử dụng cho https với phương thức ssl
*/
Route::get('url/secure', function()
{
  return secure_url('test-action-val',['dsfsdfs','123465']);
});
//13. SCHEMA BUILDER
Route::get('schema/create', function()
{
  Schema::create('khoapham',function($table)
  {
      $table->increments('id');
      $table->string('tenmonhoc');
      $table->integer('gia');
      $table->text('ghichu')->nullable();
      $table->timestamps();
  });
});
/*
Đổi tên bảng trong database
*/
Route::get('schema/rename', function()
{
  Schema::rename('khoapham','kpt');
});
/*
Xóa 1 bảng
*/
Route::get('schema/drop', function()
{
  Schema::drop('product');
});
Route::get('schema/drop-ext', function()
{
  Schema::dropIfExists('kpt');
});
/*
Thay đổi thuộc tính của một cột
*/
Route::get('schema/change-col-attr', function()
{
  Schema::table('khoapham',function($table)
  {
    $table->string('tenmonhoc',50)->change();
  });
});
/*
Xóa 1 cột
*/
Route::get('schema/drop-col', function()
{
  Schema::table('khoapham',function($table)
  {
    $table->dropColumn('ghichu');
  });
});
Route::get('schema/drop-colm', function()
{
  Schema::table('khoapham',function($table)
  {
    $table->dropColumn(['tenmonhoc','gia']);
  });
});
/*
Tạo khóa ngoại
*/
Route::get('schema/create/cate', function()
{
  Schema::create('categogy',function($table)
  {
      $table->increments('id');
      $table->string('name');
      $table->timestamps();
  });
});
Route::get('schema/create/product', function()
{
  Schema::create('product',function($table)
  {
      $table->increments('id');
      $table->string('name');
      $table->string('price');
      $table->integer('product_cate_id')->unsigned();
      $table->foreign('product_cate_id')->references('id')->on('categogy')->onDelete('cascade');
      $table->timestamps();
  });
});
//3. Creating a simple form
Route::get('userform', function ()
{
  return View::make('userform');
});
//-End

//Bai 21 Query Builder
//21.1. Query Builder Select All data
Route::get('query/select-all', function()
{
  $data = DB::table('product')->get();
  echo "<pre>";
  print_r($data);
  echo "<pre>";
});
//21.2. Query Builder Select column
Route::get('query/select-columm', function()
{
  $data = DB::table('product')->select('name')->get();
  echo "<pre>";
  print_r($data);
  echo "<pre>";
});
//21.3. Query Builder Select column where
Route::get('query/select-where', function()
{
  $data = DB::table('product')->select('name')->where('id',2)->get();
  echo "<pre>";
  print_r($data);
  echo "<pre>";
});
//21.4. Query Builder Select column where or quare
Route::get('query/select-orwhere', function()
{
  $data = DB::table('product')->select('name')->where('id',2)->orWhere('price',5000)->get();
  echo "<pre>";
  print_r($data);
  echo "<pre>";
});
//21.4.1. Query Builder Select column where or quare
Route::get('query/select-whereandwhere', function()
{
  $data = DB::table('product')->select('name')->where('id',2)->Where('price',5000)->get();
  echo "<pre>";
  print_r($data);
  echo "<pre>";
});
//-End
//21.5. Query Builder Select order by
Route::get('query/orderBy', function()
{
  $data = DB::table('product')->orderBy('id','DESC')->get();
  echo "<pre>";
  print_r($data);
  echo "<pre>";
});
Route::get('query/orderBy', function()
{
  $data = DB::table('product')->select('name')->where('price',5000)->orderBy('id','DESC')->get();
  echo "<pre>";
  print_r($data);
  echo "<pre>";
});
//-End
//21.6 Query Builder Select limit
Route::get('query/offsetlimit', function()
{
  $data = DB::table('product')->skip(2)->take(3)->get();
  echo "<pre>";
  print_r($data);
  echo "<pre>";
});
//-End
//21.6 Query Builder Select limit
Route::get('query/offsetlimit', function()
{
  $data = DB::table('product')->skip(2)->take(3)->get();
  echo "<pre>";
  print_r($data);
  echo "<pre>";
});
//-End
//21.7 Query Builder Select where between
Route::get('query/wherebetween', function()
{
  $data = DB::table('product')->whereBetween('id',[2,4])->get();
  echo "<pre>";
  print_r($data);
  echo "<pre>";
});
//-End
//21.8 Query Builder Select where Not Between
Route::get('query/wherenotbetween', function()
{
  $data = DB::table('product')->whereNotBetween('id',[2,4])->get();
  echo "<pre>";
  print_r($data);
  echo "<pre>";
});
//-End
//21.9 Query Builder Select where In
Route::get('query/whereIn', function()
{
  $data = DB::table('product')->whereIn('id',[2,4,8])->get();
  echo "<pre>";
  print_r($data);
  echo "<pre>";
});
//-End
//21.9.1 Query Builder Select where Not In
Route::get('query/whereNotIn', function()
{
  $data = DB::table('product')->whereNotIn('id',[2,4,8])->get();
  echo "<pre>";
  print_r($data);
  echo "<pre>";
});
//-End
//21.11 Query Builder Count Row
Route::get('query/count', function()
{
  $data = DB::table('product')->count();
  echo "<pre>";
  print_r($data);
  echo "<pre>";
});
//-End
//21.12 Query Builder max Row
Route::get('query/max', function()
{
  $data = DB::table('product')->max('price');
  echo "<pre>";
  print_r($data);
  echo "<pre>";
});
//-End
//21.12 Query Builder min Row
Route::get('query/min', function()
{
  $data = DB::table('product')->min('price');
  echo "<pre>";
  print_r($data);
  echo "<pre>";
});
//-End
//21.13 Query Builder AVG row
Route::get('query/avg', function()
{
  $data = DB::table('product')->avg('price');
  echo "<pre>";
  print_r($data);
  echo "<pre>";
});
//-End
//21.13 Query Builder sum row
Route::get('query/sum', function()
{
  $data = DB::table('product')->sum('price');
  echo "<pre>";
  print_r($data);
  echo "<pre>";
});
//-End
//24 Query Builder joins
Route::get('schema/create/cateNew', function()
{
  Schema::create('cate_news',function($table)
  {
      $table->increments('id');
      $table->string('name');
      $table->timestamps();
  });
});
Route::get('schema/create/news', function()
{
  Schema::create('news',function($table)
  {
      $table->increments('id');
      $table->string('title');
      $table->string('intro');
      $table->integer('cate_id')->unsigned();
      $table->timestamps();
  });
});

Route::get('query/join', function()
{
  $data = DB::table('news')->select('title','name')->join('cate_news','news.cate_id','=','cate_news.id')->get();
  echo "<pre>";
  print_r($data);
  echo "<pre>";
});
//-End
//25.1 Query Builder Insert
Route::get('query/insert', function()
{
  DB::table('product')->insert([
    ['name'=>'Quan di bien', 'price'=>50000, 'product_cate_id'=>2],
  ]);
  return 'Insert thanh cong';
});
//-End
//25.2 Query Builder Insert return id end
Route::get('query/insert-get-id', function()
{
  $id = DB::table('product')->insertGetId(
    ['name'=>'Quan di bien dd', 'price'=>5100, 'product_cate_id'=>3]
  );
  echo $id;
});
//-End
//25.3 Query Builder Update
Route::get('query/Update', function()
{
  DB::table('product')->Where('id',5)->update(
    ['name'=>'Quan di bien 123', 'price'=>5200, 'product_cate_id'=>3]
  );
  return 'Update thanh cong';
});
//-End
//25.3.1 Query Builder Update where >
Route::get('query/Updatethan', function()
{
  DB::table('product')->Where('id','>',7)->update(
    ['name'=>'Quan di bien 1234', 'price'=>5123]
  );
  return 'Update thanh cong';
});
//-End
//25.4. Query Builder Delete
Route::get('query/delete', function()
{
  DB::table('product')->Where('id',7)->delete();
  return 'Xoa thanh cong';
});
//-End
//25.4.1 Query Builder Delete <=
Route::get('query/deleteLessEqua', function()
{
  DB::table('product')->Where('id','<=',6)->delete();
  return 'Xoa thanh cong';
});
//-End
//27. Eloquent ORM get data from table
Route::get('model/select-all', function()
{
  $data = App\product::all()->toArray();
  echo "<pre>";
  print_r($data);
  echo "<pre>";
});


Route::get('model/select-id', function()
{
  $data = App\product::find(8)->tojSon();
  echo "<pre>";
  print_r($data);
  echo "<pre>";
});

Route::get('model/select-findOrFail', function()
{
  $data = App\product::findOrFail(2)->tojSon();
  echo "<pre>";
  print_r($data);
  echo "<pre>";
});

//-End
//28. Eloquent ORM
Route::get('model/where', function()
{
  $data = App\Product::where('price',5123)->get()->toArray();
  echo "<pre>";
  print_r($data);
  echo "<pre>";
});

Route::get('model/take', function()
{
  $data = App\Product::where('price',5123)->firstOrFail()->take(2)->get()->toArray();
  echo "<pre>";
  print_r($data);
  echo "<pre>";
});

Route::get('model/raw', function()
{
  $data = App\Product::WhereRaw('price = ? AND id = ?',[5123,8])->get()->toArray();
  echo "<pre>";
  print_r($data);
  echo "<pre>";
});
//-End
//29. Eloquent ORM with select
Route::get('model/select', function(App\Product $product)
{
  $data = $product::WhereRaw('price = ? AND id = ?',[5123,8])->select('name')->get()->toArray();
  echo "<pre>";
  print_r($data);
  echo "<pre>";
});
//-End
//30. Eloquent ORM with Insert, Update

Route::get('model/insert', function()
{
  $product = new App\Product;
  $product->name = 'quan cong so';
  $product->price = 5000;
  $product->product_cate_id = 3;
  $product->save();
  echo "them thanh cong";
});

Route::get('model/create', function()
{
  $data = array(
    'name'=>' Quan jean kaki',
    'price'=>'54222',
    'product_cate_id'=>'3'
  );
  App\Product::create($data);
});
//Update data
Route::get('model/update', function()
{
  $product = App\Product::find(11);
  $product->price = 1;
  $product->save();
});
//Delete data
Route::get('model/delete', function()
{
  App\Product::destroy(12);
});
//-End

//32. Eloquent ORM Relation  one-many
Route::get('relation/one-many', function()
{
  $data = App\Product::find(2)->images()->get()->toArray();
  echo "<pre>";
  print_r($data);
  echo "</pre>";
});

Route::get('relation/one-many-1', function()
{
  $data = App\Images::find(2)->product()->get()->toArray();
  echo "<pre>";
  print_r($data);
  echo "</pre>";
});
//-End
//33. Eloquent ORM Relation  many-many
Route::get('relation/many-many', function()
{
  $data = App\Car::find(4)->color()->get()->toArray();
  echo "<pre>";
  print_r($data);
  echo "<\pre>";
});

Route::get('relation/many-many-1', function()
{
  $data = App\Colors::find(1)->car()->get()->toArray();
  echo "<pre>";
  print_r($data);
  echo "<\pre>";
});
//-End
//35.Form
Route::get('form/layout12', function()
{
  return View('form/layout');
});

Route::post('form/data',['as'=>'sendEmail',function()
{
    return "Ok";
}]);
//-End

//36. form
Route::get('form/dangky', function()
{
  return View('form.dangky');
});

Route::post('form/dang-ky-thanh-vien',['as'=>'postDangKy','uses'=>'KhoaPhamController@them']);
//-End
// 39.Form
Route::any('{all}', function()
{
  return view('welcome');
})->where('all', '.*');
//-End

//4. Gathering form input to display on another page
Route::post('userform', function()
{
   	 // Process the data here
    	return Redirect::to('userresults')->withInput(Input::only('username', 'color'));
});

Route::get('userresults', function()
{
    return 'Your username is: '. Input::old('username').'<br>Your favorite color is: '. Input::old('color');
});
//-End
//11. Cropping an image with Jcrop
Route::get('imageform', function()
{
    return View::make('imageform');
});

Route::post('imageform', function()
{
    $rules = array(
        'image' => 'required|mimes:jpeg,jpg|max:10000'
    );

    $validation = Validator::make(Input::all(), $rules);

    if ($validation->fails()) {
        return Redirect::to('imageform')->withErrors($validation);
    }else {
        $file = Input::file('image');
        $file_name = $file->getClientOriginalName();
        if ($file->move('images', $file_name)) {
            return Redirect::to('jcrop')->with('image',$file_name);
        }else {
            return "Error uploading file";
        }
    }
});

Route::get('jcrop', function()
{
    return View::make('jcrop')->with('image', 'images/'. Session::get('image'));
});

Route::post('jcrop', function()
{
    $quality = 90;

    $src  = Input::get('image');
    $img  = imagecreatefromjpeg($src);
    $dest = ImageCreateTrueColor(Input::get('w'),Input::get('h'));

    imagecopyresampled($dest, $img, 0, 0, Input::get('x'),Input::get('y'), Input::get('w'), Input::get('h'),Input::get('w'), Input::get('h'));
    imagejpeg($dest, $src, $quality);

    return "<img src='" . $src . "'>";
});
//-End

//12. Creating an autocomplete text input
Route::get('autocomplete', function()
{
    return View::make('autocomplete');
});

Route::get('getdata', function()
{
		$term = Str::lower(Input::get('term'));
		$data = array(
			'R' => 'Red',
			'O' => 'Orange',
			'Y' => 'Yellow',
			'G' => 'Green',
			'B' => 'Blue',
			'I' => 'Indigo',
			'V' => 'Violet',
		);
		$return_array = array();
		foreach ($data as $k => $v) {
			if (strpos(Str::lower($v), $term) !== FALSE) {
				$return_array[] = array('value' => $v, 'id' => $k);
			}
		}
		return Response::json($return_array);
});
//-End
//13. Making a CAPTCHA-style spam catcher
Route::get('captcha', function()
{
		$captcha = new Captcha;
		$cap = $captcha->make();
		return View::make('captcha')->with('cap', $cap);
});

Route::post('captcha', function()
{
  if (Session::get('my_captcha') !==Input::get('captcha')) {
    Session::flash('captcha_result', 'No Match.');
  }else {
    Session::flash('captcha_result', 'They Match!');
  }
  return Redirect::to('captcha');
});
//-End
//14. Setting up and configuring the Auth library

//-End
