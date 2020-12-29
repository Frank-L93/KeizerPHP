<div class="absolute z-10 bg-white w-10/2 md:max-w-md mx-auto rounded shadow-lg py-4 text-left px-6" x-show="showModal" @@click.away="showModal = false" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0 scale-90" x-transition:enter-end="opacity-100 scale-100" x-transition:leave="ease-in duration-300" x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-90">
<!-- Modal Header -->
{!! $title !!}
 <!-- Modal Content -->                                                     
{!! $content !!}           
<!-- Modal Footer -->
</div>