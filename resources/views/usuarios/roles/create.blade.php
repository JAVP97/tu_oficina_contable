@extends('layouts.frontend')
@section('title', 'Crear nuevo Rol')
@section('content')
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0 font-size-18">Nuevo Rol</h4>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="{{url('home')}}"><i class="fas fa-home"></i></a></li>
                    <li class="breadcrumb-item"><a href="{{url('roles')}}">Rols</a></li>
                    <li class="breadcrumb-item active">Nuevo Rol</li>
                </ol>
            </div>

        </div>
    </div>
</div>
  <!-- Page content -->
  <form action="{{route('roles.store')}}" method="POST" autocomplete="off">
    @csrf
    <div class="row">
      <div class="col-12 col-md-4">
        <div class="card">
            <!-- Light table -->
            <div class="card-body">
                <div class="mb-3">
                    <label for="name">Nombre</label>
                    <input type="text" name="name" value="{{old('name')}}" class="form-control @error('name') is-invalid @enderror">
                    @error('name')
                        <span class="error invalid-feedback">{{$message}}</span>
                    @enderror
                </div>
                <div class="col-12 mb-3">
                <label for="guard_name">Guard</label>
                <input type="text" id="guard_name" name="guard_name" value="{{old('guard_name', 'web')}}" class="form-control @error('guard_name') is-invalid @enderror" readonly>
                @error('guard_name')
                    <span class="error invalid-feedback">{{$message}}</span>
                @enderror
                </div>
            </div>
          </div>
      </div>
      <div class="col-12 col-md-8">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title mb-4">Permisos del rol</h4>
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
                                          <input class="form-check-input" name="permissions[]" type="checkbox" id="{{$name}}" value="{{$name}}" {{ $role->permissions->contains($id) ? 'checked' : '' }}>
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
       <button type="submit" class="btn btn-primary">Crear Rol</button>
       <button type="reset" class="btn btn-danger">Limpiar</button>
      </center>
      <hr>
    </div>
  </form>
@endsection

@push('style')

@endpush

@push('script')

@endpush