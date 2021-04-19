<x-admin.admin-master>
    @section('title')
        <h1 class="h3 mb-4 text-gray-800">Все разрешения</h1>
    @show()

    @section('content')
        <div class="row">
            <div class="col-sm-3">
                <form method="post" action="{{route('permission.store')}}">
                    @csrf
                    <div class="form-group">
                        @error('name')
                            <span><strong>{{$message}}</strong></span><br>
                        @enderror
                        <label for="name">Название разрешения</label>
                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="name" placeholder="Название новой разрешение">
                    </div>
                    <button type="submit" class="btn btn-primary btn-block">Сохранить разрешение</button>
                </form>
            </div>
            @if(!empty($permissions))
            <div class="col-sm-9">
                <div class="card shadow mb-4">
                    @if(Session::has('message_permission'))
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">{{Session::get('message_permission')}}</h6>
                    </div>
                    @endif
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                <tr>
                                    <th>ID разрешения</th>
                                    <th>Название</th>
                                    <th>Slug</th>
                                    <th>Удалить</th>
                                </tr>
                                </thead>
                                <tfoot>
                                <tr>
                                    <th>ID разрешения</th>
                                    <th>Название</th>
                                    <th>Slug</th>
                                    <th>Удалить</th>
                                </tr>
                                </tfoot>
                                <tbody>
                                @foreach($permissions as $permission)
                                <tr>
                                    <td>{{$permission->id}}</td>
                                    <td><a href="{{route('permission.edit', $permission->id)}}">{{$permission->name}}</a></td>
                                    <td>{{$permission->slug}}</td>
                                    <td>
                                        <form method="post" action="{{route('permission.destroy', $permission->id)}}" enctype="multipart/form-data">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">Удалить</button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            @endif    
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