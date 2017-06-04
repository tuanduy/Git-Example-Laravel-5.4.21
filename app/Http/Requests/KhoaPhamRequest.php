<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class KhoaPhamRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     * nếu sử dụng thì phải đổi false sang true
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     * là điều kiện luật để sử dụng
     * @return array
     */
    public function rules()
    {
        return
          [
            'txtMonHoc'=>'required|unique:kpt_khoapham,monhoc',
            'txtGiaTien'=>'required|numeric',
            'txtGiangVien'=>'required',
            'fImage'      =>'required|image|max:15'
          ];
    }
    public function messages ()
    {
      return
        [
          'txtMonHoc.required'=>'Vui lòng nhập tên môn học',
          'txtGiaTien.required'=>'Vui lòng nhập giá tiền',
          'txtGiangVien.required'=>'Vui lòng nhập tên giảng viên',
          'txtMonHoc.unique'=>'Tên môn học này đã tồn tại',
          'txtGiaTien.numeric'=>'Vui lòng nhập giá tiền ở dạng số'

        ];
    }
}
