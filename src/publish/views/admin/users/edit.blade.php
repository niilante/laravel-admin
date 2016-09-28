@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Edit User</div>
                    <div class="panel-body">

                        {!! Form::model($user, [
                            'method' => 'PATCH',
                            'url' => ['/admin/users', $user->id],
                            'class' => 'form-horizontal'
                        ]) !!}

                        <div class="form-group{{ $errors->has('name') ? ' has-error' : ''}}">
                            {!! Form::label('name', 'Name: ', ['class' => 'col-md-4 control-label']) !!}
                            <div class="col-md-6">
                                {!! Form::text('name', null, ['class' => 'form-control', 'required' => 'required']) !!}
                                {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('email') ? ' has-error' : ''}}">
                            {!! Form::label('email', 'Email: ', ['class' => 'col-md-4 control-label']) !!}
                            <div class="col-md-6">
                                {!! Form::email('email', null, ['class' => 'form-control', 'required' => 'required']) !!}
                                {!! $errors->first('email', '<p class="help-block">:message</p>') !!}
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('roles') ? ' has-error' : ''}}">
                            {!! Form::label('role', 'Role: ', ['class' => 'col-md-4 control-label']) !!}
                            <div class="col-md-6">
                                <select class="roles" id="roles" name="roles[]" multiple="multiple">
                                    @foreach($roles as $role)
                                    @php
                                    if (in_array($role->name, $user_roles)) {
                                        $selected = 'selected="selected"';
                                    } else {
                                        $selected = '';
                                    }
                                    @endphp
                                    <option value="{{ $role->name }}" {{ $selected }}>{{ $role->label }}</option>
                                    @endforeach()
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-offset-4 col-md-4">
                                {!! Form::submit('Update', ['class' => 'btn btn-primary']) !!}
                            </div>
                        </div>
                        {!! Form::close() !!}

                        @if ($errors->any())
                            <ul class="alert alert-danger">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection