<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
//        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $boards = Auth::user()->boards()->orderBy('created_at', 'DESC')->paginate(6);

        $auth_user = Auth::user();

        $tasks_completed = DB::table('tasks')
            ->join('boards', 'tasks.board_id', '=', 'boards.id')
            ->where('boards.user_id', Auth::id())
            ->where('tasks.status', '=', 'completed')->count();

        $tasks_pending = DB::table('tasks')
            ->join('boards', 'tasks.board_id', '=', 'boards.id')
            ->where('boards.user_id', Auth::id())
            ->where('tasks.status', '=', 'pending')->count();


        $completed_tasks = $tasks_completed;
        $pending_tasks = $tasks_pending;

        return view('home', compact(['boards', 'pending_tasks', 'completed_tasks']));
    }
}
