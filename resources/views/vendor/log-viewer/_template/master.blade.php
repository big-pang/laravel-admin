@extends('admin.layouts.base')
@section('title','控制面板')

@section('pageHeader','控制面板')
@include('log-viewer::_template.style')
<style>
    body{
        padding-top: 0px;
    }
</style>

{{--@include('log-viewer::_template.navigation')--}}
@section('content')
    <div class="container-fluid">
        @yield('content')
    </div>
@endsection

@include('log-viewer::_template.footer')
@section('js')


<script src="/plugins/logViewer/js/Chart.min.js"></script>
<script>
    Chart.defaults.global.responsive      = true;
    Chart.defaults.global.scaleFontFamily = "'Source Sans Pro'";
    Chart.defaults.global.animationEasing = "easeOutQuart";
</script>
@yield('scripts')

@endsection