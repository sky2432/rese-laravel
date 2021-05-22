<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateNameEmailRequest;
use App\Http\Requests\UpdatePasswordRequest;
use App\Models\Owner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class OwnerController extends Controller
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
     * @param  \App\Models\Owner  $owner
     * @return \Illuminate\Http\Response
     */
    public function show(Owner $owner)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Owner  $owner
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $owner_id)
    {
        UpdateNameEmailRequest::rules($request, $owner_id, 'owners');

        $item = Owner::find($owner_id);
        $item->fill($request->all())->save();

        return response()->json([
            'data' => $item
        ], config('const.STATUS_CODE.OK'));
    }

    public function updatePassword(Request $request, $owner_id)
    {
        $item = Owner::find($owner_id);
        UpdatePasswordRequest::rules($request, $item);

        $item->password = Hash::make($request->new_password);
        $item->save();

        return response()->json([
            'data' => $item
        ], config('const.STATUS_CODE.OK'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Owner  $owner
     * @return \Illuminate\Http\Response
     */
    public function destroy(Owner $owner)
    {
        //
    }

    public function showOwnerShop($owner_id)
    {
        $item = Owner::find($owner_id)->shop()->with(['area:id,name', 'genre:id,name'])->first();

        if ($item) {
            return response()->json([
                'data' => $item
            ], config('const.STATUS_CODE.OK'));
        } else {
            return response()->json([], config('const.STATUS_CODE.NO_CONTENT'));
        }
    }
}
