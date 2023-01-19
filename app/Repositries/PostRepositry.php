<?php
namespace App\Repositries;

use App\Http\Traits\FileTrait;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

use App\Interfaces\PostRepositryInterface;
use App\Models\Post;

class PostRepositry implements PostRepositryInterface
{
    use FileTrait;
    public function index(){
        $posts=Post::all();
        return view('posts.index',get_defined_vars());
    }

    public function create(){
        return view('posts.create');
    }
    public function trash(){
        $posts=Post::where('author',auth()->user()->id)->onlyTrashed()->get();
        return view('posts.trash',get_defined_vars());

    }
    public function delete($id){
        $post=Post::withTrashed()->where('id',$id)->first();
        if(auth()->user()->id==$post->author){
            $post->forceDelete();
            return redirect()->back()->with('status','Post Deleted Successfully');
        }
        return abort('404');
    }
    public function restore($id){
        $post=Post::withTrashed()->where('id',$id)->first();
        if(auth()->user()->id==$post->author){
            $post->restore();
            return redirect()->back()->with('status','Post Restored Successfully');
        }
        return abort('404');
    }

    public function store(Request $request){
        $request->validate([
            'title'=>'required|unique:posts,title|alpha',
            'content'=>'required|min:20',
            'image'=>'required|file|image|max:2000'
        ]);
        $post=new Post();
        $post->title=$request->title;
        $post->content=$request->content;
        $post->author=auth()->user()->id;
        $post->save();
        $post->image=$this->saveImage($request->image,$post->id,'posts',$post->id);
        $post->save();
        return redirect()->route('home')->with('status','Post Successfully Uploaded');
    }

    public function show($id){
        $post=Post::findOrFail($id);
        if($post->author==auth()->user()->id){
            return view('posts.edit',get_defined_vars());
        }
        return abort('404');
    }

    public function update(Request $request){
        $request->validate([
            'title'=>'required|unique:posts,title,'.$request->post_id.'|alpha',
            'content'=>'required|min:20',
            'image'=>'sometimes|file|image|max:2000',
            'post_id'=>'required|exists:posts,id'
        ]);
        $post=Post::findOrFail($request->post_id);
        if($post->author==auth()->user()->id){
            $post->title=$request->title;
            $post->content=$request->content;
            $post->save();
            if($request->image){
                $post->image=$this->saveImage($request->image,$post->id,'posts',$post->id);
            }

            $post->save();
            return redirect()->route('home')->with('status','Post Successfully Uploaded');
        }

        return abort('404');

    }
    public function destory($id){
        $post=Post::findOrFail($id);

        if(auth()->user()->id==$post->author)
        {
            $post->delete();
            return redirect()->route('home')->with('status','Post Deleted Successfully...');
        }
        return abort('404');

    }


}

