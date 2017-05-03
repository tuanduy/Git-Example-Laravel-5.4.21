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
//3. Creating a simple form
Route::get('userform', function (){
  return View::make('userform');
});
//-End
//4. Gathering form input to display on another page
Route::post('userform', function(){
   	 // Process the data here
    	return Redirect::to('userresults')->withInput(Input::only('username', 'color'));
});

Route::get('userresults', function(){
    return 'Your username is: '. Input::old('username').'<br>Your favorite color is: '. Input::old('color');
});
//-End
//11. Cropping an image with Jcrop
Route::get('imageform', function() {
    return View::make('imageform');
});

Route::post('imageform', function() {
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

Route::get('jcrop', function() {
    return View::make('jcrop')->with('image', 'images/'. Session::get('image'));
});

Route::post('jcrop', function() {
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
Route::get('autocomplete', function() {
    return View::make('autocomplete');
});

Route::get('getdata', function() {
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
Route::get('captcha', function() {
		$captcha = new Captcha;
		$cap = $captcha->make();
		return View::make('captcha')->with('cap', $cap);
});
Route::post('captcha', function() {
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
