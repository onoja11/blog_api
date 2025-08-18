@foreach ($posts as $post )

    <strong>{{ $post->title }}</strong>
    <p>User : <span>{{ $post->user->name }}</span></p>
    <p>{!! $post->content !!}</p>
    
@endforeach
    {{-- {!! $posts->links() !!} --}}
