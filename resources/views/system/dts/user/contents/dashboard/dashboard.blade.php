@extends('system.dts.user.layout.user_master')
@section('title', $title)
@section('content')
@include('system.dts.includes.title')
@include('system.dts.user.contents.dashboard.sections.display1')
@include('system.dts.user.contents.dashboard.sections.display2')
@endsection
@section('js')
