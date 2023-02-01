<?php

namespace App\Http\Controllers;

use App\Models\LoggedHistory;
use App\Http\Requests\StoreLoggedHistoryRequest;
use App\Http\Requests\UpdateLoggedHistoryRequest;

class LoggedHistoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @param  \App\Http\Requests\StoreLoggedHistoryRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreLoggedHistoryRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\LoggedHistory  $loggedHistory
     * @return \Illuminate\Http\Response
     */
    public function show(LoggedHistory $loggedHistory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\LoggedHistory  $loggedHistory
     * @return \Illuminate\Http\Response
     */
    public function edit(LoggedHistory $loggedHistory)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateLoggedHistoryRequest  $request
     * @param  \App\Models\LoggedHistory  $loggedHistory
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateLoggedHistoryRequest $request, LoggedHistory $loggedHistory)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\LoggedHistory  $loggedHistory
     * @return \Illuminate\Http\Response
     */
    public function destroy(LoggedHistory $loggedHistory)
    {
        //
    }
}
