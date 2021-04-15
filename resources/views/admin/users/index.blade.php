<x-admin.admin-master>
    @section('title')
        <h1 class="h3 mb-4 text-gray-800">Все пользователи</h1>
    @show()

    @section('content')
        <!-- DataTales Example -->
    <div class="card shadow mb-4">
        @if(Session::has('message_users'))
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">{{Session::get('message_users')}}</h6>
        </div>
        @endif
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>ID пользователя</th>
                        <th>ФИО</th>
                        <th>Логин</th>
                        <th>Аватар</th>
                        <th>Дата изменения</th>
                        <th>Дата создания</th>
                        <th>Удалить</th>
                    </tr>
                    </thead>
                    <tfoot>
                    <tr>
                    <th>ID пользователя</th>
                        <th>ФИО</th>
                        <th>Логин</th>
                        <th>Аватар</th>
                        <th>Дата изменения</th>
                        <th>Дата создания</th>
                        <th>Удалить</th>
                    </tr>
                    </tfoot>
                    <tbody>
                    @foreach($users as $user)
                    <tr>
                        <td>{{$user->id}}</td>
                        <td><a href="{{route('user.profile.show', $user->id)}}">{{$user->name}}</a></td>
                        <td>{{$user->username}}</td>
                        <td>
                            <img width="200px" src="{{$user->avatar}}" alt="{{$user->name}}">
                        </td>
                        <td>{{$user->updated_at}}</td>
                        <td>{{$user->created_at}}</td>
                        <td>
                            <form method="post" action="{{route('user.destroy', $user)}}" enctype="multipart/form-data">
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
    @show()

    @section('script')
    <!-- Page level plugins -->
    <script src="{{asset('vendor/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>

    <!-- Page level custom scripts -->
    <script src="{{asset('js/demo/datatables-demo.js')}}"></script>
    @show
</x-admin.admin-master>