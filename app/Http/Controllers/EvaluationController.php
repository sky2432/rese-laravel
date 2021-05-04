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

    public function show($id)
    {
        $item = Evaluation::where('user_id', $id)->get();

        return response()->json([
            'data' => $item
        ], 200);
    }

    public function update(Request $request, $id)
    {

    }

    public function delete(Request $request)
    {
        $id = $request->id;
        $item = Evaluation::find($id);

        if ($item->user_id === $request->user_id) {
            Evaluation::destroy($id);

            return response()->json([
                'massage' => 'deleted'
            ], 200);
        } else {
            return response()->json([
                'message' => 'Not allowed',
            ], 400);
        }
    }
}
