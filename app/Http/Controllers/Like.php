<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Like extends Controller
{
    public function user(Request $request, $id) {
        $userFromId = Auth::id();

        return (new \App\Models\Like())->setNewState($userFromId, $id, \App\Models\Like::ENTITY_TYPE_USER);
    }

    public function vacancy(Request $request, $id) {
        $userFromId = Auth::id();

        return (new \App\Models\Like())->setNewState($userFromId, $id, \App\Models\Like::ENTITY_TYPE_VACANCY);
    }
}
