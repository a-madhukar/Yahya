@extends('app')

@section('content')
	@if(count($events)==1)
		<div class="container padding">
			@foreach($events as $event)
				<h3>{{$event->event_name}}</h3>
				<p>Activity: {{$event->activity_name}}</p>
				<img src="{{$event->image_path}}">
			@endforeach
		</div>
	@elseif(count($events)>1)
		<p>Returned Too Many Resutls</p>
	@else 
		<p>No Data To Show</p>
	@endif	
@stop