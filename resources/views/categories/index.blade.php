@extends('layouts.master')

@section('title')
    categories
@endsection

@section('content')

    <div class="box">
        <div class="box-header with-border">

            <div class="">
                <h3 class="box-title">List of Categories</h3> <br>
            </div>

        </div>
    </div>
    <div class="box-body">
        <a href="{{route('categories.create')}}" class="btn btn-primary"><i class="fa fa-plus"></i> New Category </a>
        <br> <br>
        @if(count($categories))
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
                    @foreach($categories as $category)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$category->name}}</td>
                            <td class="text-center">
                                <a href="{{ route('categories.edit',$category->id) }}" class="btn btn-success"> <i class="fa fa-edit"></i>  </a>
                            </td>
                            <td class="text-center">
                                {!! Form::open([
                                      'url' => route('categories.destroy',$category->id),
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
