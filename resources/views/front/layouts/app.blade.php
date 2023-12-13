@include('front.layouts.header')

<body>
    <div class="page-wrapper">
        @include('front.layouts.nav')
        @yield('content')
    </div>


    @include('front.layouts.footer')
    @include('front.layouts.js')
