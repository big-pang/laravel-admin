@extends('admin.layouts.base')

@section('title','控制面板')

@section('pageHeader','控制面板')

@section('pageDesc','DashBoard')

@section('content')

    <iframe src="/admin/log-viewer" frameborder="0" style="width: 100%;min-height: 650px;"></iframe>

@endsection


@section('js')

@endsection