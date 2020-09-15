{{-- Template for the index page, where anon users can see public post by the community. --}}
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    {{ __('Community Posts') }} - {{ $posts->total() }} posts found.
                    @auth
                        <a class="btn btn-primary float-right" href="/home" role="button">My posts</a>
                    @endauth
                </div>

                <div class="card-body">
                    {{-- Instead of using a foreach, let's use Laravel build-in foreach on blades templates --}}
                    {{-- using a custom template to render our post data where we want it --}}
                    <div class="list-group">
                        @each('posts', $posts, 'post')
                        {{-- Let's render the pagination links --}}
                        {{ $posts->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection