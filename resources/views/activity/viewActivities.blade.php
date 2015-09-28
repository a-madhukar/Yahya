@extends('app')



@section('content')

		<div class="container padding" ng-app="yahyaApp" ng-controller="activityCtrl">
			<input type="text" placeholder="What activity are you looking for? Enter the name of the activity." class="form-control" ng-model="createdActivity.activity_name">
			<ul style="display:block;list-style-type:none;">
				<li ng-repeat="activity in activitiesFilter =( activities | filter:createdActivity)" style="margin-bottom:50px;">
					<h2>@{{activity['activity_name']}}</h2>	
					<a href="activity/@{{activity['id']}}/edit">Edit</a> |
					<a href="activity/delete/@{{activity['id']}}">Delete</a>
				</li>
			</ul>
			<h3 ng-hide="activitiesFilter.length">No activities found!</h3>
		</div>
	
@stop