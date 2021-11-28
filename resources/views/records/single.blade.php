@extends('layouts/master')

@section('title') Record Details @endsection

@section('content')
    <div class="app-container">

        @if(isset($record))
        <form action="{{route('record.update', ['record' => $record->id])}}" method="POST">
            @method('PATCH')
        @else
        <form action="{{route('record.store')}}" method="POST">
        @endif

            @csrf

            <div class="form-group flex justify-between">
                <label for="user">User</label>
                <input type="text" name="user" class="border-2 border-black w-8/12" value="{{isset($record) ? $record->user : ''}}" placeholder="User">
            </div>

            <div class="form-group flex justify-between">
                <label for="client">Client</label>
                <input type="text" name="client" class="border-2 border-black w-8/12" value="{{isset($record) ? $record->client : ''}}" placeholder="Client">
            </div>

            <div class="form-group flex justify-between">
                <label for="client_type">Client Type</label>
                <input type="text" name="client_type" class="border-2 border-black w-8/12" value="{{isset($record) ? $record->client_type : ''}}" placeholder="Type of Client">
            </div>

            <div class="form-group flex justify-between">
                <label for="date">Date</label>
                <input type="text" name="date" class="border-2 border-black w-8/12" value="{{isset($record) ? $record->date : ''}}" placeholder="Date">
            </div>

            <div class="form-group flex justify-between">
                <label for="duration">Duration</label>
                <input type="number" min="0" name="duration" class="border-2 border-black w-8/12" value="{{isset($record) ? $record->duration : ''}}" placeholder="Duration">
            </div>

            <div class="form-group flex justify-between">
                <label for="type_of_call">Type of Call</label>
                <select class="border-2 border-black w-8/12" name="type_of_call">
                    <option value="Incoming" {{isset($record) && strtolower($record->type_of_call) === 'incoming' ? 'selected' : ''}}>
                        Incoming
                    </option>
                    <option value="Outgoing" {{isset($record) && strtolower($record->type_of_call) === 'outgoing' ? 'selected' : ''}}>
                        Outgoing
                    </option>
                </select>
            </div>

            <div class="form-group flex justify-between">
                <label for="external_call_score">External Call Score</label>
                <input type="number" min="0" class="border-2 border-black w-8/12" name="external_call_score" value="{{isset($record) ? $record->external_call_score : ''}}" placeholder="External Call Score">
            </div>

            <input type="submit" class="btn standard w-full mt-5" value="{{isset($record) ? 'Update' : 'Save'}}">

        </form>

        @if(isset($record))
            <div class="user-info my-20" id="user-info">
                <div class="user-name border-b">
                    <span>User Name is</span>
                    <span>{{$user}}</span>
                </div>
                <div class="user-score border-b">
                    <span>Average User Score: </span>
                    <span>{{$user_score}}</span>
                </div>
                <div class="user-last5">
                    <div>{{$user}} last 5 calls:</div>
                    <table class="records-table">
                        <thead>
                        <tr>
                            <th>User</th>
                            <th>Client</th>
                            <th>Client Type</th>
                            <th>Date</th>
                            <th>Duration</th>
                            <th>Call Type</th>
                            <th>External Call Score</th>
                            <th>View</th>
                            <th>Delete</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach($last5 as $record)
                                <tr>
                                    <td>{{$record->user}}</td>
                                    <td>{{$record->client}}</td>
                                    <td>{{$record->client_type}}</td>
                                    <td>{{$record->date}}</td>
                                    <td>{{$record->duration}}</td>
                                    <td>{{$record->type_of_call}}</td>
                                    <td>{{$record->external_call_score}}</td>
                                    <td class="center">
                                        <a href="{{route('record.view', ['record' => $record->id])}}">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                    </td>
                                    <td class="center">
                                        <form action="{{route('record.delete', ['record' => $record->id])}}" class="form confirmable" method="POST">
                                            @method('DELETE')
                                            @csrf
                                            <button type="submit">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @endif
    </div>
@endsection
