{{-- Template for the home page, where logged in users can see own posts and create new ones. --}}
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    {{ __('Hi') }} <strong>{{ $user->name }}</strong>, {{ __('you have a total of') }} {{ $posts->total() }} {{ __('posts created') }}.
                    <a class="btn btn-primary float-right" href="/posts/create" role="button">Create post</a>
                </div>

                <div class="card-body">
                     @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
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
