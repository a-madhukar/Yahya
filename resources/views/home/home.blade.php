@extends('app')

@section('content')
<!--	<div class="container padding">
		@if($count==1)
			<div class="panel panel-default" style="width:75%;margin-left:auto;margin-right:auto;margin-top:50px;">
				<div class="panel-heading" > 
					Which activities would you like to subscribe to? (You can choose multiple activities)
				</div> 
				<div class="panel-body">
					{!!Form::open(['url'=>'subscribe/firsttime'])!!}
					<ul>
						<div class="form-group"> 
							@foreach($activities as $activity)
								<li style="display:inline-block; margin-right:50px;margin-bottom:20px;width:200px;">
									<input type="checkbox" name="subscribe_activity[]" value="{{$activity->id}}" style="float:left;">
									
									<p style="float:left;margin-left:10px;">{{$activity->activity_name}}</p> </li>
							@endforeach
						</div> 
						<div class="form-group" >
							<center>{!!Form::submit('Subscribe',['class'=>'btn btn-primary'])!!} 
							</center>
						</div>
					</ul>
					{!!Form::close()!!}
				</div>

			</div> 
		@endif

		@if($errors->any())
			<div class="alert alert-danger">
				<ul>
					@foreach($errors->all() as $error)
						<li>{{$error}}</li>
					@endforeach
				</ul>	
			</div>
		@endif
	</div> -->

	<div class="container padding">
		<!--The Panel and tabs go here--> 
		<div class="row">
			<div class="col-md-3">
				<ul class="nav nav-pills nav-stacked">
					<li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">All</a></li>
				  @if(count($activities))
				  	@foreach($activities as $activity)
				  		<li role="presentation"><a href="{{url('#'.studly_case($activity->activity_name))}}" aria-controls="{{studly_case($activity->activity_name)}}" role="tab" data-toggle="tab" style="text-transform:capitalize;" id="pill-anchor">{{$activity->activity_name}}</a></li>
				  	@endforeach
				  @endif 
				  <li role="presentation"> <a href="#special" aria-controls="special" role="tab" data-toggle="tab"> Special Activities </a> </li>
				  
				</ul>
			</div>

			<div class="col-md-9">
				<div class="tab-content">
			    <div role="tabpanel" class="tab-pane active" id="home">
			    	@if(count($events))
			    		@foreach($events as $event)
							<div class="card">
			    				<div class="card-header">
			    					<h4>{{$event->event_name}} </h4>	
			    					
			    				</div>
			    				<div class="card-image">
			    					<img src="{{$event->image_path}}" style="width:100%;height:100%;">
			    				</div>
			    				<div class="card-footer">
			    					<b>{{$event->activity_name}}</b>
			    				</div>
			    			</div>

				    	
			    		@endforeach
			    	@else
			    		<p style="text-transform:capitalize">No Events Have Been Created</p>
			    	@endif 
			    </div>
			    <div role="tabpanel" class="tab-pane" id="special">
			    	@if(count($specials))
			    		@foreach($specials as $special)
							<div class="card">
								<div class="card-header">
									<h4>{{$special->name}}</h4>
								</div>
								<div class="card-image">
									<img src="{{$special->image_path}}" style="width:100%;height:100%;">
								</div>
								<div class="card-footer">
									
								</div>
							</div>
							
			    		@endforeach
			    	@else
			    		<p style="text-transform:capitalize">No Special Events Have Been Created!</p>
			    	@endif 
			    </div>
			    	@if(count($activities))
			    		@foreach($activities as $activity)
			    			<div role="tabpanel" class="tab-pane" id="{{studly_case($activity->activity_name)}}">
			    			
			    				@foreach($events as $event)
			    					@if($event->activity_id == $activity->id)

									<div class="card">
										<div class="card-header">
											 <h4>{{$event->event_name}}
											</h4>		
										</div>
										<div class="card-image">
											<img src="{{$event->image_path}}" style="width:100%;height:100%;">
										</div>
										<div class="card-footer">
											<b>{{$event->activity_name}}</b>
										</div>
									</div>
			    					@endif
			    				@endforeach
			    			 
			    			</div>
			    		@endforeach
			    	@endif
			  </div>

			</div>

		</div>	
	</div>
@stop