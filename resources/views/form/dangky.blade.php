@if(count($errors) > 0)
  <ul>
    @foreach ($errors->all() as $value)
      <li>{!! $value !!}</li>
    @endforeach
  </ul>
@endif
{!! Form::open(array('route'=>'postDangKy','files'=>true)) !!}
<table>
  <tr>
    <td>{!! Form::label('hoten', 'Môn Học',array('class'=>'modi1')) !!}</td>
    <td>{!! Form::text('txtMonHoc','', array('class' => 'input')) !!}</td>
    <td>{!!$errors->first('txtMonHoc')!!}</td>

  </tr>
  <tr>
    <td>{!! Form::label('hoten', 'Giá Tiền',array('class'=>'modi1')) !!}</td>
    <td>{!! Form::text('txtGiaTien','', array('class' => 'input')) !!}</td>
    <td>{!!$errors->first('txtGiaTien')!!}</td>
  </tr>
  <tr>
    <td>{!! Form::label('hoten', 'Giảng Viên',array('class'=>'modi1')) !!}</td>
    <td>{!! Form::text('txtGiangVien','', array('class' => 'input')) !!}</td>
    <td>{!!$errors->first('txtGiangVien')!!}</td>
  </tr>
  <tr>
    <td>{!! Form::label('txtupload', 'Hình ảnh',array('class'=>'modi1')) !!}</td>
    <td>{!! Form::file('fImage') !!}</td>
  </tr>
  <tr>
    <td></td>
    <td>{!! Form::submit('Thêm') !!}</td>
  </tr>
</table>
{!! Form::close() !!}
