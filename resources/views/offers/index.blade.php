@extends('layouts.master')

@section('title')
    offers
@endsection

@section('content')

    <div class="box">
        <div class="box-header with-border">

            <div class="">
                <h3 class="box-title">List of Offers</h3>
            </div>

        </div>
    </div>
    <div class="box-body">
        <br> <br>
        @if(count($offers))
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Image</th>
                        <th>description</th>
{{--                        <th class="text-center">Edit</th>--}}
                        <th class="text-center">Delete</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($offers as $offer)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$offer->name}}</td>
                            <td>{{$offer->image}}</td>
                            <td>{{$offer->description}}</td>
{{--                            <td class="text-center">--}}
{{--                                <a href="{{ route('clients.edit',$client->id) }}" class="btn btn-success"> <i class="fa fa-edit"></i>  </a>--}}
{{--                            </td>--}}
                            <td class="text-center">
                                {!! Form::open([
                                        'url' => route('offers.delete',$offer->id),
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
