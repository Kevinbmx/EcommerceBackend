<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AttributeValueController extends Controller
{
    public function store(Request $request)
    {
        $this->validate($request, [
            'attribute_id' => 'required',
            'value_id'=>'required'
        ]);
            // return $request->attribute_id;
        $attributeValue = AttributeValue::create([
            'attribute_id' => $request->attribute_id,
            'value_id'=>$request->value_id
        ]);
        return response()
            ->json(array(
                'saved' => true,
                'attributeValueId'=>$attributeValue->id
            ),200);
    }
}
