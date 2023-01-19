@extends('layouts.app')

@section('content')
@include('layouts.partials._errors')
@if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
<div class="row">

    <div class="col-md-12">

        <div class="table-responsive">

            <table class="table datatable" id="admins-table" style="width: 100%;">
                <thead class="alldata">
                <tr>
                    <th>Title</th>
                    <th>Content</th>
                    <th>Operations</th>
                </tr>
            <tbody class="alldata">
            @foreach ($posts as $post)
                <tr id="sid{{ $post->id }} ">
                        <td>
                            {{ $post->title }}
                        </td>
                        <td>
                            {{ $post->content }}
                        </td>

                   <td><a href="{{ route('post.destroy',$post->id) }}" class="btn btn-danger btn-sm">Delete</a>
                   <a href="{{ route('post.restore',$post->id) }}" class="btn btn-warning btn-sm">Restore</a></td>
                </tr>
                @endforeach
                </tbody>
            </table>

        </div><!-- end of table responsive -->

    </div><!-- end of col -->

</div><!-- end of row -->

@endsection
