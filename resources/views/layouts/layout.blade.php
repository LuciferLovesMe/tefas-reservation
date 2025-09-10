<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    @include('layouts.head')
    @stack('styles')
    
  <body
      class="m-0 font-sans text-base antialiased font-normal dark:bg-slate-900 leading-default bg-gray-50 text-slate-500"
    >
      <div class="absolute w-full bg-blue-500 dark:hidden min-h-75"></div>

      @include('layouts.sidebar')

      <main
          class="relative h-full max-h-screen transition-all duration-200 ease-in-out xl:ml-68 rounded-xl"
        >
          @include('layouts.navbar')
          @include('components.flash-messages')
          @yield('content')
        <!-- end cards -->
      </main>

      @stack('scripts')
  </body>

</html>