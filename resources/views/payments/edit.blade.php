@extends('layouts.master')
@inject('model','App\Models\Payment')
@section('title')
    edit payment
@endsection

@section('content')
    <div class="box">

        <div class="box-header with-border">
            <h3 class="box-title"> Edit Payment </h3>
        </div>

    </div>

    <div class="box-body">

        {!! Form::model($model,[
             'url' => route('payments.update',$payment->id),
             'method' => 'put'
        ]) !!}

        <div class="form-group">
            <label for="cost"> Cost </label>
            {!! Form::number('cost',$payment->cost,[
                'class' => 'form-control'
             ]) !!}
        </div>

        <label for="name"> restaurant </label>
        <select class="form-control" name="restaurant_id">
            <option value="{{ $payment->restaurant->id }}"> {{ $payment->restaurant->name }} </option>
            @foreach($restaurants as $restaurant)
                @if($payment->restaurant->id != $restaurant->id)
                    <option value="{{$restaurant->id}}"> {{$restaurant->name}} </option>
                @endif
            @endforeach
        </select> <br>

        <br>

        <div class="input-group">
            <span class="input-group-text"> Note </span>
            <textarea class="form-control" name="note" aria-label="with textarea"> {{ $payment->note }} </textarea>
        </div> <br> <br>

        <div class="form-group">
            <label for="date_pay"> date_pay </label>
            {!! Form::date('date_pay',$payment->date_pay,[
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
