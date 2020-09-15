{{-- This is the Post blade template, that will be re-usable in the index page and home page for logged in users --}}
<div class="card">
    <div class="card-header">
        {{ $post->title }}
    </div>
    <div class="card-body">
        <blockquote class="blockquote mb-0">
            <p>{{ $post->description }}</p>
            {{-- diffForHumans is used to format the publication_date to something more human readable --}}
            <footer class="blockquote-footer">{{ $post->publication_date->diffForHumans() }}</footer>
        </blockquote>
    </div>
</div>
<br>