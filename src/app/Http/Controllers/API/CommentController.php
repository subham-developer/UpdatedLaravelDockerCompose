<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Comment;

class CommentController extends Controller
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public static function store(Request $request)
    {

        $request->validate([
            'comment' => 'required|max:200'
        ]);

        $comment = new Comment;
        $comment->user_id = $request->user_id;
        $comment->project_id = $request->project_id;
        $comment->comment = $request->comment;
        $comment->save();
        $data['comment'] = $comment;

        return response()->json([
            'status' => 201,
            'message' => 'Comment store successfully!',
            'data' => $data
        ],201);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $comment = Comment::find($id);
        $comment->comment = $request->comment;
        $comment->save();

        $data['comment'] = $comment;

        return response()->json([
            'status' => 200,
            'message' => 'Comment updated successfully!',
            'data' => $data
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Comment::destroy($id);

        return response()->json([
            'status' => 200,
            'message' => 'Comment deleted successfully!',
        ]);
    }
}
