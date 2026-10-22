
@include('layout.partials.head')
@include('layout.partials.nav')
@include('layout.partials.aside')

        
        <!--end::Sidebar-->
        <!--begin::App Main-->
        <main class="app-main">

        @yield('content')

         </main>
        <!--end::App Main-->
        <!--begin::Footer-->

        @include('layout.partials.footer')

       