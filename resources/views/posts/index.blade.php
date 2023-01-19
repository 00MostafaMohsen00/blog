@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Posts
                    <a href="{{ route('posts.create') }}" class="btn btn-dark"><i class="fa fa-plus"></i>New Post</a>
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <div class="stream-posts">
                        @foreach ($posts as $post )
                        <div class="stream-post">
                            @if($post->author==auth()->user()->id)
                            <div class="row">
                                <div class="col-md-6">
                                    <a href="{{ route('posts.show',$post->id) }}" class="btn btn-success">update</a>
                                </div>
                                <div class="col-md-6">
                                    <a href="{{ route('posts.delete',$post->id) }}" class="btn btn-danger">Delete</a>
                                </div>
                            </div>
                            @endif
                            <div class="sp-content">
                                <div class="sp-info">{{ $post->user->name }} | {{ $post->title }}<br>{{ $post->created_at }}</div>
                                <p class="sp-paragraph mb-0">{{ $post->content }}</p>
                                <img src="{{ $post->image }}" width="100%" height="350px">
                            </div>
                        </div>

                            <form method="post" action="{{ route('comments.store') }}" id='comment-{{ $post->id }}' >
                                @csrf
                                @method('post')
                                @include('layouts.partials._errors')
                            <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="text" name="comment" autofocus class="form-control" value="{{ old('comment') }}" required>
                                    <input type="hidden" value="{{ $post->id }}" name="post_id">
                                </div>
                            </div>
                            <div class="col-md-6">
                                    <div class="form-group">
                                        <button type="submit"  class="btn btn-secondary">Comment</button>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </form>
                        @foreach ($post->comments as $comment )
                        <div class="row">
                            <div class="col-md-4">
                                <label>{{ $comment->user->name }}</label>
                            </div>
                            <div class="col-md-4">
                                <label>{{ $comment->comment }}</label>
                            </div>
                            @if(auth()->user()->id==$comment->user_id)
                            <div class="col-md-4">
                                <div class="row">
                                    <div class="col-md-3">
                                        <a href="{{ route('comments.delete',$comment->id) }}" class="btn btn-danger">Delete</a>
                                    </div>
                                </div>
                            </div>
                            @endif
                        </div>
                        @endforeach
                    @endforeach



                </div>
            </div>
        </div>
    </div>
</div>
@endsection
