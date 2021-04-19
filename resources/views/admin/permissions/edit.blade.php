<x-admin.admin-master>
    @section('title')
    <h1 class="h3 mb-4 text-gray-800">Редактировать разрешение - {{$permission->name}}</h1>
    @show

    @section('content')
        <div class="row">
            <div class="col-sm-6">
                @if(Session::has('message_permission'))
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">{{Session::get('message_permission')}}</h6>
                </div>
                @endif
                <form method="POST" action="{{route('permission.update', $permission->id)}}" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')
                    <div class="form-group">
                        <label for="name">Название разрешений</label>
                        <input type="text" name="name" class="form-control" id="name" placeholder="Название разрешений" value="{{$permission->name}}">
                    </div>
                    <button type="submit" class="btn btn-primary">Сохранить изменения</button>
                </form>
            </div>  
        </div><br>

        @if($roles->isNotEmpty())
        <div class="row">
            <div class="col-lg-12">
                <div class="card shadow mb-4">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                <tr>
                                    <th>Выбрать</th>
                                    <th>ID роли</th>
                                    <th>Название</th>
                                    <th>Slug</th>
                                    <th>Удалить</th>
                                </tr>
                                </thead>
                                <tfoot>
                                <tr>
                                    <th>Выбрать</th>
                                    <th>ID роли</th>
                                    <th>Название</th>
                                    <th>Slug</th>
                                    <th>Удалить</th>
                                </tr>
                                </tfoot>
                                <tbody>
                                @foreach($roles as $role)
                                <tr>
                                    <td><input type="checkbox"
                                        @foreach($permission->roles as $permission_role)
                                            @if($permission_role->slug == $role->slug)
                                                checked
                                            @endif
                                        @endforeach
                                        ></td>
                                    <td>{{$role->id}}</td>
                                    <td><a href="{{route('role.edit', $role->id)}}">{{$role->name}}</a></td>
                                    <td>{{$role->slug}}</td>
                                    <td>
                                        <form method="post" action="{{route('permission.role.attach', $permission)}}" enctype="multipart/form-data">
                                            @csrf
                                            @method('PUT')
                                            <input type="hidden" value="{{$role->id}}" name="role">
                                            <button type="submit" class="btn btn-primary"
                                            @if($permission->roles->contains($role)) disabled @endif>Добавить</button>
                                        </form>
                                    </td>
                                    <td>
                                        <form method="post" action="{{route('permission.role.detach', $permission)}}" enctype="multipart/form-data">
                                            @csrf
                                            @method('DELETE')
                                            <input type="hidden" value="{{$role->id}}" name="role">
                                            <button type="submit" class="btn btn-danger"
                                            @if(!$permission->roles->contains($role)) disabled @endif>Удалить</button>
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
       </div>
        @endif
    @show()
</x-admin.admin-master>