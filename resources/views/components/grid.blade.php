<div class="grid gap-3 ml-2 mr-2 mb-4 @if($cols === 'test') grid-cols-2 md:grid-cols-3 @else md:grid-cols-{{$cols}} @endif">
{{$slot}}
</div>
