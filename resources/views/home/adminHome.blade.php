@extends('app')

<style>
	.panel-style{
		min-height: 100px;
	}
</style> 

@section('content')
<div class="container" style="margin-top:10px;">
		<!--displays the number of signups -->
	<h2>Statistics</h2>
	<hr/>
	<div class="row">
		<div class="col-md-6">
			<div class="panel panel-default">
				<div class="panel-heading">
					<b>Usage</b>
				</div>
				<div class="panel-body panel-style">
					@if($numberOfSignUps)
						<p>Number Of Sign Ups: {{$numberOfSignUps}}</p>
					@else
						<p>No Sign Ups Yet</p>
					@endif

				<!--displays the number of total logins -->
					@if($numberOfLogins)
						<p>Number Of Logins: {{$numberOfLogins}}</p>
					@else
						<p>No one has logged in yet</p>
					@endif

				<!--displays the average times a user logs in -->
					@if($averageLoginPerUser)
						<p>A user is likely to login {{$averageLoginPerUser}} % of the time</p>
					@else
						<p>Can't calculate the average because no one has logged in yet</p>
					@endif
				</div>
			</div>
		</div>
		<div class="col-md-6">
			<div class="panel panel-default">
				<div class="panel-heading">
					<b>Activities, Events, etc...</b>
				</div>
				<div class="panel-body panel-style">
					<!--displays the number of activities -->
					@if($numberOfActivities)
						<p>Number of activities created: {{$numberOfActivities}}</p>
					@else
						<p>No activities have been created yet</p>
					@endif

				<!--displays the number of events -->
					@if($numberOfEvents)
						<p> No of events created: {{$numberOfEvents}}</p>
					@else
						<p>No events have been created yet</p>
					@endif

				<!--displays the number of special events -->
					@if($numberOfSpecialEvents)
						<p>No of special events created: {{$numberOfSpecialEvents}}  </p> 
					@else
						<p>No special events have been created yet</p>
					@endif

				</div>
			</div>
		</div>
		
	</div>

	<div class="row">
		<div class="col-md-6 col-md-offset-3" >
			<div class="panel panel-default" style="margin-top:30px;">
				<div class="panel-heading">
					<b>Subscriptions</b>
				</div>
				<div class="panel-body panel-style">
					<!--displays the number of subscribers -->
					@if($numberOfSubscribers)
						<p>No of users that subscribed to different activities: {{$numberOfSubscribers}}  </p> 
					@else
						<p>No users have subscribed yet.</p>
					@endif

					
				<!--displays the activities with most subscribers-->
					@if(count($activityWithMostSubscribers))
					<p>The activities with the most subscribers are: </p>	
						<ul>
							@foreach($activityWithMostSubscribers as $activity)
								<li>{{$activity}}</li>
							@endforeach
						</ul>
					@else
					<p>No one has subscribed to any activities yet</p>
					@endif 
				</div>
			</div>
		</div>
	</div>
 <hr/>
</div>
@stop