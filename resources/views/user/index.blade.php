@extends('layouts.app')

@section('content')
<div class="container">
    <a href="{{ route('export.file',['type'=>'csv']) }}"><button type="button" class="btn btn-export btn-warning">Export</button></a>
    <br><br>
    <table class="table table-striped" id="createTransferRequestTable">
        <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Email</th>
                <th>Status</th>
                <th class="emptyHeader"></th>
            </tr>
        </thead>
        <tbody id="addTransferRequestContent">
            @foreach($users as $user)
                <tr>
                    <td>{{$user->id}}</td>
                    <td>{{$user->name}}</td>
                    <td>{{$user->email}}</td>
                    <td>{{$user->statuses['status_name']}}</td>
                    <td>
                        <div class="d-flex flex-column">
                            <div class="d-flex flex-row transfer-buttons">
                                <div class="p-2">
                                    <a href="/user/{{$user->id}}/edit"><button type="button" class="btn btn-primary action-buttons">Status</button></a>
                                </div>
                                <div class="p-2">
                                    {!!Form::open(['action' => ['UsersController@destroy', $user->id], 'method' => 'POST', 'class' => 'deleteButton'])!!}
                                        {{Form::hidden('_method', 'DELETE')}}
                                        {{Form::submit('Delete', ['class' => 'btn btn-danger action-buttons btn-delete'])}}
                                    {!!Form::close()!!}
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
<div class="pagination">
    {{$users->links()}}
</div>
@endsection