<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Calls App - @yield('title')</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

        <!-- Styles -->
        <link rel="stylesheet" href="{{asset('css/app.css')}}">
        @stack('styles')
    </head>
    <body>
        @include('partials/_nav')

        @if ($message = Session::get('success'))
            <div class="alert alert-success alert-block my-20">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <strong>{{ $message }}</strong>
            </div>
        @endif


        @if ($message = Session::get('error'))
            <div class="alert alert-danger alert-block my-20">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <strong>{{ $message }}</strong>
            </div>
        @endif

        @if($errors->any())
            <div class="alert alert-danger alert-block my-20">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{$error}}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div id="confirm-modal" class="modal">
            <div class="modal-content">
                <div>
                    <span class="modal-close block">&times;</span>
                </div>
                <div class="mt-1">
                    Are you sure?
                </div>

                <div class="mt-5 controls flex justify-between">
                    <button class="btn blank mx-1.5 confirm">Confirm</button>
                    <button class="btn blank mx-1.5 cancel">Cancel</button>
                </div>
            </div>

        </div>

        @yield('content')

        <script src="{{asset('js/app.js')}}"></script>
        @stack('scripts')
    </body>
</html>
