@extends('layouts.master')

@section('title')
    payments
@endsection

@section('content')

    <div class="box">
        <div class="box-header with-border">

            <div class="">
                <h3 class="box-title">List of Payments</h3> <br>
            </div>

        </div>
    </div>
    <div class="box-body">
        <a href="{{route('payments.create')}}" class="btn btn-primary"><i class="fa fa-plus"></i> New payment </a>
        <br> <br>
        @if(count($payments))
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Cost</th>
                        <th>Note</th>
                        <th>Date_pay</th>
                        <th class="text-center">Edit</th>
                        <th class="text-center">Delete</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($payments as $payment)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{number_format($payment->cost)}}</td>
                            <td>{{$payment->note}}</td>
                            <td>{{$payment->date_pay}}</td>
                            <td class="text-center">
                                <a href="{{ route('payments.edit',$payment->id) }}" class="btn btn-success"> <i class="fa fa-edit"></i>  </a>
                            </td>
                            <td class="text-center">
                                {!! Form::open([
                                      'url' => route('payments.destroy',$payment->id),
                                      'method' => 'delete'
                                 ]) !!}
                                <button type="submit" class="btn btn-danger btn-xs">
                                    <i class="fa fa-trash"></i>
                                </button>

                                {!! Form::close() !!}
                            </td>
                        </tr>
                    @endforeach
                </table>
            </div>
        @endif
    </div>

@endsection
