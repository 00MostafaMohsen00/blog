<?php
namespace App\Interfaces;
use Illuminate\Http\Request;

interface CommentRepositryInterface {
    public function index();
    public function create();
    public function store(Request $request);
    public function show($id);
    public function restore($id);
    public function update(Request $request);
    public function destory($id);
}
