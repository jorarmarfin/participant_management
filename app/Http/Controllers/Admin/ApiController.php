<?php

namespace App\Http\Controllers\Admin;

use App\Enums\ParticipantStatus;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Traits\EventsTrait;
use App\Traits\ParticipantTrait;
use App\Traits\UbigeoTrait;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ApiController extends Controller
{
    use ParticipantTrait, UbigeoTrait,EventsTrait;
    public function getToken(Request $request):JsonResponse
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
        $user = User::where('email', $request->email)->first();
        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        return response()->json(['token' => $user->createToken('token-'.$user->name)->plainTextToken]);
    }
    public function addParticipantSignature(Request $request):JsonResponse
    {
        $participant = $this->getParticipantByField('email', $request->email);
        $data = $request->all();
        if($participant){
            return response()->json(
                [
                    'message' => 'error',
                    'data' => 'participant already exists'
                ]
            );
        }else{
            $ubigeo_id = $this->getUbigeoIdByDescription($request->ubigeo);
            $data['ubigeo_id'] = $ubigeo_id;
            unset($data['ubigeo']);
            $data['status'] = ParticipantStatus::newCampaigns->value;
            $event_id = $this->getEventByField('type','web')->id;
            $participant = $this->storeParticipant($data,$event_id);
        }

        return response()->json(
            [
                'message' => 'success',
                'data' => $participant
            ]
        );

    }
}
