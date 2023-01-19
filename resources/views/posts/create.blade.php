@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"> New Post</div>

                <div class="card-body">
                    <form method="post" action="{{ route('posts.store') }}" enctype="multipart/form-data">
                        @csrf
                        @method('post')

                        @include('layouts.partials._errors')

                        {{--name--}}
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Title <span class="text-danger">*</span></label>
                                    <input type="text" name="title" autofocus class="form-control" value="{{ old('title') }}" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>content <span class="text-danger">*</span></label>
                                    <textarea name="content" autofocus class="form-control"  required>{{ old('content') }}</textarea>
                                </div>
                            </div>
                        </div>


                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Image <span class="text-danger">*</span></label>
                                    <input type="file"  name="image" autofocus class="form-control" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-secondary"><i class="fa fa-plus"></i>Post</button>
                                </div>

                            </div>
                        </div>

                    </form><!-- end of form -->
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
