<?php

namespace App\Http\Controllers\Post;

use App\Http\Controllers\Controller;
use App\Interfaces\PostRepositryInterface;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public $post;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(PostRepositryInterface $post){
        $this->post=$post;
    }

    public function index()
    {
        return $this->post->index();
    }

    public function trash(){
        return $this->post->trash();
    }
    public function delete($id){
        return $this->post->delete($id);
    }
    public function restore($id){
        return $this->post->restore($id);
    }
    public function create()
    {
        return $this->post->create();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return $this->post->store($request);
    }


    public function show($id)
    {
        return $this->post->show($id);
    }

    public function update(Request $request,$id)
    {
        return $this->post->update($request);
    }

    public function destroy($id)
    {
        return $this->post->destory($id);
    }
}
