<?php

namespace App\Http\Controllers;

use App\Models\Direction;
use Illuminate\Http\Request;

class DirectionController extends Controller
{
    public function getDirectionsByUserId(Request $request)
{
    $user = auth('api')->user();
    if(!is_null($user)){
        $direction = Direction::where('user_id',$user->id)->get();
    }else{
        $direction = null;
    }
    return response()
    ->json([
        'direction'=> $direction,
    ]);
}

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'direction' => 'required',
            'latitud' => 'required',
            'longitud' => 'required',
            'phone_number' => 'required',
        ]);
        $user_id = auth()->id();
        $direction = Direction::create([
            'name' => $request->name,
            'direction' => $request->direction,
            'latitud' => $request->latitud,
            'longitud' => $request->longitud,
            'phone_number' => $request->phone_number,
            'user_id' => $user_id,
        ]);
        return response()
            ->json([
                'create'=>true,
                'direction'=> $direction,
            ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Direction  $direction
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Direction $direction)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Direction  $direction
     * @return \Illuminate\Http\Response
     */
    public function destroy(Direction $direction)
    {
        //
    }

}
