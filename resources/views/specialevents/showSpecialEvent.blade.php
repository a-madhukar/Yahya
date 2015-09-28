@extends('app')

@section('content')
	@if(count($special))
		<div class="container padding">
			<h3>{{$special->name}}</h3>	
			<img src="{{$special->image_path}}">	
		</div>
	@else 
		<p>No Data To Show</p>
	@endif	
@stop