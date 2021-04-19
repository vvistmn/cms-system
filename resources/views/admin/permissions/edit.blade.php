<x-admin.admin-master>
    @section('title')
    <h1 class="h3 mb-4 text-gray-800">Редактировать разрешение - {{$permission->name}}</h1>
    @show

    @section('content')
        <div class="col-sm-6">
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
    @show()
</x-admin.admin-master>