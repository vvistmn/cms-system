<x-admin-master>
    @section('title')
        <h1 class="h3 mb-4 text-gray-800">Профиль пользователя: {{$user->name}}</h1>
    @show()

    @section('content')
        <div class="row">
            <div class="col-sm-6">
                <form method="POST" action="{{route('user.profile.update', $user)}}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <img height="120px" width="120px" class="img-profile rounded-circle" src="{{$user->avatar}}" alt="{{$user->name}}">
                    </div>
                    <div class="form-group">
                        <input type="file" name="avatar" class="form-control-file @error('avatar') is-invalid @enderror" id="avatar">
                        @error('avatar')
                            <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="name">Имя и Фамилия пользователя</label>
                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="name" placeholder="Имя и Фамилия пользователя" value="{{$user->name}}">
                        @error('name')
                            <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="username">Логин пользователя</label>
                        <input type="text" name="username" class="form-control @error('username') is-invalid @enderror" id="username" placeholder="Логин пользователя" value="{{$user->username}}">
                        @error('username')
                            <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" id="email" placeholder="Email" value="{{$user->email}}">
                        @error('email')
                            <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="password">Пароль</label>
                        <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" id="password" placeholder="Пароль">
                        @error('password')
                            <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="confirm_password">Подтвердите пароль</label>
                        <input type="password" name="confirm_password" class="form-control @error('confirm_password') is-invalid @enderror" id="confirm_password" placeholder="Подтвердите пароль">
                        @error('confirm_password')
                            <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary">Изменить профиль</button>
                </form>
            </div>
        </div>
    @show()
</x-admin-master>