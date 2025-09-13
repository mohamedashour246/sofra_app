@extends('layouts.master')

@section('title')
    districts
@endsection

@section('content')

    <div class="box">
        <div class="box-header with-border">

            <div class="">
                <h3 class="box-title">List of Districts</h3> <br>
            </div>

        </div>
    </div>
    <div class="box-body">
        <a href="{{route('districts.create')}}" class="btn btn-primary"><i class="fa fa-plus"></i> New District </a>
        <br> <br>
        @if(count($districts))
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
                    @foreach($districts as $district)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$district->name}}</td>
                            <td class="text-center">
                                <a href="{{ route('districts.edit',$district->id) }}" class="btn btn-success"> <i class="fa fa-edit"></i>  </a>
                            </td>
                            <td class="text-center">
                                {!! Form::open([
                                        'url' => route('districts.destroy',$district->id),
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
