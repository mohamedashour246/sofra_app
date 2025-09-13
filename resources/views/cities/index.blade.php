@extends('layouts.master')

@section('title')
    cities
@endsection

@section('content')

    <div class="box">
        <div class="box-header with-border">

            <div class="">
                <h3 class="box-title">List of Cities</h3> <br>
            </div>

        </div>
    </div>
    <div class="box-body">
        <a href="{{route('cities.create')}}" class="btn btn-primary"><i class="fa fa-plus"></i> New City </a>
        <br> <br>
        @if(count($cities))
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th class="text-center">Edit</th>
                        <th class="text-center">Delete</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($cities as $city)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$city->name}}</td>
                            <td class="text-center">
                                <a href="{{ route('cities.edit',$city->id) }}" class="btn btn-success"> <i class="fa fa-edit"></i>  </a>
                            </td>
                            <td class="text-center">
                                {!! Form::open([
                                   'url' => route('cities.destroy',$city->id),
                                   'method' => 'delete'
])                                                !!}
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
