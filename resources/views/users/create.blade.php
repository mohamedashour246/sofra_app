@extends('layouts.master')
@inject('model','App\Models\User')
@section('title')
    add User
@endsection

@section('content')
    <div class="box">

        <div class="box-header with-border">
            <h3 class="box-title"> Add User </h3>
        </div>

    </div>

    <div class="box-body">

        {!! Form::model($model,[
             'url' => route('users.store'),
             'method' => 'post'
        ]) !!}

        <div class="form-group">
            <label for="name"> Name </label>
            {!! Form::text('name',null,[
                'class' => 'form-control'
             ]) !!}
        </div>

        <div class="form-group">
            <label for="email"> Email </label>
            {!! Form::email('email',null,[
                'class' => 'form-control'
             ]) !!}
        </div>

        <div class="form-group">
            <label for="password"> Password </label>
            {!! Form::password('password',[
                'class' => 'form-control'
             ]) !!}
        </div>

        <div class="form-group">
            <label for="password_confirmation"> password_confirmation </label>
            {!! Form::password('password_confirmation',[
                'class' => 'form-control'
             ]) !!}
        </div>

        <div class="form-group">
            <label for="roles_list"> roles_list </label>
            {!! Form::select('roles_list[]',$roles,null,[
                'class' => 'form-control',
                'multiple' => 'multiple'
             ]) !!}
        </div>

        {{--        <div class="form-group">--}}
        {{--            <label for="permissions"> permissions </label>--}}
        {{--            <div class="row">--}}
        {{--                @foreach($perm->all() as $permission)--}}
        {{--                    <div class="col-sm-3">--}}
        {{--                        <div class="checkbox">--}}
        {{--                            <label>--}}
        {{--                                <input type="checkbox" name="permission_list[]" value="{{ $permission->id }}"> {{ $permission->name }}--}}
        {{--                            </label>--}}
        {{--                        </div>--}}

        {{--                    </div>--}}
        {{--                @endforeach--}}
        {{--            </div>--}}

        {{--        </div>--}}

        <div class="form-group">
            <button class="btn btn-primary" type="submit">
                submit
            </button>
        </div>
        {!! Form::close() !!}

    </div>
@endsection
