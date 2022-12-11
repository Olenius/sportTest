<?php

namespace App\Http\Controllers;

use App\Models\JobVacancy;
use Illuminate\Http\Request;
use Illuminate\Queue\Jobs\Job;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class Vacancy extends Controller
{
    public function edit(Request $request, $id = null) {
        $vacancy = null;
        if ($id) {
            $vacancy = JobVacancy::query()->find($id);
            if (!$vacancy) {
                return redirect()->back()->withErrors('Cant find vacancy: ' . $id);
            }
            if (!$vacancy->isOwner()) {
                return redirect()->back()->withErrors('Its not your vacancy: ' . $id);
            }
        }

        $data = array_merge($request->post(), ['userId' => Auth::id()]);

        If ($request->method() == 'POST') {
            if (!$vacancy) {
                //todo transaction
                $vacancy = new JobVacancy($data);
                $vacancy->save();
                //todo pay coins!
            } else {
                $vacancy->edit($data); //todo validate
            }





            return redirect()->route('dashboard', [$vacancy->id])->with('success', 'Vacancy updated successfully');
        }

        return Inertia::render('Vacancy', [
            'vacancy' => $vacancy?->toArray(),
        ]);
    }

    public function delete(Request $request, $id) {
        $vacancy = JobVacancy::query()->find($id);

        if ($vacancy) {
            $vacancy->delete();
        }

        return redirect()->route('dashboard')->with('success', 'Vacancy deleted successfully');
    }
}
