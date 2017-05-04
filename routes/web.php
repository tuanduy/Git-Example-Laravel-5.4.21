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
//3. Creating a simple form
Route::get('userform', function ()
{
  return View::make('userform');
});
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
