<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\BoardListRequest;
use App\Http\Resources\BoardListResource;
use App\Models\BoardList;
use Illuminate\Http\Response;

class BoardListController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $lists = (new BoardList())->getLists();

        return BoardListResource::collection($lists);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\BoardListRequest;  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BoardListRequest $request)
    {
        $create_list = (new BoardList())->createList($request->validated());

        return new BoardListResource($create_list);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $list = (new BoardList())->getList($id);

        return new BoardListResource($list);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\BoardListRequest;  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(BoardListRequest $request, $id)
    {
        $update_list = (new BoardList())->updateList($request->validated(), $id);

        return new BoardListResource($update_list);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        (new BoardList())->deleteList($id);

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
