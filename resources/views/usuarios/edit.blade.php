@extends('layouts.frontend')
@section('title', 'Editar Usuario '. $user->name)
@section('content')
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0 font-size-18">Editar usuario</h4>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="{{url('home')}}"><i class="fas fa-home"></i></a></li>
                    <li class="breadcrumb-item"><a href="{{url('users')}}">Usuarios</a></li>
                    <li class="breadcrumb-item active">Editar Usuario {{$user->name}}</li>
                </ol>
            </div>

        </div>
    </div>
</div>
<div class="row">
    <div class="col-12 col-md-4">
        <div class="card">
            <div class="card-body">
                <form action="{{route('users.update', $user->id)}}" method="POST" autocomplete="off">
                    @csrf
                    @method('PUT')
        
                    <div class="mb-3">
        
                        <label for="name">Nombre y Apellido</label>
        
                        <input type="text" name="name" value="{{old('name', $user->name)}}" class="form-control">
        
                    </div>
        
                    <div class="mb-3">
        
                        <label for="name">RUT</label>
        
                        <input type="rut" name="rut" id="rut" value="{{old('rut', $user->rut)}}" class="form-control">
        
                    </div>
                    <div class="mb-3">
        
                        <label for="name">Correo Electronico</label>
        
                        <input type="email" name="email" value="{{old('email', $user->email)}}" class="form-control">
        
                    </div>
        
                    <div class="mb-3">
        
                        <label for="password">Contraseña</label>
        
                        <input type="text" name="password" class="form-control" placeholder="Contraseña">
        
                        <small id="passwordHelpBlock" class="form-text text-danger">
        
                            Dejar en blanco si no quiere cambiar la contraseña
        
                            </small>
        
                    </div>
        
                    <div class="mb-3">
        
                        <label for="password_confirmation">Confirmar Contraseña</label>
        
                        <input type="text" name="password_confirmation" class="form-control" placeholder="Repite la Contraseña">
        
                    </div>
                    
                    <center>
                        <button type="submit" class="btn btn-primary">Actualizar</button>
                        <a href="{{route('users.index')}}" class="btn btn-danger">Cancelar</a>
                    </center>
        
                </form>
            </div>
        </div>
    </div>
    <div class="col-12 col-md-8">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title mb-4">Roles de Usuario</h4>
                <div class="table-responsive">
                    @role('Admin')
                        <form action="{{route('users.roles.update', $user->id)}}" method="POST">
                            @csrf
                            @method('PUT')
                            <table class="table table-nowrap table-hover mb-0">
                                <thead>
                                    <tr>
                                        <th scope="col">Roles</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($roles as $role)
                                        <tr>
                                            <td>
                                                <div class="form-check mb-3">
                                                    <input class="form-check-input" name="roles[]" type="checkbox" id="{{$role->name}}" value="{{$role->name}}" {{ $user->roles->contains($role->id) ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="{{$role->name}}">
                                                        {{$role->name}}
                                                    </label>
                                                </div>
                                            </td>
                                            <td>
                                            <small class="text-muted">{{ $role->permissions->pluck('name')->implode(', ') }}</small>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <br>
                            <button type="submit" class="btn btn-primary btn-block">Actualizar roles</button>
                        </form>
                    @else
                        <table class="table table-nowrap table-hover mb-0">
                            <thead>
                                <tr>
                                    <th scope="col">Roles</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($user->roles as $role)
                                    <tr>
                                        <td>
                                            <div class="form-check mb-3">
                                                <label class="form-check-label" for="{{$role->name}}">
                                                    {{$role->name}}
                                                </label>
                                            </div>
                                        </td>
                                        <td>
                                        <small class="text-muted">{{ $role->permissions->pluck('name')->implode(', ') }}</small>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endrole
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <h4 class="card-title mb-4">Permisos de Usuario</h4>
                <div class="table-responsive">
                    @role('Admin')
                    <form action="{{route('users.permissions.update', $user->id)}}" method="POST">
                        @csrf
                        @method('PUT')
                        <table class="table table-nowrap table-hover mb-0">
                            <thead>
                                <tr>
                                    <th scope="col">Permisos</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($permissions as $id => $name)
                                    <tr>
                                        <td>
                                            <div class="form-check mb-3">
                                                <input class="form-check-input" name="permissions[]" type="checkbox" id="{{$name}}" value="{{$name}}" {{ $user->permissions->contains($id) ? 'checked' : '' }}>
                                                <label class="form-check-label" for="{{$name}}">
                                                    {{$name}}
                                                </label>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <br>
                        <button type="submit" class="btn btn-primary btn-block">Actualizar permisos</button>
                    </form>
                    @else
                    <table class="table table-nowrap table-hover mb-0">
                        <thead>
                            <tr>
                                <th scope="col">Permisos</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($user->permissions as $permission)
                                <tr>
                                    <td>
                                        <div class="form-check mb-3">
                                            <label class="form-check-label">
                                                {{$permission->name}}
                                            </label>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                            <tr>
                                <td>
                                    <div class="form-check mb-3">
                                        <label class="form-check-label">
                                            No tiene Permisos
                                        </label>
                                    </div>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                    @endrole
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /.container-fluid -->





@endsection



@push('script')
    <script src="{{ url('js/jquery.rut.js') }}"></script> 

    <script type="text/javascript">
      $(function(){
          $("input#rut").rut({
              formatOn: 'keyup', 
              validateOn: 'keyup'
          }).on('rutInvalido', function(){ 
              $(this).parents("#rut").addClass("is-invalid")
          }).on('rutValido', function(){
              $(this).parents("#rut").removeClass("is-invalid")
              $(this).parents("#rut").addClass("is-valid")
          });
      });
  </script>
@endpush