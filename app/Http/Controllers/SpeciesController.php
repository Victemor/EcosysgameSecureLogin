<?php

namespace App\Http\Controllers;

use App\Models\Species;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SpeciesController extends Controller
{
    public function index(Request $request): View
    {
        $species = Species::query()
            ->when($request->filled('search'), function ($query) use ($request) {
                $search = '%'.$request->string('search')->trim().'%';

                $query->where(function ($query) use ($search) {
                    $query->where('common_name', 'like', $search)
                        ->orWhere('scientific_name', 'like', $search)
                        ->orWhere('family', 'like', $search);
                });
            })
            ->when($request->filled('group'), fn ($query) => $query->where('group', $request->string('group')))
            ->when($request->filled('status'), fn ($query) => $query->where('conservation_status', $request->string('status')))
            ->orderBy('common_name')
            ->paginate(12)
            ->withQueryString();

        return view('species.index', [
            'species' => $species,
            'groups' => Species::query()->whereNotNull('group')->distinct()->orderBy('group')->pluck('group'),
            'statuses' => Species::query()->whereNotNull('conservation_status')->distinct()->orderBy('conservation_status')->pluck('conservation_status'),
        ]);
    }

    public function show(Species $species): View
    {
        return view('species.show', compact('species'));
    }
}
