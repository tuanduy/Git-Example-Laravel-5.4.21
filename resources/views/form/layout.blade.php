{!! Form::open(array('route'=>'sendEmail','files'=>true)) !!}
{!! Form::label('hoten', 'Họ tên') !!}
{!! Form::text('txtHoTen','', array('class' => 'input')) !!}
<br>
{!! Form::label('matkhau','Mật Khẩu') !!}
{!! Form::password('txtmatkhau', array('class' => 'input')) !!}
<br>
{!! Form::label('email','Nhập Email') !!}
{!! Form::email('txtEmail','',array('class' => 'input')) !!}
<br>
{!! Form::label('text','Nhap noi dung') !!}
{!! Form::textarea('txtChiChu','',array('class'=>'input','id'=>'txttext','row'=>'5')) !!}
<br>
{!! Form::label('gioitinh','Giới tính') !!}
{!! Form::radio('rdoGioiTinh','nam', true) !!} Nam
{!! Form::radio('rdoGioiTinh','nu', true) !!} Nu
<br>
{!! Form::label('gioitinh','Giới tính') !!}
{!! Form::radio('rdoGioiTinh1','nam', true) !!} Nam
{!! Form::radio('rdoGioiTinh1','nu', true) !!} Nu
<br>
{!! Form::label('text','Chọn địa phương') !!}
{!! Form::select('txtChiChu',array('hn'=>'Hà Nội','Hu'=>'Huế','HC'=>'Hồ chí minh'),'hn') !!}
<br>
{!! Form::label('text','Chọn địa phương') !!}
{!! Form::checkbox('chkMonHoc','swift') !!} Swift
{!! Form::checkbox('chkMonHoc','php') !!} PHP & MySQL
{!! Form::checkbox('chkMonHoc','android') !!} Android <br>

{!! Form::hidden('website','htpswift') !!}

{!! Form::label('hinh','Avata') !!}
{!! Form::file('fImage') !!}

{!! Form::submit('Gửi') !!}
{!! Form::button('Ok') !!}
{!! Form::reset('Xóa') !!}
{!! Form::close() !!}
