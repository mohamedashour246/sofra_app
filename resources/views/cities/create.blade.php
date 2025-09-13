@extends('layouts.master')
@inject('model','App\Models\City')
@section('title')
    addCity
@endsection

@section('content')
    <div class="box">

        <div class="box-header with-border">
            <h3 class="box-title"> Add City </h3>
        </div>

    </div>

    <div class="box-body">

        {!! Form::model($model,[
             'url' => route('cities.store'),
             'method' => 'post'
        ]) !!}
        {{--       <form action="{{ route('cities.store') }}" method="post">--}}
        <div class="form-group">
            <label for="name"> Name </label>
            {!! Form::text('name',null,[
                'class' => 'form-control'
             ]) !!}
        </div>

        <div class="form-group">
            <button class="btn btn-primary" type="submit">
                submit
            </button>
        </div>
        {!! Form::close() !!}

        {{--       </form>--}}

    </div>
@endsection
