<?php
namespace App\Repositries;

use App\Http\Traits\FileTrait;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

use App\Interfaces\CommentRepositryInterface;
use App\Models\Comment;
use App\Models\Post;

class CommentRepositry implements CommentRepositryInterface
{
    public function index(){
        $comments=Comment::where('user_id',auth()->user()->id)->onlyTrashed()->get();
        return view('comments.index',get_defined_vars());
    }

    public function create(){
    }

    public function store(Request $request){
        $request->validate([
            'post_id'=>'required|exists:posts,id',
            'comment'=>'required|min:20'
        ]);
        $comment=new Comment();
        $comment->comment=$request->comment;
        $comment->user_id=auth()->user()->id;
        $comment->post_id=$request->post_id;
        $comment->save();
        return redirect()->back()->with('status','comment Posted Successfully');
    }

    public function show($id){
        $comment=Comment::withTrashed()->where('id',$id)->first();
        if(auth()->user()->id==$comment->user_id){
            $comment->forceDelete();
            return redirect()->back()->with('status','Comment Deleted Successfully');
        }
        return abort('404');
    }
    public function restore($id){
        $comment=Comment::withTrashed()->where('id',$id)->first();
        if(auth()->user()->id==$comment->user_id){
            $comment->restore();
            return redirect()->back()->with('status','Comment Restored Successfully');
        }
        return abort('404');
    }
    public function update(Request $request){

    }
    public function destory($id){
        $comment=Comment::findOrFail($id);
        if(auth()->user()->id==$comment->user_id){
            $comment->delete();
            return redirect()->back()->with('status','Comment Deleted Successfully');
        }
        return abort('404');
    }


}

