@extends('layout/' . $layout)

@section('breadcrumb')
    <a href="">App</a>
    <i data-feather="chevron-right" class="breadcrumb__icon"></i>
    <a href="" class="breadcrumb--active">Usuarios</a>
    <i data-feather="chevron-right" class="breadcrumb__icon"></i>
    <a href="" class="breadcrumb--active">Ver: {{ $user->name }}</a>
@endsection

@section('subhead')
    <title>Usuarios - Dialect4u</title>
@endsection

@section('subcontent')
    <div class="intro-y flex flex-col sm:flex-row items-center mt-8">
        <h2 class="text-lg font-medium mr-auto">Detalle del Usuario</h2>
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('users.index') }}"> Volver</a>
        </div>
    </div>

    <div class="grid grid-cols-12 gap-6">
        <div class="col-span-12 lg:col-span-12 xxl:col-span-12">
            <!-- BEGIN: Personal Information -->
            <div class="intro-y box mt-5">
                <div class="p-5">
                    <div class="flex flex-col-reverse xl:flex-row flex-col">
                        <div class="flex-1 mt-6 xl:mt-0">
                            <div class="grid grid-cols-12 gap-x-5">
                                <div class="col-span-12 xl:col-span-6">
                                    <div class="mt-3">
                                        <label for="update-profile-form-7" class="form-label">Nombre</label>
                                        <input id="update-profile-form-7" type="text" class="form-control" placeholder="Nombre del Usuario" value="{{ $user->name }}" disabled>
                                    </div>
                                </div>
                                <div class="col-span-12 xl:col-span-6">
                                    <div class="mt-3">
                                        <label for="update-profile-form-7" class="form-label">Email</label>
                                        <input id="update-profile-form-7" type="email" class="form-control" placeholder="Email" value="{{ $user->email }}" disabled>
                                    </div>
                                </div>
                                <div class="col-span-12 xl:col-span-6">
                                    <div class="mt-3">
                                        <label for="update-profile-form-6" class="form-label ">Cédula</label>
                                        <input id="update-profile-form-6" type="text" class="form-control" placeholder="Cédula" value="{{ $user->id_card }}" disabled>
                                    </div>
                                </div>
                                <div class="col-span-12 xl:col-span-6">
                                    <div class="mt-3">
                                        <label for="update-profile-form-6" class="form-label ">Fecha de Nacimiento</label>
                                        <input id="update-profile-form-6" type="text" class="form-control" placeholder="Fecha de Nacimiento" value="{{ $user->birthday }}" disabled>
                                    </div>
                                </div>
                                <div class="col-span-12 xl:col-span-6">
                                    <div class="mt-3">
                                        <label for="update-profile-form-6" class="form-label ">Número Celular</label>
                                        <input id="update-profile-form-6" type="text" class="form-control" placeholder="Número Celular" value="{{ $user->phone }}" disabled>
                                    </div>
                                </div>
                                <div class="col-span-12 xl:col-span-6">
                                    <div class="mt-3">
                                        <label for="update-profile-form-6" class="form-label ">Pais</label>
                                        <input id="update-profile-form-6" type="text" class="form-control" placeholder="Pais" value="{{ $country->name }}" disabled>
                                    </div>
                                </div>
                                <div class="col-span-12 xl:col-span-6">
                                    <div class="mt-3">
                                        <label for="update-profile-form-6" class="form-label ">Estado</label>
                                        <input id="update-profile-form-6" type="text" class="form-control" placeholder="Pais" value="{{ $state->name }}" disabled>
                                    </div>
                                </div>
                                <div class="col-span-12 xl:col-span-6">
                                    <div class="mt-3">
                                        <label for="update-profile-form-6" class="form-label ">Ciudad</label>
                                        <input id="update-profile-form-6" type="text" class="form-control" placeholder="Pais" value="{{ $city->name }}" disabled>
                                    </div>
                                </div>

                                <div class="col-span-12 xl:col-span-12">
                                    <div class="mt-3">
                                        <label for="update-profile-form-8" class="form-label">Roles Asignados</label>
                                        <div class="form-check mr-2">
                                            @if(!empty($user->getRoleNames()))
                                                @foreach($user->getRoleNames() as $v)
                                                    <div class="form-check mt-2 p-2">
                                                        <i data-feather="user-check" class="w-4 h-4 mr-2"></i> {{ $v }}
                                                    </div>
                                                @endforeach
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="w-52 mx-auto xl:mr-0 xl:ml-6">
                            <div class="border-2 border-dashed shadow-sm border-gray-200 dark:border-dark-5 rounded-md p-5">
                                <div class="h-40 relative image-fit cursor-pointer zoom-in mx-auto">
                                    <img class="rounded-md" alt="Dialect4u" src="{{  $user->photo ? asset('dist/images/' .  $user->photo) : asset('dist/images/preview-1.jpg') }}">
                                </div>
                            </div>
                            <div class="col-span-12 xl:col-span-6">
                                <div class="mt-3">
                                    <label for="update-profile-form-7" class="form-label">Status</label>
                                    <input id="update-profile-form-7" type="text" class="form-control" placeholder="Email" value="{{ $user->active ? 'Activo' : 'Inactivo' }}" disabled>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="flex justify-end mt-4">
                        <a href="" class="text-theme-6 flex items-center">
                            <i href="{{ route('users.destroy', $user->id) }}" data-feather="trash-2" class="w-4 h-4 mr-1"></i> Eliminar Usuario
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
