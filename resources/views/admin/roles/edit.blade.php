<x-admin.admin-master>
    @section('title')
    <h1 class="h3 mb-4 text-gray-800">Редактировать роль - {{$role->name}}</h1>
    @show

    @section('content')
        <div class="col-sm-6">
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
    @show()
</x-admin.admin-master>