@extends('layouts.master')
@inject('model','App\Models\District')
@section('title')
    edit District
@endsection

@section('content')
    <div class="box">

        <div class="box-header with-border">
            <h3 class="box-title"> edit District </h3>
        </div>

    </div>

    <div class="box-body">

        {!! Form::model($model,[
             'url' => route('districts.update',$district->id),
             'method' => 'put'
        ]) !!}

        <div class="form-group">
            <label for="name"> Name </label>
            {!! Form::text('name',$district->name,[
                'class' => 'form-control'
             ]) !!}
        </div>

        <select class="form-control" name="city_id">
            <option value="{{$district->city->id}}"> {{$district->city->name}} </option>
            @foreach($cities as $city)
                @if($district->city->id != $city->id)
                    <option value="{{$city->id}}"> {{$city->name}} </option>
                @endif
            @endforeach
        </select> <br> <br>

        <div class="form-group">
            <button class="btn btn-primary" type="submit">
                submit
            </button>
        </div>
        {!! Form::close() !!}

    </div>
@endsection
