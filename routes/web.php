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
//5.form validating user input
Route::get('userform1', function(){
    return View::make('userform1');
});
Route::post('userform1', function(){
    $rules = array(
        'email' => 'required|email|different:username',
        'username' => 'required|min:6',
        'password' => 'required|same:password_confirm'
    );
    $validation = Validator::make(Input::all(), $rules);
    if ($validation->fails()){
        return Redirect::to('userform1')->withErrors($validation)->withInput();
    }
    return Redirect::to('userresults1')->withInput();
});
Route::get('userresults1', function(){
    return dd(Input::old());
});
//-End
//6. form file upload
Route::get('fileform', function(){
    return View::make('fileform');
});
Route::post('fileform', function(){
    $file = Input::file('myfile');
    if (isset($file)){
    	$ext = $file->guessExtension();
    	$file->move('files', 'newfilename.'.$ext);
        return 'Success';
    }else{
        return 'Error';
    }
});
//-End
//7. Validating a file upload
Route::get('fileform1', function(){
    return View::make('fileform1');
});
Route::post('fileform1', function(){
    $rules = array(
    	'myfile' => 'mimes:doc,docx,pdf,txt|max:1000'
    );

    $validation = Validator::make(Input::all(), $rules);
    if ($validation->fails()){
		return Redirect::to('fileform1')->withErrors($validation)->withInput();
    }else{
        $file = Input::file('myfile');
        if ($file->move('files', $file->getClientOriginalName())){
            return "Success";
        }else{
            return "Error";
        }
    }
});
//-End
//8. Creating a custom error message
Route::get('myform2', function(){
    return View::make('myform2');
});
Route::post('myform2', array('before' => 'csrf', function(){
    $rules = array(
        'email'    => 'required|email|min:6',
        'username' => 'required|min:6',
        'password' => 'required'
    );

    $messages = array(
        'min' => 'Way too short! The :attribute must be atleast :min characters in length.',
        'username.required' => 'We really, really need aUsername.'
    );

    $validation = Validator::make(Input::all(), $rules,$messages);

    if ($validation->fails()){
        return Redirect::to('myform2')->withErrors($validation)->withInput();
    }
    return Redirect::to('myresults2')->withInput();
}));
Route::get('myresults2', function(){
    return dd(Input::old());
});
//-End
//9. Adding a honey pot to a form
Route::get('myform', function(){
    return View::make('myform');
});
Route::post('myform', array('before' => 'csrf', function(){
    $rules = array(
        'email'    => 'required|email',
        'password' => 'required',
        'no_email' => 'honey_pot'
    );
    $messages = array(
        'honey_pot' => 'Nothing should be in this field.'
    );
    $validation = Validator::make(Input::all(), $rules,$messages);

    if ($validation->fails()){
        return Redirect::to('myform')->withErrors($validation)->withInput();
    }

    return Redirect::to('myresults')->withInput();
}));

Validator::extend('honey_pot', function($attribute, $value,$parameters){
    return $value == '';
});

Route::get('myresults', function(){
    return dd(Input::old());
});
//-End
//10. Uploading an image using Redactor
Route::get('redactor', function(){
    return View::make('redactor');
});

Route::post('redactorupload', function(){

    $rules = array(
        'file' => 'image|max:10000'
    );

    $validation = Validator::make(Input::all(), $rules);
    $file = Input::file('file');

    if ($validation->fails()){
        return FALSE;
    }else{
        if ($file->move('files', $file->getClientOriginalName())){
            return Response::json(array('filelink' => 'files/' . $file->getClientOriginalName()));
        }else{
            return FALSE;
        }
    }
});

Route::post('redactor', function(){
    return dd(Input::all());
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
