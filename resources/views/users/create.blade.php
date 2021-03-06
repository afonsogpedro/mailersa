@extends('layout/' . $layout)

@section('breadcrumb')
    <a href="">App</a>
    <i data-feather="chevron-right" class="breadcrumb__icon"></i>
    <a href="" class="breadcrumb--active">Usuarios</a>
    <i data-feather="chevron-right" class="breadcrumb__icon"></i>
    <a href="" class="breadcrumb--active">Nuevo</a>
@endsection

@section('subhead')
    <title>Usuarios - Mailer S.A.</title>
@endsection

@section('subcontent')
    <div class="intro-y flex flex-col sm:flex-row items-center mt-8">
        <h2 class="text-lg font-medium mr-auto">Crear Nuevo Usuario</h2>
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('users.index') }}"> Volver</a>
        </div>
    </div>
    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="grid grid-cols-12 gap-6">
        <div class="col-span-12 lg:col-span-12 xxl:col-span-12">
            <!-- BEGIN: Personal Information -->
            <div class="intro-y box mt-5">
                <div class="p-5">
                    {!! Form::open(array('route' => 'users.store', 'method'=>'POST')) !!}
                        <div class="flex flex-col-reverse xl:flex-row flex-col">
                            <div class="flex-1 mt-6 xl:mt-0">
                                <div class="grid grid-cols-12 gap-x-5">
                                    <div class="col-span-12 xl:col-span-6">
                                        <div class="mt-3">
                                            <label for="update-profile-form-7" class="form-label">Nombre</label>
                                            {!! Form::text('name', null, array('placeholder' => 'Nombre del Usuario', 'class' => 'form-control')) !!}
                                        </div>
                                    </div>
                                    <div class="col-span-12 xl:col-span-6">
                                        <div class="mt-3">
                                            <label for="update-profile-form-7" class="form-label">Email</label>
                                            {!! Form::text('email', null, array('placeholder' => 'Email','class' => 'form-control')) !!}
                                        </div>
                                    </div>
                                    <div class="col-span-12 xl:col-span-6">
                                        <div class="mt-3">
                                            <label for="update-profile-form-6" class="form-label ">C??dula</label>
                                            {!! Form::text('id_card', null, array('placeholder' => 'C??dula', 'class' => 'form-control', 'maxlength' => '11')) !!}
                                        </div>
                                    </div>
                                    <div class="col-span-12 xl:col-span-6">
                                        <div class="mt-3">
                                            <label for="update-profile-form-7" class="form-label">Fecha de Nacimiento</label>
                                            <div class="relative mx-auto">
                                                <div class="absolute rounded-l w-10 h-full flex items-center justify-center bg-gray-100 border text-gray-600 dark:bg-dark-1 dark:border-dark-4">
                                                    <i data-feather="calendar" class="w-4 h-4"></i>
                                                </div>
                                                <input type="text" id="birthday" name="birthday" class="datepicker form-control pl-12" data-single-mode="true">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-span-12 xl:col-span-6">
                                        <div class="mt-3">
                                            <label for="update-profile-form-6" class="form-label ">Contrase??a</label>
                                            {!! Form::password('password', array('placeholder' => 'Contrase??a','class' => 'form-control')) !!}
                                        </div>
                                    </div>
                                    <div class="col-span-12 xl:col-span-6">
                                        <div class="mt-3">
                                            <label for="update-profile-form-6" class="form-label ">Confirmar Contrase??a</label>
                                            {!! Form::password('confirm-password', array('placeholder' => 'Confirmar Contrase??a','class' => 'form-control')) !!}
                                        </div>
                                    </div>
                                    <div class="col-span-12 xl:col-span-6">
                                        <div class="mt-3">
                                            <label for="update-profile-form-6" class="form-label ">N??mero Celular</label>
                                            {!! Form::text('phone', null, array('placeholder' => 'N??mero Celular', 'class' => 'form-control', 'maxlength' => '10')) !!}
                                        </div>
                                    </div>
                                    <div class="col-span-12 xl:col-span-6">
                                        <div class="mt-3">
                                            <label for="country-dropdown" class="form-label">Country</label>
                                            <select class="form-select w-full" style="background-color: white" id="country-dropdown" data-search="true">
                                                <option value="">Selecciona el Pais</option>
                                                @foreach ($countries as $country)
                                                    <option value="{{$country->id}}">
                                                        {{$country->name}}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-span-12 xl:col-span-6">
                                        <div class="mt-3">
                                            <label for="state-dropdown" class="form-label">Estado</label>
                                            <select class="form-select w-full" style="background-color: white" id="state-dropdown" data-search="true">
                                                <option value="">Selecciona el Estado</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-span-12 xl:col-span-6">
                                        <div class="mt-3">
                                            <label for="citycod" class="form-label">Ciudad</label>
                                            {!! Form::select('citycod', [], [],
                                                array('class' => 'form-select w-full', 'data-search' => 'true',
                                                'data-placeholder' => 'Selecciona la Ciudad', 'style' => 'background-color: white', 'id' => 'citycod' )) !!}
                                        </div>
                                    </div>
                                    <div class="col-span-12 xl:col-span-12">
                                        <div class="mt-3">
                                            <label for="update-profile-form-6" class="form-label ">Roles Asignados</label>
                                            {!! Form::select('roles[]', $roles, [],
                                                array('class' => 'tail-select w-full', 'multiple', 'data-search' => 'true',
                                                'data-placeholder' => 'Seleccione Rol(es) para el Usuario')) !!}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="w-52 mx-auto xl:mr-0 xl:ml-6">
                                <div class="border-2 border-dashed shadow-sm border-gray-200 dark:border-dark-5 rounded-md p-5">
                                    <div class="h-40 relative image-fit cursor-pointer zoom-in mx-auto" id="avatar-container">
                                        <img class="rounded-md" alt="Dialect4u" id="imgInp" src="{{  asset('dist/images/preview-1.jpg') }}">
                                        <div title="Desea eliminar esta imagen?" class="tooltip w-5 h-5 flex items-center justify-center absolute rounded-full text-white bg-theme-6 right-0 top-0 -mr-2 -mt-2">
                                            <i data-feather="x" class="w-4 h-4"></i>
                                        </div>
                                    </div>
                                    <div class="mx-auto cursor-pointer relative mt-5">
                                        <button type="button" class="btn btn-primary w-full">Actualizar Avatar</button>
                                        <input type="file" name="photo" id="photo" class="w-full h-full top-0 left-0 absolute opacity-0">
                                    </div>
                                </div>

                                    <div class="mt-3">
                                        <label for="update-profile-form-7" class="form-label">Status</label>
                                        {!! Form::select('active', $status, [], array('class' => 'tail-select w-full', 'data-placeholder' => 'Selecciona el Status')) !!}
                                    </div>

                            </div>
                        </div>
                        <div class="flex justify-end mt-4">
                            <button type="submit" class="btn btn-primary w-20 mr-auto">Guardar</button>
                        </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        //Delete Avatar
        $(function() {
            $('#delete-avatar').on('click', function(evt) {
                evt.preventDefault();
                let $avatar = $('#avatar-container').find('img');
                let $trashIcon = $(this);
                let defaultAvatar = window.location.origin + '/dist/images/profile-1.jpg';
                let id = $(this).data('uid');

                if (confirm('Desea eliminar la imagen?')) {
                    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
                    $.post(window.location.origin + '/dist/images/' + id, {
                            id: id,
                            _token: CSRF_TOKEN,
                        },
                        function() {
                            $avatar.attr('src', defaultAvatar);
                            $trashIcon.remove();
                        })
                }
            });
        });

        photo.onchange = evt => {
            const [file] = photo.files
            if (file) {
                imgInp.src = URL.createObjectURL(file)
            }
        }

        $(document).ready(function () {
            $('#citycod').html('<option value="">Selecciona la Ciudad</option>');
            $('#country-dropdown').on('change', function () {
                let idCountry = this.value;
                $("#state-dropdown").html('');
                $.ajax({
                    url: "{{url('api/fetch-states')}}",
                    type: "POST",
                    data: {
                        country_id: idCountry,
                        _token: '{{csrf_token()}}'
                    },
                    dataType: 'json',
                    success: function (result) {
                        let select = document.getElementById('state-dropdown');
                        let opt = document.createElement('option');
                        opt.value = '';
                        opt.innerHTML = 'Selecciona el Estado';
                        select.appendChild(opt);
                        for (let i = 0; i < result.length; i++){
                            let select = document.getElementById('state-dropdown');
                            let opt = document.createElement('option');
                            opt.value = result[i].id;
                            opt.innerHTML = result[i].name;
                            select.appendChild(opt);
                        }
                    }
                });
            });

            $('#state-dropdown').on('change', function () {
                let idState = this.value;
                $("#citycod").html('');
                $.ajax({
                    url: "{{url('api/fetch-cities')}}",
                    type: "POST",
                    data: {
                        state_id: idState,
                        _token: '{{csrf_token()}}'
                    },
                    dataType: 'json',
                    success: function (res) {
                        let select = document.getElementById('citycod');
                        let opt = document.createElement('option');
                        opt.value = '';
                        opt.innerHTML = "Selecciona la Ciudad";
                        select.appendChild(opt);
                        $('#citycod').html('<option value="">Selecciona la Ciudad</option>');
                        for (let i = 0; i < res.length; i++){
                            select = document.getElementById('citycod');
                            opt = document.createElement('option');
                            opt.value = res[i].id;
                            opt.innerHTML = res[i].name;
                            select.appendChild(opt);
                        }
                    }
                });
            });
        });
    </script>
@endsection
