<?php

namespace App\Http\Controllers\Api\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\UserRecovery;

class UserRecoveryController extends Controller
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (UserRecovery::where('uuid', $id)->exists()) {
            $user = UserRecovery::where('uuid', $id)->first();

            return json_encode($user, JSON_PRETTY_PRINT);
        } else {
            $e = array(
                'error' => 'User Not Found,'
            );
            return response($e, 404);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = false;
        if (UserRecovery::where('uuid', $id)->exists()) {
            $user = UserRecovery::where('uuid', $id)->first();
        } else {
            $e = array(
                'error' => 'User Not Found',
            );
            return response($e, 404);
        }

        $request->validate([
            'email' => 'required|email',
        ]);

        $user->email = $request->email;

        $query = $user->save();

        if ($query) {
            return response(200);
        } else {
            return response(500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
