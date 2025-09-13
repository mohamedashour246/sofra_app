@extends('layouts.master')
@section('title')
    Settings
@endsection

@section('content')
    <div class="box">

        <div class="box-header with-border">
            <h3 class="box-title"> Settings </h3>
        </div>

    </div>

    <div class="box-body">

        {!! Form::open([
             'url' => route('setting.update'),
             'method' => 'post',
        ]) !!}
        <input type="hidden" name="id" value="{{ $setting->id }}">

        <div class="form-group">
            <label for="phone"> Phone </label>
            {!! Form::text('phone',$setting->phone,[
                'class' => 'form-control'
             ]) !!}
        </div>

        <div class="form-group">
            <label for="email"> Email </label>
            {!! Form::email('email',$setting->email,[
                'class' => 'form-control'
             ]) !!}
        </div>

        <div class="form-group">
            <label for="email"> Commission </label>
            {!! Form::number('commission',$setting->commission,[
                'class' => 'form-control'
             ]) !!}
        </div>

        <div class="form-group">
            <button class="btn btn-primary" type="submit">
                submit
            </button>
        </div>
        {!! Form::close() !!}

    </div>
@endsection
