<?php

namespace App\Http\Controllers;

use App\Events\SendPersonalMessageEvent;
use App\Http\Requests\Personal\StoreMessageRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PersonalController extends Controller
{
    public function show(User $user)
    {
        $personal = $user;

        return inertia('Personal/Show', compact('personal'));
    }

    public function sendPersonalMessage(User $user)
    {
        $fromUserId = Auth::user()->id;
        $personalMessage = "User #{$fromUserId} sent personal message for you.";

        broadcast(new SendPersonalMessageEvent($user->id, $personalMessage))->toOthers();

        return response()->json(['personalMessage' => $personalMessage]);
    }
}
