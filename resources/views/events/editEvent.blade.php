@extends('app')

@section('content')
	@if(count($event)==1)
		<div class="container padding">
			
			{!!Form::model($event,['url'=>'event/'.$event->id,'method'=>'PATCH','files'=>'true'])!!}
				<div class="form-group">
					{!!Form::label('activity_id','Activity :')!!}
					{!!Form::select('activity_id',$activities,null,['class'=>'form-control'])!!}
				</div>
				<div class="form-group">
					{!!Form::label('event_name','Event Name: ')!!}
					{!!Form::text('event_name',null,['class'=>'form-control', 'placeholder'=>'Event Name'])!!}
				</div>
				
				<div class="form-group">
					{!!Form::submit('Edit Events',['class'=>'btn btn-primary form-control'])!!}
				</div>
			{!!Form::close()!!}
			 @if($errors->any())
		  	<div class="alert alert-danger">
				<strong>Whoops!</strong> There were some problems with your input.<br><br>
				<ul>
		  		@foreach($errors->all() as $error)
		  			<li>{{$error}} </li> 
		  		@endforeach
		  	</ul>
		  </div> 
		  @endif
						
		</div>
	@elseif(count($event)>1)
		<div class="container">
			<p>Too Many Results Shown</p>
		</div>
	@else
		<div class="container">
			<p>No Data To Show</p>
		</div>
	@endif
@stop