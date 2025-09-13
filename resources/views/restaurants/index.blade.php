@extends('layouts.master')

@section('title')
    restaurants
@endsection

@section('content')

    <div class="box">
        <div class="box-header with-border">

            <div class="">
                <h3 class="box-title">List of Restaurants</h3>
            </div>

        </div>
    </div>
    <div class="box-body">
        <br> <br>
        @if(count($restaurants))
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>phone</th>
                        <th>district</th>
                        <th>category</th>
                        <th>minimum_order</th>
                        <th>delivery_fees</th>
                        <th>phone_contact </th>
                        <th>phone_whatsapp</th>
                        <th>image</th>
                        <th>is_active</th>

                        <th class="text-center">Delete</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($restaurants as $restaurant)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$restaurant->name}}</td>
                            <td>{{$restaurant->email}}</td>
                            <td>{{$restaurant->phone}}</td>
                            <td>{{$restaurant->district->name}}</td>
                            <td>{{$restaurant->category->name}}</td>
                            <td>{{$restaurant->minimum_order}}</td>
                            <td>{{$restaurant->delivery_fees}}</td>
                            <td>{{$restaurant->phone_contact}}</td>
                            <td>{{$restaurant->phone_whatsapp}}</td>
                            <td>{{$restaurant->image}}</td>
                            <td>
                                {!! Form::open([
                                    'url' => route('changeRestaurantStatus'),
                                    'method' => 'post'
                                 ]) !!}
                                <input type="hidden" name="id" value="{{ $restaurant->id }}">
                                <button type="submit" class="btn btn-{{ $restaurant->is_available? 'success':'danger'}}">
                                    {{ $restaurant->is_available? 'activate' : 'deactivate' }}
                                </button>
                                {!! Form::close() !!}
                            </td>
                            <td class="text-center">
                                {!! Form::open([
                                        'url' => route('restaurants.delete',$restaurant->id),
                                        'method' => 'delete'
])                               !!}
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
