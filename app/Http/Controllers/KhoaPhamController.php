<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\KhoaPham;
use App\Http\Requests\KhoaPhamRequest;


class KhoaPhamController extends Controller
{
    public function them(KhoaPhamRequest $request)
    {
      $img = $request->file('fImage');
      $img_name = $img->getClientOriginalName();

      $khoapham = new KhoaPham;
      $khoapham ->monhoc =$request->txtMonHoc;
      $khoapham ->giatien =$request->txtGiaTien;
      $khoapham ->gianvien = $request->txtGiangVien;
      $khoapham ->image = $img_name;
      $khoapham->save();

      $des = 'upload/images';
      $img->move($des,$img_name);
      return redirect('form/dangky');

      // $khoapham = new KhoaPham;
      // $khoapham ->monhoc =$request->txtMonHoc;
      // $khoapham ->giatien =$request->txtGiaTien;
      // $khoapham ->gianvien = $request->txtGiangVien;
      // $khoapham->save();
      // return redirect('form/dangky');
      // return $request->file('fImage');
      //
      // echo "<pre>";
      // print_r($request->file('fImage')->getSize());
      // echo"</pre>";
      //
      // echo "<pre>";
      // echo "Tên hình :".$request->file('fImage')->getClientOriginalName()."<br />";
      // echo "Kích thước :".$request->file('fImage')->getSize()." Kb"."<br />";
      // echo "Đường dẫn :".$request->file('fImage')->getRealPath()."<br />";
      // echo "Loại :".$request->file('fImage')->getMimeType()."<br />";
      // echo "</pre>";
      // $img = $request->file('fImage');
      // $des = 'upload/images';
      // $img_name = $img->getClientOriginalName();
      // $img->move($des,$img_name);

    }
}
