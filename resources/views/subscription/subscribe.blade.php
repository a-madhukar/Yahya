@extends('app')

@section('content')
	<div class="container padding">
		<div class="panel panel-default" style="width:75%;margin-left:auto;margin-right:auto;margin-top:50px;">
				<div class="panel-heading" > 
					Which activities would you like to subscribe to? (You can choose multiple activities)
				</div> 
				<div class="panel-body">
					{!!Form::open(['url'=>'subscribe'])!!}
					<ul>
						<div class="form-group"> 
							@foreach($activities as $activity)
								<li style="display:inline-block; margin-right:50px;margin-bottom:20px;width:200px;">
									<input type="checkbox" name="subscribe_activity[]" value="{{$activity->id}}" style="float:left;">
									
									<p style="float:left;margin-left:10px;">{{$activity->activity_name}}</p> </li>
							@endforeach
						</div> 
					</ul>
						<div class="form-group" >
							<center>{!!Form::submit('Subscribe',['class'=>'btn btn-primary'])!!} 
							</center>
						</div>
					@if($errors->any())
						<div class="form-group alert alert-danger">
							<ul>
								@foreach($activities as $activity)
									@foreach($errors->all() as $error)
										@if($activity->id == $error)
											<li>You are already subscribed to {{$activity->activity_name}}. You can subscribe to the other activities.</li>
										@endif
									@endforeach
								@endforeach	
							</ul>
						</div>
					@endif
					{!!Form::close()!!}
				</div>

			</div>
	</div>
@stop