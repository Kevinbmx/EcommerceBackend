<?php

namespace App\Http\Controllers;

use App\Models\Attribute;
use Illuminate\Http\Request;

class AttributeController extends Controller
{
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
        ]);
            // return $request;
        $attribute = Attribute::create([
            'name' => $request->name,
        ]);
        return response()
            ->json(array(
                'saved' => true,
                'AttributeId'=>$attribute->id,
            ),200);
    }
}
