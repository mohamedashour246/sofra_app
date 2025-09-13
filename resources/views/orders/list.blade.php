@extends('layouts.master')

@section('title')
    orders
@endsection

@section('content')

    <div class="box">
        <div class="box-header with-border">

            <div class="">
                <h3 class="box-title">List of Orders</h3>
            </div>

        </div>
    </div>
    <div class="box-body">
        <br> <br>
        @if(count($orders))
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Address</th>
                        <th>Note</th>
                        <th>Price</th>
                        <th>Price_delivery</th>
                        <th>Total</th>
                        <th>Remainder</th>
                        <th>Commission</th>
                        <th>order_state</th>
                        <th>payment_type</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($orders as $order)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$order->address}}</td>
                            <td>{{$order->note}}</td>
                            <td>{{$order->price}}</td>
                            <td>{{$order->price_delivery}}</td>
                            <td>{{$order->total}}</td>
                            <td>{{$order->remainder}}</td>
                            <td>{{$order->commission}}</td>
                            <td>{{$order->order_state}}</td>
                            <td>{{$order->payment_type}}</td>
                        </tr>
                    @endforeach
                </table>
            </div>
        @endif
    </div>

@endsection
