@extends('app')

@section('content')
	@if(count($activity))
		<div class="container padding">
			<h2>Edit Activity</h2>
			    {!!Form::model($activity,['method'=>'PATCH','url'=>'activity/'.$activity->id])!!}
			    	<div class="form-group">
			    		{!!Form::label('activity_name',' Name :')!!}
			    		{!!Form::text('activity_name',null,['class'=>'form-control','placeholder'=>' Eg: Cricket, Basketball, Debate, etc.,'])!!}   			    		
			    	</div>

			    	<div class="form-group">
		    		{!!Form::label('description','Description : ')!!}
		    		{!!Form::textarea('description',null,['class'=>'form-control','placeholder'=>'What\'s the activity about?'])!!}
		    	</div>

			    	<div class="form-group">
			    		{!!Form::submit('Edit Activity',['class'=>'btn btn-primary form-control'])!!}
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

	@else 
		<p>No activity to edit</p>
	@endif	
@stop