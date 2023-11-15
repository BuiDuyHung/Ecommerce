@include('layouts.home.header')

    {{-- slider --}}
    @yield('slider')

    {{-- sidebar --}}
    @yield('sidebar')

    {{-- content --}}
    <div class="container">
        @yield('content')
    </div>

@include('layouts.home.footer')
