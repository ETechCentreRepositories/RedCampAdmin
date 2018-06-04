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
            <input id="password" class="form-control" name="password" value="" required autofocus>
        </div>
    </div>
    
    <div class="form-group row">
        <label class="col-sm-4 col-form-label text-md-right">{{ __('Status') }}</label>

        <label class="col-sm-1 col-form-label text-md-right">{{$user->statuses['status_name']}}</label>
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
        <div class="centerStatus">
    <h3>Status</h3>
    <div class="row">
    <div class="col-md-5 noPadding">
    {!! Form::open(['action' => ['UsersController@update', $user->id], 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
        {{Form::hidden('statuses_id', '3', ['class' => 'form-control'])}}
        <br>
        {{Form::hidden('_method', 'PUT')}}
        {{Form::submit('Reject', ['class'=>'btn btn-primary btn-lg btn-danger btn-rejected', 'id'=>'rejected','disabled'])}}
    {!! Form::close() !!}
    </div>
    <div class="col-md-5 noPadding">
    {!! Form::open(['action' => ['UsersController@update', $user->id], 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
        {{Form::hidden('statuses_id', '2', ['class' => 'form-control'])}}
        <br>
        {{Form::hidden('_method', 'PUT')}}
        {{Form::submit('Accept', ['class'=>'btn btn-primary btn-lg btn-success btn-accepted', 'id'=>'accepted','disabled'])}}
    {!! Form::close() !!}
        </div>
    </div>
        </div>
    <br>
</div>
@endsection

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script>
    $(document).ready(function(){
        if ({{$user->statuses_id}} == 2) {
            document.getElementById("rejected").disabled = false;
        } else if ({{$user->statuses_id}} == 3) {
            document.getElementById("accepted").disabled = false;
        } else {
            document.getElementById("rejected").disabled = false;
            document.getElementById("accepted").disabled = false;
        }
    });
</script>