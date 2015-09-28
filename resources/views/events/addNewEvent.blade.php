@extends('app')

@section('content')
	@if(count($activities))
		<div class="container padding"> 
			<h2>Add New Event</h2>
			{!!Form::open(['url'=>'event','files'=>'true'])!!}
				<div class="form-group">
					{!!Form::label('activity_id','Activity :')!!}
					{!!Form::select('activity_id',$activities,null,['class'=>'form-control'])!!}
				</div>
				<div class="form-group">
					{!!Form::label('event_name','Event Name: ')!!}
					{!!Form::text('event_name',null,['class'=>'form-control', 'placeholder'=>'Event Name'])!!}
				</div>
				<div class="form-group">
					<div class="row">
						<div class="col-sm-1">
							{!!Form::label('image_path','Poster :')!!}
						</div>
						<div class="col-sm-11">
							{!!Form::file('image_path')!!}
						</div>
					</div>
				</div>
				<div class="form-group">
					{!!Form::submit('Add New Event',['class'=>'btn btn-primary form-control'])!!}
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
	@endif	
@stop