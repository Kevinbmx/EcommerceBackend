<?php

namespace App\Http\Controllers;

use App\Model\StatusProduct;
use Illuminate\Http\Request;

class StatusProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return StatusProduct::all();
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\StatusProduct  $statusProduct
     * @return \Illuminate\Http\Response
     */
    public function show(StatusProduct $statusProduct)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\StatusProduct  $statusProduct
     * @return \Illuminate\Http\Response
     */
    public function edit(StatusProduct $statusProduct)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\StatusProduct  $statusProduct
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, StatusProduct $statusProduct)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\StatusProduct  $statusProduct
     * @return \Illuminate\Http\Response
     */
    public function destroy(StatusProduct $statusProduct)
    {
        //
    }
}
