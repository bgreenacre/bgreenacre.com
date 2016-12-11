@foreach ($posts as $post)
<article>
    <h2 class="post-title">{{ link_to_route('page.post', $post->title, array($post->slug)) }}</h2>
    <p class="post-meta">{{ $post->publish_date->format('F j, Y') }} by {{ $post->author->username }}</p>
    {{ Parsedown::instance()->parse($post->content) }}
</article>
@endforeach
{{ $posts->links() }}