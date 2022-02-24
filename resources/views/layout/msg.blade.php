@if ($message = Session::get('success'))
    <div class="preview">
        <div class="text-center">
            <div id="flash_msg" class="toastify-content hidden flex">
                <i class="text-theme-9" data-feather="check-circle"></i>
                <div class="ml-4 mr-4">
                    <div class="font-medium">Excelente!</div>
                    <div class="text-gray-600 mt-1">{{ $message }}</div>
                </div>
            </div>
        </div>
    </div>
@endif

@if ($message = Session::get('error'))
    <div class="preview">
        <div class="text-center">
            <div id="flash_msg" class="toastify-content hidden flex">
                <i class="text-theme-6" data-feather="alert-triangle"></i>
                <div class="ml-4 mr-4">
                    <div class="font-medium">Alerta!</div>
                    <div class="text-gray-600 mt-1">{{ $error }}</div>
                </div>
            </div>
        </div>
    </div>
@endif

@if ($message = Session::get('warning'))
    <div class="preview">
        <div class="text-center">
            <div id="flash_msg" class="toastify-content hidden flex">
                <i class="text-theme-9" data-feather="check-circle"></i>
                <div class="ml-4 mr-4">
                    <div class="font-medium">Excelente1!</div>
                    <div class="text-gray-600 mt-1">{{ $message }}</div>
                </div>
            </div>
        </div>
    </div>
@endif

@if ($message = Session::get('info'))
    <div class="preview">
        <div class="text-center">
            <div id="flash_msg" class="toastify-content hidden flex">
                <i class="text-theme-9" data-feather="check-circle"></i>
                <div class="ml-4 mr-4">
                    <div class="font-medium">Excelente2!</div>
                    <div class="text-gray-600 mt-1">{{ $message }}</div>
                </div>
            </div>
        </div>
    </div>
@endif

@if ($errors->any())
    <ul>
        @foreach ($errors->all() as $error)
            <li>
                <div id="flash_msg" class="toastify-content hidden flex">
                    <i class="text-theme-6" data-feather="alert-triangle"></i>
                    <div class="ml-4 mr-4">
                        <div class="font-medium">Alerta!</div>
                        <div class="text-gray-600 mt-1">{{ trans($error) }}</div>
                    </div>
                </div>
            </li>
        @endforeach
    </ul>
@endif
