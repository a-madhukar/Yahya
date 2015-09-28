@extends('app')

@section('content')
<!--	@if(count($specials))
		<div class="container padding">
			@foreach($specials as $special)
				<a href="{{url('special/'.$special->id)}}"><h3>{{$special->name}}</h3></a>	
				<a href="{{url('special/'.$special->id.'/edit')}}">Edit</a> |
				<a href="{{url('special/delete/'.$special->id)}}">Delete</a>
			@endforeach
		</div>
	@else
		<p>No Special Events Have Been Created</p>
	@endif --> 

	<div class="container padding" ng-app="yahyaApp" ng-controller="specialCtrl">
			<input type="text" placeholder="What special event are you looking for? Enter the name of the special event." class="form-control" ng-model="searchSpecial.name">
			<ul style="display:block;list-style-type:none;">
				<li ng-repeat="special in specialsFilter =(specials | filter:searchSpecial)" style="margin-bottom:50px;">
					<h2>@{{special['name']}}</h2>	
					<a href="special/@{{special['id']}}/edit">Edit</a> |
					<a href="special/delete/@{{special['id']}}">Delete</a>
				</li>
			</ul>
			<h3 ng-hide="specialsFilter.length">No special events found!</h3>
		</div>
@stop	