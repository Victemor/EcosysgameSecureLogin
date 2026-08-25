<?php

namespace App\Http\Controllers;

use App\Models\Species;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function __invoke(): View
    {
        return view('home', [
            'speciesCount' => Species::count(),
            'featuredSpecies' => Species::whereIn('scientific_name', [
                'Leopardus tigrinus',
                'Tremarctos ornatus',
                'Rallus semiplumbeus',
            ])->get(),
        ]);
    }
}
