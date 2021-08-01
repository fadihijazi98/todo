<?php

namespace App\Http\Controllers;

use App\Models\Board;
use App\Models\Color;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BoardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return redirect('/home');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $path = 'Board - create';
        $colors = Color::all();

        return view('board.create', compact(['path', 'colors']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $this->validateBoardData();

        $board = Board::create($validated);

        return redirect('/home');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show(Board $board)
    {
        $path = "Board, Edit";
        $colors = Color::all();

        return view('board.edit', compact(['board', 'colors', 'path']));
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
    public function update(Board $board)
    {
        $validated = $this->validateBoardData(false);

        if ($this->isTheOwnerOfBoard($board))
            $board->update($validated);

        return redirect('/board');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Board $board)
    {
        if ($this->isTheOwnerOfBoard($board))
            $board->delete();

        return back();
    }

    public function search()
    {
        $result = [];

        if ($keyword = \request('keyword'))
            $result = Board::where('name', 'regexp', $keyword)->get()->values();

        return response()->json($result);
    }

    private function validateBoardData($is_in_create_mode = true)
    {
        $share_id = uniqid();

        $validated = \request()->validate([
            'name' => 'required',
            'user_id' => 'required|integer|exists:users,id',
            'color_id' => 'required|integer|exists:colors,id'
        ]);

        if (\request()->has('description'))
            $validated['description'] = \request('description');

        if ($is_in_create_mode)
            $validated['share_board_id'] = $share_id;

        return $validated;
    }

    private function isTheOwnerOfBoard(Board $board)
    {
        return $board->user_id == Auth::id();
    }

}
