@extends('layouts.frontend')
@section('title', 'Usuario '. $user->name)
@section('content')
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0 font-size-18">Usuario {{$user->name}}</h4>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="{{url('home')}}"><i class="fas fa-home"></i></a></li>
                    <li class="breadcrumb-item"><a href="{{url('user')}}">Usuario</a></li>
                    <li class="breadcrumb-item active">Perfil de {{$user->name}}</li>
                </ol>
            </div>

        </div>
    </div>
</div>
<div class="row">
    <div class="col-xl-4">
        <div class="card overflow-hidden">
            <div class="bg-primary bg-soft">
                <div class="row">
                    <div class="col-7">
                        <div class="text-primary p-3">
                            <h5 class="text-primary">{{$user->name}}</h5>
                            <p>{{$user->getRoleNames()->implode(', ')}}</p>
                        </div>
                    </div>
                    <div class="col-5 align-self-end">
                        <img src="{{url('assets/images/profile-img.png')}}" alt="" class="img-fluid">
                    </div>
                </div>
            </div>
        </div>
        <!-- end card -->

        <div class="card">
            <div class="card-body">
                <h4 class="card-title mb-4">Informacion Personal</h4>

                <div class="table-responsive">
                    <table class="table table-nowrap mb-0">
                        <tbody>
                            <tr>
                                <th scope="row">Nombre y Apellido:</th>
                                <td>{{$user->name}}</td>
                            </tr>
                            <tr>
                                <th scope="row">RUT:</th>
                                <td>{{$user->rut}}</td>
                            </tr>
                            <tr>
                                <th scope="row">Correo electrónico:</th>
                                <td>{{$user->email}}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- end card -->
    </div>         
    
    <div class="col-xl-8">

        <div class="card">
            <div class="card-body">
                <h4 class="card-title mb-4">Roles de Usuario</h4>
                <div class="table-responsive">
                    <table class="table table-nowrap table-hover mb-0">
                        <thead>
                            <tr>
                                <th scope="col">Rol</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($user->roles as $role)
                                <tr>
                                    <td>{{ $role->name }}</td>

                                </tr>
                                @if ($role->permissions->count())
                                    <tr>
                                        <td><small class="text-muted">{{ $role->permissions->pluck('name')->implode(', ') }}</small></td>
                                    </tr>
                                @endif
                            @empty 
                                <tr>
                                    <td>No hay roles asignados</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <h4 class="card-title mb-4">Permisos adicionales</h4>
                <div class="table-responsive">
                    <table class="table table-nowrap table-hover mb-0">
                        <thead>
                            <tr>
                                <th scope="col">Permisos</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($user->permissions as $permission)
                                <tr>
                                    <td>{{ $permission->name }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td>No hay permisos adicionales asignados</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection