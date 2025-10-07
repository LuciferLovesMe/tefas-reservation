<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    @include('layouts.head')
    @stack('styles')
    
  <body>
    <div id="id">
      @include('sweetalert::alert')

      @include('layouts.sidebar')

      {{-- <x-flash-messages /> --}}
      
      <div id="main">
        <header class="mb-3">
            <a href="#" class="burger-btn d-block d-xl-none">
                <i class="bi bi-justify fs-3"></i>
            </a>
        </header>
        @yield('content')
      </div>

      <script>
        $(document).ready(function() {
            $('select').select2({
                width: '100%'
            });
        } );
        
        function inpNumber (element) {
            let input = document.getElementById(element)
            input.addEventListener('input', function (e) {
                let value = e.target.value
                e.target.value = value.replace(/[^0-9]/g, '')
            })
        }

        function imgPreview (element, preview) {
            let inputFile = $(`#${element}`).prop('files')
            let file = Array.prototype.slice.call(inputFile)
              
            if (inputFile) {
              $(`.${preview}`).attr('src', URL.createObjectURL(file[0]))
            }
        }

        function deleteRow (data) {
          console.log('test');
          
          Swal.fire({
            title: "Are you sure?",
            text: "You won't be able to revert this!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, delete it!"
          }).then((result) => {
              if (result.isConfirmed) {
                $(`#${data}`).submit()
            }
          });
          
        }
        
        @if (Session::has('message'))
            var type = "{{ Session::get('alert-type', 'info') }}"
            switch (type) {
                case 'info':

                    toastr.options.timeOut = 10000;
                    toastr.info("{{ Session::get('message') }}");
                    break;
                case 'success':

                    toastr.options.timeOut = 10000;
                    toastr.success("{{ Session::get('message') }}");

                    break;
                case 'warning':

                    toastr.options.timeOut = 10000;
                    toastr.warning("{{ Session::get('message') }}");

                    break;
                case 'error':

                    toastr.options.timeOut = 10000;
                    toastr.error("{{ Session::get('message') }}");

                    break;
            }
        @endif
      </script>
      
      @stack('scripts')
      
    </div>

  </body>

</html>