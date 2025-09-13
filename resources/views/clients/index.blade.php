@extends('layouts.master')

@section('title')
    clients
@endsection

@section('content')

    <div class="box">
        <div class="box-header with-border">

            <div class="">
                <h3 class="box-title">List of Clients</h3>
            </div>

        </div>
    </div>
    <div class="box-body">
        <br> <br>
        @if(count($clients))
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>phone</th>
                        <th>district</th>
                        <th>is_active</th>

                        <th class="text-center">Delete</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($clients as $client)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$client->name}}</td>
                            <td>{{$client->email}}</td>
                            <td>{{$client->phone}}</td>
                            <td>{{$client->district->name}}</td>
                            <td>
                                {!! Form::open([
                                    'url' => route('changeClientStatus'),
                                    'method' => 'post'
                                 ]) !!}
                                <input type="hidden" name="id" value="{{ $client->id }}">
                                <button type="submit" class="btn btn-{{ $client->is_active? 'success':'danger'}}">
                                    {{ $client->is_active? 'activate' : 'deactivate' }}
                                </button>
                                {!! Form::close() !!}
                            </td>
                            <td class="text-center">
                                {!! Form::open([
                                        'url' => route('clients.delete',$client->id),
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
