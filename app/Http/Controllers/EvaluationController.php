<?php

namespace App\Http\Controllers;

use App\Models\Evaluation;
use Illuminate\Http\Request;

class EvaluationController extends Controller
{
    public function store(Request $request)
    {
        $item = new Evaluation();
        $item->fill($request->all())->save();

        return response()->json([
            'data' => $item
        ], 200);
    }

    public function update(Request $request, $evaluation_id)
    {
        $item = Evaluation::find($evaluation_id);

        $item->update($request->all());

        return response()->json([
                'data' => $item
            ], 200);
    }

    public function destroy($evaluation_id)
    {
        Evaluation::destroy($evaluation_id);

        return response()->json([], 204);
    }
}
