@extends('app')

@section('content')
<!-- <div class="container padding">
	@if(count($events))
			@foreach($events as $event)
				<a href="{{url('event/'.$event->id)}}"><h3>{{$event->event_name}}</h3></a>	
				<a href="{{url('event/'.$event->id.'/edit')}}">Edit</a> |
				<a href="{{url('event/delete/'.$event->id)}}">Delete</a>
			@endforeach
	@else
		<p>No Events Have Been Created</p>
	@endif
</div> --> 
	<div class="container padding" ng-app="yahyaApp" ng-controller="eventsCtrl">
		<input type="text" placeholder="What event are you looking for? Enter the name of the event." class="form-control" ng-model="searchEvent.event_name">
		<ul style="display:block;list-style-type:none;">
			<li ng-repeat="event in filterEvents=(events|filter:searchEvent)" style="margin-bottom:50px;"><h2>@{{event['event_name']}}</h2>
			<a href="event/@{{event['id']}}/edit">Edit</a> |
			<a href="event/delete/@{{event['id']}}">Delete</a>
			</li>
		</ul>
		<h3 ng-hide="filterEvents.length">No events found!</h3>
		
	</div>
@stop	