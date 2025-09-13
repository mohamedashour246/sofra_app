@extends('layouts.master')
@inject('model','App\Models\Role')
@inject('perm','App\Models\Permission')
@section('title')
    edit Role
@endsection

@section('content')
    <div class="box">

        <div class="box-header with-border">
            <h3 class="box-title"> Edit Role </h3>
        </div>

    </div>

    <div class="box-body">

        {!! Form::model($model,[
             'url' => route('roles.update',$role->id),
             'method' => 'put'
        ]) !!}

        <div class="form-group">
            <label for="name"> Name </label>
            {!! Form::text('name',$role->name,[
                'class' => 'form-control'
             ]) !!}
        </div>

        <div class="form-group">
            <label for="guard_name"> guard_name </label>
            {!! Form::text('guard_name',$role->guard_name,[
                'class' => 'form-control'
             ]) !!}
        </div>

        <div class="input-group">
            <span class="input-group-text"> description </span>
            <textarea class="form-control" name="description" aria-label="with textarea"> {{ $role->description }} </textarea>
        </div> <br>

        <div class="form-group">
            <label for="permissions"> permissions </label>
            <div class="row">
                @foreach($perm->all() as $permission)
                    <div class="col-sm-3">
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="permission_list[]" value="{{ $permission->id }}"
                                       @if($role->hasPermissionTo($permission->name))
                                       checked
                                    @endif
                                >
                                {{ $permission->name }}
                            </label>
                        </div>

                    </div>
                @endforeach
            </div>

        </div>

        <div class="form-group">
            <button class="btn btn-primary" type="submit">
                submit
            </button>
        </div>
        {!! Form::close() !!}

    </div>
@endsection
