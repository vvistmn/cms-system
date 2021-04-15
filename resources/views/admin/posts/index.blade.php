<x-admin.admin-master>
    @section('title')
        <h1 class="h3 mb-4 text-gray-800">Все записи</h1>
    @show()

    @section('content')
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        @if(Session::has('message_posts'))
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">{{Session::get('message_posts')}}</h6>
        </div>
        @endif
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>ID записи</th>
                        <th>Заголовок</th>
                        <th>Контент</th>
                        <th>Картинка</th>
                        <th>Автор</th>
                        <th>Дата изменения</th>
                        <th>Дата создания</th>
                        <th>Удалить</th>
                        <th>Редактировать</th>
                    </tr>
                    </thead>
                    <tfoot>
                    <tr>
                        <th>ID записи</th>
                        <th>Заголовок</th>
                        <th>Контент</th>
                        <th>Картинка</th>
                        <th>Автор</th>
                        <th>Дата изменения</th>
                        <th>Дата создания</th>
                        <th>Удалить</th>
                        <th>Редактировать</th>
                    </tr>
                    </tfoot>
                    <tbody>
                    @foreach($posts as $post)
                    <tr>
                        <td>{{$post->id}}</td>
                        <td>{{$post->title}}</td>
                        <td>{{\Illuminate\Support\Str::limit($post->body, '50', '...')}}</td>
                        <td>
                            <img width="200px" src="{{$post->post_image}}" alt="{{$post->title}}">
                        </td>
                        <td>{{$post->user->name}}</td>
                        <td>{{$post->updated_at}}</td>
                        <td>{{$post->created_at}}</td>
                        <td>
                            @can('delete', $post)
                            <form method="post" action="{{route('post.destroy', $post->id)}}" enctype="multipart/form-data">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Удалить</button>
                            </form>
                            @endcan
                        </td>
                        <td>
                            @can('update', $post)
                            <a href="{{route('post.edit', $post->id)}}" class="btn btn-info">Редактировать</a>
                            @endcan
                        </td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="pagination justify-content-center">
        {{ $posts->links() }}
    </div>
    @show()

    @section('script')
    <!-- Page level plugins -->
    <script src="{{asset('vendor/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>

    <!-- Page level custom scripts -->
    <!-- <script src="{{asset('js/demo/datatables-demo.js')}}"></script> -->
    @show
</x-admin.admin-master>