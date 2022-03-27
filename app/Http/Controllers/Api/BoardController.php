<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\BoardRequest;
use App\Http\Resources\BoardResource;
use App\Models\Board;
use Illuminate\Http\Response;

class BoardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $boards = (new Board())->getBoards();

        return BoardResource::collection($boards);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\BoardRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BoardRequest $request)
    {
        $create_board = (new Board())->createBoard($request->validated());

        return new BoardResource($create_board);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $board = (new Board())->getBoard($id);

        return new BoardResource($board);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\BoardRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(BoardRequest $request, $id)
    {
        $update_board = (new Board())->updateBoard($request->validated(), $id);

        return new BoardResource($update_board);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        (new Board())->deleteBoard($id);

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
