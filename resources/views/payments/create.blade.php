@extends('layouts.master')
@inject('model','App\Models\Payment')
@section('title')
    add payment
@endsection

@section('content')
    <div class="box">

        <div class="box-header with-border">
            <h3 class="box-title"> Add Payment </h3>
        </div>

    </div>

    <div class="box-body">

        {!! Form::model($model,[
             'url' => route('payments.store'),
             'method' => 'post'
        ]) !!}

        <div class="form-group">
            <label for="cost"> Cost </label>
            {!! Form::number('cost',null,[
                'class' => 'form-control'
             ]) !!}
        </div>

        <div class="form-group">
            <label for="restaurant"> restaurant </label>
            {!! Form::select('restaurant_id',$restaurants,null,[
                'class' => 'form-control',
             ]) !!}
        </div>
        <br>

        <div class="input-group">
            <span class="input-group-text"> Note </span>
            <textarea class="form-control" name="note" aria-label="with textarea"></textarea>
        </div> <br> <br>

        <div class="form-group">
            <label for="date_pay"> date_pay </label>
            {!! Form::date('date_pay',\Carbon\Carbon::now(),[
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
