<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $boards = Auth::user()->boards()->paginate(6);

        $pending_tasks = Task::where('status', 'pending')->count();
        $completed_tasks = Task::where('status', 'completed')->count();

        return view('home', compact(['boards', 'pending_tasks', 'completed_tasks']));
    }
}
