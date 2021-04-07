<x-admin-master>
    @section('title')
        <h1 class="h3 mb-4 text-gray-800">Все записи</h1>
    @show()

    @section('content')
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">DataTables Example</h6>
        </div>
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
                    </tr>
                    </tfoot>
                    <tbody>
                    @foreach($posts as $post)
                    <tr>
                        <td>{{$post->id}}</td>
                        <td>{{$post->title}}</td>
                        <td>{{\Illuminate\Support\Str::limit($post->body, '50', '...')}}</td>
                        <td>
                            @if (stripos($post->post_image, 'http') !== false)
                                <img height="40px" src="{{$post->post_image}}" alt="{{$post->title}}">
                            @else
                                <img height="40px" src="{{asset('storage/' . $post->post_image)}}" alt="{{$post->title}}p">
                            @endif
                        </td>
                        <td>{{$post->user->name}}</td>
                        <td>{{$post->updated_at}}</td>
                        <td>{{$post->created_at}}</td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @show()

    @section('script')
    <!-- Page level plugins -->
    <script src="{{asset('vendor/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>

    <!-- Page level custom scripts -->
    <script src="{{asset('js/demo/datatables-demo.js')}}"></script>
    @show
</x-admin-master>