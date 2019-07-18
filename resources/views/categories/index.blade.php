@extends('layouts.backroom')

@section('backroomcontent')


    <categories-component></categories-component>


@endsection

@section('backroomside')


    <categoriesside-component></categoriesside-component>

    <vue-headful
            title="{{'Categories'}}"

    />
@endsection