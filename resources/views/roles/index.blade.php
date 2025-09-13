@extends('layouts.master')

@section('title')
    roles
@endsection

@section('content')

    <div class="box">
        <div class="box-header with-border">

            <div class="">
                <h3 class="box-title">List of Roles</h3> <br>
            </div>

        </div>
    </div>
    <div class="box-body">
        <a href="{{route('roles.create')}}" class="btn btn-primary"><i class="fa fa-plus"></i> New Role </a>
        <br> <br>
        @if(count($roles))
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
                    @foreach($roles as $role)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$role->name}}</td>
                            <td class="text-center">
                                <a href="{{ route('roles.edit',$role->id) }}" class="btn btn-success"> <i class="fa fa-edit"></i>  </a>
                            </td>
                            <td class="text-center">
                                {!! Form::open([
                                      'url' => route('roles.destroy',$role->id),
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
        @else
            <div class="alert alert-danger" role="alert">
                No data
            </div>
        @endif
    </div>

@endsection
