@extends('app')

@section('content')
	@if(count($special))
		<div class="container padding">
			
			{!!Form::model($special,['url'=>'special/'.$special->id,'method'=>'PATCH','files'=>'true'])!!}
				
				<div class="form-group">
					{!!Form::label('name','Name: ')!!}
					{!!Form::text('name',null,['class'=>'form-control', 'placeholder'=>'Event Name'])!!}
				</div>
				
				<div class="form-group">
					{!!Form::submit('Edit Special Event',['class'=>'btn btn-primary form-control'])!!}
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