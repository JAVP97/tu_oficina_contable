@extends('layouts.frontend')
@section('title', 'Crear nuevo Usuario')
@section('content')
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0 font-size-18">Nuevo usuario</h4>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="{{url('home')}}"><i class="fas fa-home"></i></a></li>
                    <li class="breadcrumb-item"><a href="{{url('users')}}">Usuarios</a></li>
                    <li class="breadcrumb-item active">Nuevo Usuario</li>
                </ol>
            </div>

        </div>
    </div>
</div>
  <!-- Page content -->
  <form action="{{route('users.store')}}" method="POST" autocomplete="off">
    @csrf
    <div class="row">
      <div class="col-12 col-md-4">
        <div class="card">
            <!-- Light table -->
            <div class="card-body">
                <div class="mb-3">
                    <label for="name">Nombre y Apellido</label>
                    <input type="text" name="name" value="{{old('name')}}" class="form-control @error('name') is-invalid @enderror">
                    @error('name')
                        <span class="error invalid-feedback">{{$message}}</span>
                    @enderror
                </div>
                <div class="row">
                  <div class="col-12 mb-3">
                    <label for="rut">RUT</label>
                    <input type="text" id="rut" name="rut" value="{{old('rut')}}" class="form-control @error('rut') is-invalid @enderror">
                    @error('rut')
                        <span class="error invalid-feedback">{{$message}}</span>
                    @enderror
                  </div>
                  <div class="col-12 mb-3">
                    <label for="email">Correo Electronico</label>
                    <input type="email" name="email" value="{{old('email')}}" class="form-control @error('email') is-invalid @enderror">
                    @error('email')
                        <span class="error invalid-feedback">{{$message}}</span>
                    @enderror
                  </div>
                </div>
                <div class="row">
                  <div class="col-12 mb-3">
                    <label for="password">Contraseña</label>
                    <input type="text" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Contraseña">
                    @error('password')
                        <span class="error invalid-feedback">{{$message}}</span>
                    @enderror
                  </div>
                  <div class="col-12 mb-3">
                    <label for="password_confirmation">Confirmar Contraseña</label>
                    <input type="text" name="password_confirmation" class="form-control @error('password_confirmation') is-invalid @enderror" placeholder="Repite la Contraseña">
                    @error('password_confirmation')
                        <span class="error invalid-feedback">{{$message}}</span>
                    @enderror
                  </div>
                </div>
            </div>
          </div>
      </div>
      <div class="col-12 col-md-8">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title mb-4">Roles de Usuario</h4>
                <div class="table-responsive">
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
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <h4 class="card-title mb-4">Permisos de Usuario</h4>
                <div class="table-responsive">
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
                </div>
            </div>
        </div>
     </div>
     <center>
       <button type="submit" class="btn btn-primary">Crear Usuario</button>
       <button type="reset" class="btn btn-danger">Limpiar</button>
      </center>
      <hr>
    </div>
  </form>
@endsection

@push('style')

@endpush

@push('script')
    <script src="{{url('js/jquery.rut.js')}}"></script>
    <script>
        $(function(){
            $("input#rut").rut({
                formatOn: 'keyup', 
                validateOn: 'keyup'
            }).on('rutInvalido', function(){ 
                $(this).parents("#rut").addClass("is-invalid")
            }).on('rutValido', function(){
                $(this).parents("#rut").removeClass("is-invalid")
                $(this).parents("#rut").addClass("is-valid")
                $.ajax({
                  type: "GET",
                  url: '{{ route("get.validar.rut.user") }}',
                  data: {
                  "_token": "{{ csrf_token() }}",
                  rut: $('#rut').val()
              },
              success : function(data){
                if (data == true) {
                  alert("Va registrar un RUT que ya existe. por favor cambie el rut");
                  $('button[type="submit"]').prop('disabled', true);
                }else{
                    $('button[type="submit"]').prop('disabled', false);
                }
              }
              })
            });
        });
    </script>
@endpush