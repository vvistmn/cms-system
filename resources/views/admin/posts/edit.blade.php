<x-admin.admin-master>
    @section('title')
    <h1 class="h3 mb-4 text-gray-800">Редактировать запись - {{$post->title}}</h1>
    @show

    @section('content')
        <form method="POST" action="{{route('post.update', $post->id)}}" enctype="multipart/form-data">
            @csrf
            @method('PATCH')
            <div class="form-group">
                <label for="title">Введите заголовок записи</label>
                <input type="text" name="title" class="form-control" id="title" aria-describedby="" placeholder="Тут должен быть заголовок записи" value="{{$post->title}}">
            </div>
            <div class="form-group">
                <textarea name="body" class="form-control" id="body"cols="30" rows="10">{{$post->body}}</textarea>
            </div>
            <div class="form-group">
                <img width="200px" src="{{$post->post_image}}" alt="{{$post->title}}"><br>
                <label for="post_image">Изображение записи</label>
                <input type="file" name="post_image" class="form-control-file" id="post_image">
            </div>
            <button type="submit" class="btn btn-primary">Сохранить запись</button>
        </form>
    @show()
</x-admin.admin-master>