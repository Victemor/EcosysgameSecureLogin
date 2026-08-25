<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Species;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class AdminController extends Controller
{
    public function index(): View
    {
        return view('admin.dashboard', [
            'users' => User::query()->latest()->paginate(10),
            'userCount' => User::count(),
            'adminCount' => User::where('is_admin', true)->count(),
            'speciesCount' => Species::count(),
            'sessionCount' => DB::table('sessions')->count(),
            'speciesByGroup' => Species::query()
                ->select('group', DB::raw('count(*) as total'))
                ->groupBy('group')
                ->orderByDesc('total')
                ->get(),
        ]);
    }
}
