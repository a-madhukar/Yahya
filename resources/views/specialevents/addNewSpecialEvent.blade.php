@extends('app')

@section('content')
<div class="container padding"> 
			{!!Form::open(['url'=>'special','files'=>'true'])!!}
				<div class="form-group">
					{!!Form::label('name','Name: ')!!}
					{!!Form::text('name',null,['class'=>'form-control', 'placeholder'=>'Special Event Name'])!!}
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
					{!!Form::submit('Add New Special Event',['class'=>'btn btn-primary form-control'])!!}
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
@stop