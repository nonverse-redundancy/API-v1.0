<?php

namespace App\Http\Controllers\Api\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UserDataController extends Controller
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
    public function show(Request $request, $id)
    {
        if (User::where('uuid', $id)->exists()) {
            $user = User::where('uuid', $id)->first();

            return json_encode($user, JSON_PRETTY_PRINT);
        } else {
            $e = array(
                'error' => 'User Not Found',
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
        if (User::where('uuid', $id)->exists()) {
            $user = User::where('uuid', $id)->first();
        } else {
            $e = array(
                'error' => 'User Not Found',
            );
            return response($e, 404);
        }

        $request->validate([
            'name' => 'required',
            'username' => 'required|unique:users,username,'.$user->id,
            'email' => 'required|unique:users,email,'.$user->id,
        ]);

        $firstname = explode(' ', $request->name)[0];
        $lastname = '';
        if (explode(' ', $request->name)[1]) {
            $lastname = explode(' ', $request->name)[1];
        }

        $user->name_first = $firstname;
        $user->name_last = $lastname;
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
