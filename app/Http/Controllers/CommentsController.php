<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Recipe;
use App\Comment;

class CommentsController extends Controller{
    /**
     * Verifica con Auth
     */
    public function __construct(){
        $this->middleware('auth', ['only' => ['store', 'delete']]);
    }
    public function store(Request $request, $id){
        $recipe = Recipe::findOrFail($id);
        $comment = new Comment();
        $comment['body'] = $request->body;
        $comment['published_at'] = Carbon::now();
        $comment->user()->associate(Auth::user());
        $comment->recipe()->associate($recipe);
        $comment->save();
        return back();
    }

    public function delete(Request $request, $id){
        $comment = Comment::findOrFail($id);
        if($comment->recipe->user_id != Auth::user()->id){
            return back();
        }
        $comment->delete();
        return back();
    }
}
