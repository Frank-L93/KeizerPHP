
<div class="bg-white">
    <h1 class="p-3 cursor-pointer" @click="accordion = accordion == {{$accordionID}} ? 0 : {{$accordionID}}">{{$title}}</h1>
    <div class="overflow-hidden bg-gray-100" :class="{ 'h-0': accordion !== {{$accordionID}} }">
        <p class="p-3">
            {{$slot}}
        </p>
    </div>
</div>
