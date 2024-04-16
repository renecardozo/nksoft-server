<?php

namespace App\Http\Controllers;

use App\Models\calendario;
use Illuminate\Http\Request;

class CalendarioController extends Controller
{


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $calendarios = calendario::all();
        return $calendarios;
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
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
    }
       

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\calendario  $calendario
     * @return \Illuminate\Http\Response
     */
    public function show(calendario $calendario)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\calendario  $calendario
     * @return \Illuminate\Http\Response
     */
    public function edit(calendario $calendario)
    {
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\calendario  $calendario
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, calendario $calendario)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\calendario  $calendario
     * @return \Illuminate\Http\Response
     */
    public function destroy(calendario $calendario)
    {
        //
    }
}
