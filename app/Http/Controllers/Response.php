<?php

namespace App\Http\Controllers;

use App\Models\JobVacancy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class Response extends Controller
{

    public function list($vacancyId) {
        $responses = (new \App\Models\Response())->getList($vacancyId);
        $vacancy = JobVacancy::query()->find($vacancyId);
        return Inertia::render('ResponseList', [
            'responses' => $responses,
            'vacancy' => $vacancy?->toArray(),
        ]);
    }

    public function add($vacancyId) {
        $userId = Auth::id();
        if (\App\Models\Response::query()
            ->where('userId', $userId)
            ->where('vacancyId', $vacancyId)
            ->exists()
        ) {
            return redirect()->back()->withErrors('You already responded on this vacancy');
        }

        return Inertia::render('ResponseAdd', [
            'vacancyId' => $vacancyId
        ]);

    }

    public function save(Request $request) {
        $userId = Auth::id();
        if (\App\Models\Response::query()
            ->where('userId', $userId)
            ->where('vacancyId', $request->post('vacancyId'))
            ->exists()
        ) {
            return redirect()->back()->withErrors('You already responded on this vacancy');
        }

        //todo validation
        //todo transaction

        //todo email queue
        //todo spend 1 coin
        (new \App\Models\Response([
            'userId' => $userId,
            'vacancyId' => $request->post('vacancyId'),
            'message' => $request->post('message')
        ]))->save();

        return redirect()->route('dashboard')->with('success', 'Response added successfully');
    }

}
