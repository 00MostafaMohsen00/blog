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
                    <th>Comment</th>
                    <th>Post</th>
                    <th>Operations</th>
                </tr>
            <tbody class="alldata">
            @foreach ($comments as $comment)
                <tr id="sid{{ $comment->id }} ">
                        <td>
                            {{ $comment->comment }}
                        </td>
                        <td>
                            {{ $comment->post->title }}
                        </td>

                   <td><a href="{{ route('comments.show',$comment->id) }}" class="btn btn-danger btn-sm">Delete</a>
                   <a href="{{ route('comments.restore',$comment->id) }}" class="btn btn-warning btn-sm">Restore</a></td>
                </tr>
                @endforeach
                </tbody>
            </table>

        </div><!-- end of table responsive -->

    </div><!-- end of col -->

</div><!-- end of row -->

@endsection
