<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    @include('layouts.head')
    @stack('styles')
    
  <body>
    <div id="id">

      @include('layouts.sidebar')

      @include('components.flash-messages')
      
      <div id="main">
        <header class="mb-3">
            <a href="#" class="burger-btn d-block d-xl-none">
                <i class="bi bi-justify fs-3"></i>
            </a>
        </header>
        @yield('content')
      </div>
      
      @stack('scripts')
      
    </div>

  </body>

</html>