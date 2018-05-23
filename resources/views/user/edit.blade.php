@extends('layouts.app')

@section('content')
<div class="container">
    {!! Form::open(['action' => ['UsersController@update', $user->id], 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
    <div class="form-group row">
        <label for="name" class="col-sm-4 col-form-label text-md-right">{{ __('Name') }}</label>

        <div class="col-md-6">
            <input id="name" class="form-control" name="name" value="{{$user->name}}" required autofocus>
        </div>
    </div>

    <div class="form-group row">
        <label for="email" class="col-sm-4 col-form-label text-md-right">{{ __('E-Mail') }}</label>

        <div class="col-md-6">
            <input id="email" type="email" class="form-control" name="email" value="{{$user->email}}" required autofocus>
        </div>
    </div>

    <div class="form-group row">
        <label for="nric" class="col-sm-4 col-form-label text-md-right">{{ __('NRIC') }}</label>

        <div class="col-md-6">
            <input id="nric" class="form-control" name="nric" value="{{$user->nric}}" required autofocus>
        </div>
    </div>

    <div class="form-group row">
        <label for="dob" class="col-sm-4 col-form-label text-md-right">{{ __('Date of Birth') }}</label>

        <div class="col-md-6">
            <input id="dob" class="form-control" name="dob" value="{{$user->dob}}" required autofocus>
        </div>
    </div>

    <div class="form-group row">
        <label for="mobile" class="col-sm-4 col-form-label text-md-right">{{ __('Mobile Number') }}</label>

        <div class="col-md-6">
            <input id="mobile" class="form-control" name="mobile" value="{{$user->mobile}}" required autofocus>
        </div>
    </div>

    <div class="form-group row">
        <label for="school" class="col-sm-4 col-form-label text-md-right">{{ __('Secondary School') }}</label>

        <div class="col-md-6">
            <input id="school" class="form-control" name="school" value="{{$user->school}}" required autofocus>
        </div>
    </div>

    <div class="form-group row">
        <label for="diet_requirements" class="col-sm-4 col-form-label text-md-right">{{ __('Diet Requirements') }}</label>

        <div class="col-md-6">
            <input id="diet_requirements" class="form-control" name="diet_requirements" value="{{$user->diet_requirements}}" required autofocus>
        </div>
    </div>

    <div class="form-group row">
        <label for="password" class="col-sm-4 col-form-label text-md-right">{{ __('Password') }}</label>

        <div class="col-md-6">
            <input id="password" class="form-control" name="password" value="{{$user->password}}" required autofocus>
        </div>
    </div>

    {{Form::hidden('statuses_id', $user->statuses_id, ['class' => 'form-control'])}}

    {{Form::hidden('_method','PUT')}}
        <div class="form-group">
            <div style="text-align:center">
                <button type="submit" class="btn btn-primary">
                    Update User
                </button>
            </div>
        </div>
    {!! Form::close() !!}

    <hr>

    <h3>Status</h3>
    </table>
    {!! Form::open(['action' => ['UsersController@update', $user->id], 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
        {{Form::hidden('name', $user->name, ['class' => 'form-control'])}}
        {{Form::hidden('email', $user->email, ['class' => 'form-control'])}}
        {{Form::hidden('nric', $user->nric, ['class' => 'form-control'])}}
        {{Form::hidden('dob', $user->dob, ['class' => 'form-control'])}}
        {{Form::hidden('mobile', $user->mobile, ['class' => 'form-control'])}}
        {{Form::hidden('school', $user->school, ['class' => 'form-control'])}}
        {{Form::hidden('diet_requirements', $user->diet_requirements, ['class' => 'form-control'])}}
        {{Form::hidden('password', $user->password, ['class' => 'form-control'])}}
        {{Form::hidden('statuses_id', '3', ['class' => 'form-control'])}}
        {{Form::hidden('_method', 'PUT')}}
        {{Form::submit('Reject', ['class'=>'btn btn-primary btn-lg btn-danger btn-rejected','onclick'=>'sendMail()'])}}
    {!! Form::close() !!}

    {!! Form::open(['action' => ['UsersController@update', $user->id], 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
        {{Form::hidden('name', $user->name, ['class' => 'form-control'])}}
        {{Form::hidden('email', $user->email, ['class' => 'form-control'])}}
        {{Form::hidden('nric', $user->nric, ['class' => 'form-control'])}}
        {{Form::hidden('dob', $user->dob, ['class' => 'form-control'])}}
        {{Form::hidden('mobile', $user->mobile, ['class' => 'form-control'])}}
        {{Form::hidden('school', $user->school, ['class' => 'form-control'])}}
        {{Form::hidden('diet_requirements', $user->diet_requirements, ['class' => 'form-control'])}}
        {{Form::hidden('password', $user->password, ['class' => 'form-control'])}}
        {{Form::hidden('statuses_id', '2', ['class' => 'form-control'])}}
        {{Form::hidden('_method', 'PUT')}}
        {{-- <a href="mailto:{{$user->email}}?Subject=Hello%20again"> --}}
            {{Form::submit('Accept', ['class'=>'btn btn-primary btn-lg btn-success btn-accepted','onclick'=>'sendMail()'])}}
        {{-- </a> --}}
    {!! Form::close() !!}
    <br>
</div>
@endsection