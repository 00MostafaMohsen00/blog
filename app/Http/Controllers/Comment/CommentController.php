<?php

namespace App\Http\Controllers\Comment;

use App\Http\Controllers\Controller;
use App\Interfaces\CommentRepositryInterface;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public $comment;

    public function __construct(CommentRepositryInterface $comment)
    {
        $this->comment=$comment;
    }
    public function index()
    {
        return $this->comment->index();
    }




    public function store(Request $request)
    {
        return $this->comment->store($request);
    }


    public function show($id)
    {
        return $this->comment->show($id);
    }

    public function restore($id)
    {
        return $this->comment->restore($id);

    }

    public function destroy($id)
    {
        return $this->comment->destory($id);
    }
}
