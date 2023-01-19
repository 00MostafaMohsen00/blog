<?php
namespace App\Interfaces;
use Illuminate\Http\Request;

interface PostRepositryInterface {
    public function index();
    public function trash();
    public function delete($id);
    public function restore($id);
    public function create();
    public function store(Request $request);
    public function show($id);
    public function update(Request $request);
    public function destory($id);
}
