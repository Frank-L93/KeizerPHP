<div class="md:w-1/2 px-3 mb-6 md:mb-0">
<label class="block uppercase tracking-wide text-grey-darker text-xs font-bold mb-2" for="{{$label}}">
    {{$slot}}
</label>
<input class="appearance-none block w-full bg-grey-lighter text-grey-darker border border-red rounded py-3 px-4 mb-3" id="{{$label}}" type="{{$type}}" placeholder="@if(str_contains($original, 'configs')) - @else {{$original}} @endif" wire:model="{{$original}}">
<p class="text-red text-xs italic"></p>
</div>
