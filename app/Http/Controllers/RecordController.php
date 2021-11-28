<?php

namespace App\Http\Controllers;

use App\Models\Record;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class RecordController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $records = Record::query();
        $filters = [];

        if ($filter_user = $request->user) {
            $records = $records->user($filter_user);
            $filters['filter_user'] = $filter_user;
        }

        if ($filter_client = $request->client) {
            $records = $records->client($filter_client);
            $filters['filter_client'] = $filter_client;
        }

        if ($filter_call_type = $request->call_type) {
            $records = $records->callType($filter_call_type);
            $filters['filter_call_type'] = $filter_call_type;
        }

        $records = $records->paginate(10);
        $users = Record::select('user')->distinct()->pluck('user');
        $clients = Record::select('client')->distinct()->pluck('client');
        $call_types = Record::select('type_of_call')->distinct()->pluck('type_of_call');

        return response()->view('home', array_merge([
            'records' => $records, 'users' => $users,
            'clients' => $clients, 'call_types' => $call_types
        ], $filters));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'calls_csv' => 'required|file|mimes:csv'
        ]);
        $data = array_map('str_getcsv', file($request->file('calls_csv')));
        DB::transaction(function () use ($data) {
            for($i = 1; $i < count($data); $i++) {
                Record::create(array_combine(Record::getFillable, $data[$i]));
            }
        });

        Session::flash('success', 'Caller data saved.');

        return redirect()->route('record.store');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Record  $record
     * @return \Illuminate\Http\Response
     */
    public function show(Record $record)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Record  $record
     * @return \Illuminate\Http\Response
     */
    public function edit(Record $record)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Record  $record
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Record $record)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Record  $record
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Record $record = null)
    {
        if (!$record) {
            DB::table('records')->truncate();
            Session::flash('success', 'All call records deleted.');
        } else {
            $record->delete();
            Session::flash('success', 'Record deleted.');
        }

        return redirect()->route('record.index');
    }
}
