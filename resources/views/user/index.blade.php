@extends('layouts.app')

@section('content')
<div class="container">
    <a href="{{ route('export.file',['type'=>'csv']) }}"><button type="button" class="btn btn-export btn-warning">Export</button></a>
    <br><br>
    <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" id="all-tab" data-toggle="tab" href="#all" role="tab" aria-controls="all" aria-selected="true">All</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="pending-tab" data-toggle="tab" href="#pending" role="tab" aria-controls="pending" aria-selected="false">Pending</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="accepted-tab" data-toggle="tab" href="#accepted" role="tab" aria-controls="accepted" aria-selected="false">Accepted</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="rejected-tab" data-toggle="tab" href="#rejected" role="tab" aria-controls="rejected" aria-selected="false">Rejected</a>
        </li>
    </ul>
    <br>
    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="all" role="tabpanel" aria-labelledby="all-tab">
            <table class="table table-striped sortable" id="createTransferRequestTable">
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
                <?php $count = 1; ?>
                    @foreach($users as $user)
                        <tr>
                        <?php $counted = $count++; ?>
                            <td>{{$counted}}</td>
                            <td>{{$user->name}}</td>
                            <td>{{$user->email}}</td>
                            <td>{{$user->statuses['status_name']}}</td>
                            <td>
                                <div class="d-flex flex-column">
                                    <div class="d-flex flex-row transfer-buttons">
                                        <div class="p-2">
                                            <a href="/redcampadmin/user/{{$user->id}}/edit"><button type="button" class="btn btn-primary action-buttons">Edit</button></a>
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
        <div class="tab-pane fade" id="pending" role="tabpanel" aria-labelledby="pending-tab">
            <table class="table table-striped sortable" id="createTransferRequestTable">
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
                <?php $count = 1; ?>
                    @foreach($pendings as $user)
                        <tr>
                        <?php $counted = $count++; ?>
                            <td>{{$counted}}</td>
                            <td>{{$user->name}}</td>
                            <td>{{$user->email}}</td>
                            <td>{{$user->statuses['status_name']}}</td>
                            <td>
                                <div class="d-flex flex-column">
                                    <div class="d-flex flex-row transfer-buttons">
                                        <div class="p-2">
                                            <a href="/redcampadmin/user/{{$user->id}}/edit"><button type="button" class="btn btn-primary action-buttons">Edit</button></a>
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
        <div class="tab-pane fade" id="accepted" role="tabpanel" aria-labelledby="accepted-tab">
            <table class="table table-striped sortable" id="createTransferRequestTable">
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
                <?php $count = 1; ?>
                    @foreach($accepteds as $user)
                        <tr>
                        <?php $counted = $count++; ?>
                            <td>{{$counted}}</td>
                            <td>{{$user->name}}</td>
                            <td>{{$user->email}}</td>
                            <td>{{$user->statuses['status_name']}}</td>
                            <td>
                                <div class="d-flex flex-column">
                                    <div class="d-flex flex-row transfer-buttons">
                                        <div class="p-2">
                                            <a href="/redcampadmin/user/{{$user->id}}/edit"><button type="button" class="btn btn-primary action-buttons">Edit</button></a>
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
        <div class="tab-pane fade" id="rejected" role="tabpanel" aria-labelledby="rejected-tab">
            <table class="table table-striped sortable" id="createTransferRequestTable">
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
                <?php $count = 1; ?>
                    @foreach($rejecteds as $user)
                        <tr>
                        <?php $counted = $count++; ?>
                            <td>{{$counted}}</td>
                            <td>{{$user->name}}</td>
                            <td>{{$user->email}}</td>
                            <td>{{$user->statuses['status_name']}}</td>
                            <td>
                                <div class="d-flex flex-column">
                                    <div class="d-flex flex-row transfer-buttons">
                                        <div class="p-2">
                                            <a href="/redcampadmin/user/{{$user->id}}/edit"><button type="button" class="btn btn-primary action-buttons">Edit</button></a>
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
    </div>
</div>

@endsection

<style>
    .laravelAlert {
	margin: 0 10px 20px 10px !important;
    }

    th:hover{
        background-color: lightgray;
        text-decoration: none;
        cursor: pointer;
    }
    
    .emptyHeader {
        cursor: default !important;
        background-color: transparent !important;
        pointer-events: none !important;
    }
</style>