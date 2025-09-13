@extends('layouts.master')
@inject('model','App\Models\District')
@section('title')
    add District
@endsection

@section('content')
    <div class="box">

        <div class="box-header with-border">
            <h3 class="box-title"> Add District </h3>
        </div>

    </div>

    <div class="box-body">

        {!! Form::model($model,[
             'url' => route('districts.store'),
             'method' => 'post'
        ]) !!}

        <div class="form-group">
            <label for="name"> Name </label>
            {!! Form::text('name',null,[
                'class' => 'form-control'
             ]) !!}
        </div>

        <select class="form-control" name="city_id">
            @foreach($cities as $city)
                <option value="{{$city->id}}"> {{$city->name}} </option>
            @endforeach
        </select> <br> <br>

        <div class="form-group">
            <button class="btn btn-primary" type="submit">
                submit
            </button>
        </div>
        {!! Form::close() !!}

        {{--       </form>--}}

    </div>
@endsection
