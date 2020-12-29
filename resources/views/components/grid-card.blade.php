<div class="min-w-0 p-2 bg-{{$color}}-300 rounded-lg shadow-xs dark:bg-gray-800">
    @if($title !== "")
        <h4 class="mb-4 font-semibold text-gray-600 dark:text-gray-300">
            {{$title}}
        </h4>
    @endif
    <p class="text-gray-600 dark:text-gray-400">
    {!! $content !!}
    </p>
</div>
