@extends('layouts.master')

@section('title')
    contacts
@endsection

@section('content')

    <div class="box">
        <div class="box-header with-border">

            <div class="">
                <h3 class="box-title">List of Contacts</h3>
            </div>

        </div>
    </div>
    <div class="box-body">
        <br> <br>
        @if(count($contacts))
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Message</th>
                        <th>Type</th>

                        {{--                        <th class="text-center">Edit</th>--}}
                        <th class="text-center">Delete</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($contacts as $contact)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$contact->name}}</td>
                            <td>{{$contact->email}}</td>
                            <td>{{$contact->phone}}</td>
                            <td>{{$contact->message}}</td>
                            <td>{{$contact->type}}</td>
                            {{--                            <td class="text-center">--}}
                            {{--                                <a href="{{ route('clients.edit',$client->id) }}" class="btn btn-success"> <i class="fa fa-edit"></i>  </a>--}}
                            {{--                            </td>--}}
                            <td class="text-center">
                                {!! Form::open([
                                        'url' => route('contacts.delete',$contact->id),
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
