@extends('layouts.app')

@section('content')
<div class="container">
    
    <table class="table table-striped" id="createTransferRequestTable">
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>NRIC</th>
                <th>DOB</th>
                <th>Mobile Number</th>
                <th>School</th>
                <th>diet_requirements</th>
            </tr>
        </thead>
        <tbody>
                <tr>
                    <td>{{$user->name}}</td>
                    <td>{{$user->email}}</td>
                    <td>{{$user->nric}}</td>
                    <td>{{$user->dob}}</td>
                    <td>{{$user->mobile}}</td>
                    <td>{{$user->school}}</td>
                    <td>{{$user->diet_requirements}}</td>
                </tr>
        </tbody>
    </table>
    {!! Form::open(['action' => ['UsersController@update', $user->id], 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
        {{Form::hidden('statuses_id', '3', ['class' => 'form-control'])}}
        {{Form::hidden('_method', 'PUT')}}
        {{Form::submit('Rejected', ['class'=>'btn btn-primary btn-lg btn-danger btn-rejected'])}}
    {!! Form::close() !!}
    {!! Form::open(['action' => ['UsersController@update', $user->id], 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
        {{Form::hidden('statuses_id', '2', ['class' => 'form-control'])}}
        {{Form::hidden('_method', 'PUT')}}
        {{Form::submit('Accepted', ['class'=>'btn btn-primary btn-lg btn-success btn-accepted'])}}
    {!! Form::close() !!}
</div>
@endsection