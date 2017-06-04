@extends('master.master_view')
@section('title', 'blade_subview')
@section('sidebar')
  @parent <br>
  this is content under line
@endsection
@section('noidung')
  This is page sub_view.
@endsection
