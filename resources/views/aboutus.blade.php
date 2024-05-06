<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('About Us') }}
        </h2>
    </x-slot>
    <div class="py-12">
    <div class="py-2 px-4 mx-auto max-w-screen-xl text-center lg:py-16 lg:px-6">
      <div class="mx-auto mb-8 max-w-screen-sm lg:mb-16">
          <h2 class="mb-4 text-4xl tracking-tight font-extrabold text-gray-900">Our team</h2>
          <p class="font-light text-gray-500 sm:text-md ">We're a small, agile team dedicated to delivering high-quality solutions efficiently.</p> 
          <p class="font-light text-gray-500 sm:text-md ">With expertise in Cloud Computing, we tackle projects with creativity and precision to meet our clients' needs and exceed expectations.</p>
      </div> 
      <div class="grid gap-2 lg:gap-2 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-3">
          <div class="text-center text-gray-500 dark:text-gray-400 mb-6">
              <img class="mx-auto mb-4 w-52 h-52 rounded-full" src="/images/avatar.jpg" alt="Bonnie Avatar">
              <h3 class="mb-1 text-2xl font-bold tracking-tight text-gray-900  ">
              Federex 
              </h3>
              
          </div>
          <div class="text-center text-gray-500 dark:text-gray-400 mb-6">
              <img class="mx-auto mb-4 w-52 h-52 rounded-full" src="/images/avatar.jpg" alt="Bonnie Avatar">
              <h3 class="mb-1 text-2xl font-bold tracking-tight text-gray-900  ">
              Felino 
              </h3>
             
          </div>
          <div class="text-center text-gray-500 dark:text-gray-400 mb-6">
              <img class="mx-auto mb-4 w-52 h-52 rounded-full" src="/images/avatar.jpg" alt="Bonnie Avatar">
              <h3 class="mb-1 text-2xl font-bold tracking-tight text-gray-900  ">
              Jonathan 
              </h3>
              
          </div>
          <div class="text-center text-gray-500 dark:text-gray-400 mb-6">
              <img class="mx-auto mb-4 w-52 h-52 rounded-full" src="/images/avatar.jpg" alt="Bonnie Avatar">
              <h3 class="mb-1 text-2xl font-bold tracking-tight text-gray-900  ">
              Khalid 
              </h3>
           
          </div>
          <div class="text-center text-gray-500 dark:text-gray-400 mb-6">
              <img class="mx-auto mb-4 w-52 h-52 rounded-full" src="/images/avatar.jpg" alt="Bonnie Avatar">
              <h3 class="mb-1 text-2xl font-bold tracking-tight text-gray-900  ">
              Rochelle Anne 
              </h3>
           
          </div>
          <div class="text-center text-gray-500 dark:text-gray-400 mb-6">
              <img class="mx-auto mb-4 w-52 h-52 rounded-full" src="/images/rudmar.jpg" alt="Bonnie Avatar">
              <h3 class="mb-1 text-2xl font-bold tracking-tight text-gray-900  ">
              Rudmar 
              </h3>
              
          </div>
      </div>  
  </div>
    </div>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Function to reload CSS
            function reloadCSS() {
                var links = document.querySelectorAll('link[rel="stylesheet"]');
                links.forEach(function(link) {
                    var href = link.href.split('?')[0];
                    link.href = href + '?rand=' + Math.random();
                });
            }

            // Call reloadCSS function
            reloadCSS();
        });
        </script>
</x-app-layout>
