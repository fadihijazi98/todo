<?php

namespace App\Http\Controllers;

use App\Models\Color;
use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $this->validateTaskData();

        $task = Task::create($validated);

        return response()->json($task);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show(Task $task)
    {
        $path = "Task";

        return view('task.edit', compact(['task', 'path']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Task $task)
    {
        $validation = $this->validateTaskData();

        $task->update($validation);

        return redirect(route('board.show', $task->board));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Task $task)
    {
        $board = $task->board;

        $task->delete();

        return redirect(route('board.show', $board));
    }

    public function search()
    {
        $result = [];

        if (\request()->has('keyword'))
            $result = Task::where('title', 'regexp', \request('keyword'))->get()->values();

        return response()->json(
            $result
        );
    }

    protected function markTaskAsCompleted(Task $task)
    {
        $task->update([
            'status' => 'completed'
        ]);

        return response()->json([
            'success' => true,
            'task' => $task
        ]);
    }

    protected function markTaskAsPending(Task $task)
    {
        $task->update([
            'status' => 'pending'
        ]);

        return response()->json([
            'success' => true,
            'task' => $task
        ]);
    }

    private function validateTaskData()
    {
        $validation = [
            'title' => 'required|string',
            'priority' => 'required|in:high,mid,low',
            'status' => 'required|in:pending,completed',
        ];

        if (\request('description'))
            $validation['description'] = 'required|string';
        if (\request('due_time'))
            $validation['due_time'] = 'required|date';
        if(\request('board_id'))
            $validation['board_id'] = 'required|exists:boards,id';

        return \request()->validate(
            $validation
        );
    }
}
