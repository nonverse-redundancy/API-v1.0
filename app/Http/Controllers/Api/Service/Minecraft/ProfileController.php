<?php

namespace App\Http\Controllers\Api\Service\Minecraft;

use App\Http\Controllers\Controller;
use App\Models\Service\Service;
use App\Models\Service\Minecraft\LuckpermsPlayer;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $user = $request->user();
        $carbon = new Carbon();
        $service = Service::where('uuid', $user->uuid)->get()->whereIn('service_id', 'mc-java.service')->first();
        if ($lucko = LuckpermsPlayer::where('username', $service->service_user)->exists()) {
            $lucko = LuckpermsPlayer::where('username', $service->service_user)->first();
            $rank = $lucko->primary_group;
        } else {
            $rank = 'default';
        }

        $joinedraw = explode('-', explode(' ', $service->created_at)[0]);

        $profile = array(
            'username' => $service->service_user,
            'rank' => $rank,
            'joined' => $joinedraw[2] . '-' . $joinedraw[1] . '-' . $joinedraw[0],
        );

        return json_encode($profile, JSON_PRETTY_PRINT);
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
        //
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
