@extends('layouts/master')

@section('title') Home @endsection

@section('content')
    <div class="app-container">
        <form action="{{route('record.store')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group pb-2 border-b border-b-2">
                <label for="calls_csv">Upload Calls CSV:</label>
                <input type="file" class="btn standard" name="calls_csv">
            </div>
            <div class="form-group">
                <input type="submit" class="btn standard w-full" value="Store CSV">
            </div>
        </form>

        @if($records && $records->isNotEmpty())
            <form action="{{route('record.delete-all')}}" class="form confirmable self-end" method="POST">
                @method('DELETE')
                @csrf
                <input type="submit" class="btn danger" value="Erase all call records">
            </form>

            <form action="{{route('record.index')}}" id="filter-form" class="my-5 border border-gray-700 p-5" method="GET">
                <div class="flex flex-col">

                    <div>
                        <div class="form-group inline-block">
                            <label for="user">User</label>
                            <select name="user" id="user">
                                <option value="">Select a user to filter by</option>
                                @foreach($users as $user)
                                    <option value="{{$user}}" {{isset($filter_user) && $filter_user === $user ? 'selected' : ''}}>{{$user}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group inline-block">
                            <label for="client">Client</label>
                            <select name="client" id="client">
                                <option value="">Select a client to filter by</option>
                                @foreach($clients as $client)
                                    <option value="{{$client}}" {{isset($filter_client) && $filter_client === $client ? 'selected' : ''}}>{{$client}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group inline">
                            <label for="call_type">Call Type</label>
                            <select name="call_type" id="call_type">
                                <option value="">Select a call type to filter by</option>
                                @foreach($call_types as $call_type)
                                    <option value="{{$call_type}}" {{isset($filter_call_type) && $filter_call_type === $call_type ? 'selected' : ''}}>{{$call_type}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div>
                        <input type="submit" class="btn standard inline-block float-right" value="Filter">
                        <button type="button" id="btn-reset-filters" class="btn blank inline-block float-left">Clear filters</button>
                    </div>
                </div>
            </form>
        @endif

        <table id="index-table" class="mt-5">
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
                @foreach($records as $record)
                    <tr>
                        <td>{{$record->user}}</td>
                        <td>{{$record->client}}</td>
                        <td>{{$record->client_type}}</td>
                        <td>{{$record->date}}</td>
                        <td>{{$record->duration}}</td>
                        <td>{{$record->type_of_call}}</td>
                        <td>{{$record->external_call_score}}</td>
                        <td class="center">
                            <a href="#">
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

        {{$records->links()}}
    </div>
@endsection

@push('scripts')
    <script>
        window.addEventListener('DOMContentLoaded', evt => {
            let closeBtns = document.getElementsByClassName('close');
            for(let i = 0; i<closeBtns.length; i++) {
                closeBtns[i].addEventListener('click', e => {
                    if (e.target.parentElement.classList.contains('alert')) {
                        e.target.parentElement.style.visibility = 'hidden';
                    } else if(e.target.parentElement.parentElement.classList.contains('alert')) {
                        e.target.parentElement.parentElement.style.visibility = 'hidden';
                    }
                });
            }

            let filterForm = document.getElementById('filter-form');
            let filterFormReset = document.getElementById('btn-reset-filters');
            filterFormReset.addEventListener('click', e => {
                let filterFormSelectControls = filterForm.querySelectorAll('select');
                for(let i = 0; i<filterFormSelectControls.length; i++) {
                    filterFormSelectControls[i].selectedIndex = 0;
                }
            });
        });
    </script>
@endpush
