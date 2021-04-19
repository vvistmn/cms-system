<x-admin.admin-master>
    @section('title')
    <h1 class="h3 mb-4 text-gray-800">Редактировать роль - {{$role->name}}</h1>
    @show

    @section('content')
       <div class="row">
        <div class="col-sm-6">
                @if(Session::has('message_role'))
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">{{Session::get('message_role')}}</h6>
                </div>
                @endif
                <form method="POST" action="{{route('role.update', $role->id)}}" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')
                    <div class="form-group">
                        <label for="name">Наименование роли</label>
                        <input type="text" name="name" class="form-control" id="name" placeholder="Наименование роли" value="{{$role->name}}">
                    </div>
                    <button type="submit" class="btn btn-primary">Сохранить изменения</button>
                </form>
            </div>
       </div><br>

        @if($permissions->isNotEmpty())
       <div class="row">
            <div class="col-lg-12">
                <div class="card shadow mb-4">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                <tr>
                                    <th>Выбрать</th>
                                    <th>ID разрешения</th>
                                    <th>Название</th>
                                    <th>Slug</th>
                                    <th>Удалить</th>
                                </tr>
                                </thead>
                                <tfoot>
                                <tr>
                                    <th>Выбрать</th>
                                    <th>ID разрешения</th>
                                    <th>Название</th>
                                    <th>Slug</th>
                                    <th>Удалить</th>
                                </tr>
                                </tfoot>
                                <tbody>
                                @foreach($permissions as $permission)
                                <tr>
                                    <td><input type="checkbox"
                                        @foreach($role->permissions as $role_permission)
                                            @if($role_permission->slug == $permission->slug)
                                                checked
                                            @endif
                                        @endforeach
                                        ></td>
                                    <td>{{$permission->id}}</td>
                                    <td><a href="{{route('permission.edit', $permission->id)}}">{{$permission->name}}</a></td>
                                    <td>{{$permission->slug}}</td>
                                    <td>
                                        <form method="post" action="{{route('role.permission.attach', $role)}}" enctype="multipart/form-data">
                                            @csrf
                                            @method('PUT')
                                            <input type="hidden" value="{{$permission->id}}" name="permission">
                                            <button type="submit" class="btn btn-primary"
                                            @if($role->permissions->contains($permission)) disabled @endif>Добавить</button>
                                        </form>
                                    </td>
                                    <td>
                                        <form method="post" action="{{route('role.permission.detach', $role)}}" enctype="multipart/form-data">
                                            @csrf
                                            @method('DELETE')
                                            <input type="hidden" value="{{$permission->id}}" name="permission">
                                            <button type="submit" class="btn btn-danger"
                                            @if(!$role->permissions->contains($permission)) disabled @endif>Удалить</button>
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
       @endif;
    @show()
</x-admin.admin-master>