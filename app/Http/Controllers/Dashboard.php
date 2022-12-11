<?php

namespace App\Http\Controllers;

use App\Models\JobVacancy;
use Illuminate\Http\Request;
use Inertia\Inertia;

class Dashboard extends Controller
{
    public function main() {
        $vacancies = (new JobVacancy())->getForDashboard();
        return Inertia::render('Dashboard', [
            'vacancies' => $vacancies,
        ]);
    }
}
