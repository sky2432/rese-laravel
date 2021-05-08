<?php

namespace App\Http\Controllers;

use App\Models\Evaluation;
use Illuminate\Http\Request;

class EvaluationController extends Controller
{
    public function store(Request $request, $shop_id)
    {
        $item = new Evaluation();
        $item->shop_id = $shop_id;
        $item->fill($request->all())->save();

        return response()->json([
            'data' => $item
        ], 200);
    }

    public function update(Request $request, $shop_id, $evaluation_id)
    {
        $item = Evaluation::find($evaluation_id);

        if ($item->user_id == $request->user_id && $item->shop_id == $shop_id) {
            $item->update($request->all());

            return response()->json([
                'data' => $item
            ], 200);
        } else {
            return response()->json([], 400);
        }
    }

    public function destroy(Request $request, $shop_id, $evaluation_id)
    {
        $item = Evaluation::find($evaluation_id);

        if ($item->user_id == $request->user_id && $item->shop_id == $shop_id) {
            $item->delete();

            return response()->json([], 204);
        } else {
            return response()->json([], 400);
        }

    }
}
