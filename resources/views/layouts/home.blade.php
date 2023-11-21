@include('layouts.base.header')

    {{-- slider --}}
    @yield('slider')

    {{-- sidebar --}}
    @yield('sidebar')

    {{-- content --}}
    <div class="container">
        @yield('content')
    </div>

@include('layouts.base.footer')
