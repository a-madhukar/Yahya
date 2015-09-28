@extends('app')

@section('content')

<!--	<div class="container">
		<div class="row">
			<div class="col-md-3">
				<ul class="nav nav-pills nav-stacked">
				  <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">All</a></li>
				  <li role="presentation"> <a href="#special" aria-controls="special" role="tab" data-toggle="tab"> Special Activities </a> </li>
				  @if(count($activities))
				  	@foreach($activities as $activity)
				  		<li role="presentation"><a href="{{url('#'.studly_case($activity->activity_name))}}" aria-controls="{{studly_case($activity->activity_name)}}" role="tab" data-toggle="tab">{{$activity->activity_name}}</a></li>
				  	@endforeach
				  @endif
				</ul>
			</div>

			<div class="col-md-9">
				<div class="tab-content">
			    <div role="tabpanel" class="tab-pane active" id="home">
			    	@if(count($events))
			    		@foreach($events as $event)
				    		<div id="tab-display">
				    			<div id="tab-heading">
				    				<h4>Event: {{$event->event_name}} </h4>	
			    					<p>Activity: {{$event->activity_name}}</p>
				    			</div>
				    			<div id="tab-content">
				    				<img src="{{$event->image_path}}">
				    			</div>
			    				
				    		</div>		    		
			    		@endforeach
			    	@else
			    		<p>No Events Have Been Created</p>
			    	@endif 
			    </div>
			    <div role="tabpanel" class="tab-pane" id="special">
			    	@if(count($specials))
			    		@foreach($specials as $special)
			    			<p>{{$special->name}}</p>
			    			<img src="{{$special->image_path}}">
			    		@endforeach
			    	@else
			    		<p>No Special Events Have Been Created!</p>
			    	@endif 
			    </div>
			    	@if(count($activities))
			    		@foreach($activities as $activity)
			    			<div role="tabpanel" class="tab-pane" id="{{studly_case($activity->activity_name)}}">
			    				@foreach($events as $event)
			    					@if($event->activity_id == $activity->id)

			    					 <p>{{$event->event_name}}
									</p>
									<p>{{$event->activity_name}}</p>
			    						<img src="{{$event->image_path}}">
			    					@endif
			    				@endforeach
			    			</div>
			    		@endforeach
			    	@endif
			  </div>

			</div>

		</div>		
	</div> -->

	<!--Header section--> 
	<header>
		<div class="jumbotron">
		</div> 	
	</header>

	<section id="section1">
		<div class="container">
			<div class="row padding">
				<div class="col-md-4">
					<h3 class="text-center"> 
						Stay Updated!
					</h3>
					<p >
						Keep up to date with all of uni's latest events, activities and announcements!
					</p>
				</div>
				<div class="col-md-4">
					<h3 class="text-center">
						Subscribe!
					</h3>
					<p >
						You can now subscribe to your favourite activities and be the first to know about events!
					</p>
				</div>
				<div class="col-md-4">
					<h3 class="text-center">
						Stay Managed!
					</h3>
					<p>
						You can choose which events you'd like to attend!
					</p>
				</div>
			</div>
		</div>
	</section>

	<section id="section2">
		<div class="container">
			<div class="row padding">
				<div class="col-md-6">
					<img src="/images/sports.png" class="img-responsive img-circle" alt="sporting-events" style="width:350px;margin-left:auto;margin-right:auto;">
				</div>
				<div class="col-md-6">
					<h3 class="text-center" style="margin-top:20%; margin-left:auto; margin-right:auto;margin-bottom:10px;">Sporting Events!</h3>
					<p class="text-justify">
						All of the university's sporting events will be posted on this portal. You can let us know if you'd like to attend them.
					</p>
				</div>
			</div>
			<hr/>
			<div class="row padding">
				<div class="col-md-6">
					<h3 class="text-center" style="margin-top:20%; margin-left:auto; margin-right:auto;margin-bottom:10px;">
						Cultural Events!
					</h3>
					<p class="text-justify animated zoomOutLeft">
						Every cultural and fun event like the Multicultural night will be posted on this portal! Stay up to date with your favourite events!
					</p>
				</div>
				<div class="col-md-6">
					<img src="/images/cultural.png" class="img-circle img-responsive" style="width:350px;margin-left:auto;margin-right:auto;">
				</div>
			</div>
			<hr/>
			<div class="row">
				<div class="col-md-6">
					<img src="/images/announce.png" class="img-circle img-responsive" style="width:250px; margin-left:auto;margin-right:auto;">
				</div>
				<div class="col-md-6">
					<h3 class="text-center" style="margin-top:20%; margin-left:auto; margin-right:auto;margin-bottom:10px;">
						Important Announcements!
					</h3>
					<p class="text-justify">
						All policy changes and immigration announcements will be posted on this portal. 
					</p>
				</div>
			</div>
			<hr/>
		</div>
	</section>

	<section id="section3">	
		<div class="container">
			<h2 class="padding">Drop Us A Message!</h2>
			<div class="container-fluid padding">
				{!!Form::open(['url'=>'contact'])!!}
					<div class="form-group">
						{!!Form::label('emailUser','Email ')!!}
						{!!Form::input('email','emailUser',null,['class'=>'form-control','placeholder'=>'johndoe@example.com'])!!}
					</div>

					<div class="form-group">
						{!!Form::label('message','Message')!!}
						{!!Form::textarea('message',null,['class'=>'form-control','placeholder'=>'Let Us Know If You Have Any Concerns?'])!!}
					</div>

					<div class="form-group">
						{!!Form::submit('Confirm',['class'=>'btn btn-primary form-control'])!!}
					</div>

					@if(Session::has('receivedMessage'))
						<div class="form-group alert alert-success">
							{{Session::get("receivedMessage")}}
						</div>
					@endif

					@if($errors->any())
						<div class="form-group alert alert-danger">
							<ul>
								@foreach($errors->all() as $error)
								 	<li>{{$error}}</li>
								@endforeach
							</ul>
						</div>
					@endif
					
				{!!Form::close()!!}
			</div>
		</div>
	</section>

	<footer> 
		<div class="container">
			<p class="padding">&copy; Ahmad Yahya <br/>2015 <br/><a href="#top">Back To The Top</a></p>
		</div>
	</footer> 

	<!--Smooth Scroll Script -->
<script src="/js/jquery.min.js"></script>
<script type="text/javascript">
		$(function(){
			$('a[href*=#]:not([href=#])').click(function(){
				if(location.pathname.replace(/^\//,'')==this.pathname.replace(/^\//,'')&&location.hostname==this.hostname){

					var target = $(this.hash);
					target = target.length ? target : $('[name='+this.hash.slice(1)+']');
					if (target.length) {
						$('html,body').animate({
							scrollTop:target.offset().top
						},1000);
						return false;
					}
				}
			});
		});
	</script>
@stop