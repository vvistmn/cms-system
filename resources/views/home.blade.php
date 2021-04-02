<x-home-master>
    @section('content')
        <h1 class="my-4">Главная страница
            <small>Дополнительный текст</small>
        </h1>
        
        <!-- Blog Post -->
        @foreach ($posts as $post) 
        <div class="card mb-4">
            @if (!empty($post->post_image))
            <img class="card-img-top" src="{{$post->post_image}}" alt="Card image cap">
            @endif
            <div class="card-body">
            @if (!empty($post->title))
            <h2 class="card-title">{{$post->title}}</h2>
            @endif
            @if (!empty($post->body))
            <p class="card-text">{{\Illuminate\Support\Str::limit($post->body, '50', '...')}}</p>
            @endif
            <a href="{{route('post') . '/' . $post->id}}" class="btn btn-primary">Подробнее</a>
            </div>
            <div class="card-footer text-muted">
            Posted on {{$post->created_at}} by
            <a href="#">Start Bootstrap</a>
            </div>
        </div>
        @endforeach

        <!-- Pagination -->
        <ul class="pagination justify-content-center mb-4">
            <li class="page-item">
            <a class="page-link" href="#">&larr; Older</a>
            </li>
            <li class="page-item disabled">
            <a class="page-link" href="#">Newer &rarr;</a>
            </li>
        </ul>
    @endsection
</x-home-master>