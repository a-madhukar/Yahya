<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Auth; 
use Session; 
use Validator; 
use App\Activity; 
use Response; 

class ActivityController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		if (Auth::check()) {
			# code...
			if (Auth::user()->type == 1) {
			# code...
			//$activities = Activity::all(); 

			//return Response::json($activities,200); 

			return view('activity.viewActivities'); 
			}
			return redirect('/');
		}
		
		return redirect('/'); 
	}




	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
		if (Auth::check()) {
			# code...
			if (Auth::user()->type == 1) {
				# code...
				return view('activity.addNew'); 
			}
			return redirect('/');
		}
		return redirect('/'); 
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{
		//
		if (Auth::check()) {
			# code...
			if (Auth::user()->type == 1) {
			# code...
			$rules = [
				'activity_name'=>'required|unique:activities',
				'description'=>'required'

			]; 

			$validator = Validator::make($request->all(),$rules);
			if ($validator->fails()) {
			 	# code...
			 	return redirect()->back()->withErrors($validator);
			 } 

			 $input = $request->all(); 
			// dd($input); 
			 $activity = Activity::create(['activity_name'=>$input['activity_name'],'description'=>$input['description']]);
			 Session::flash('activityCreated',$activity->activity_name.' has been created!' ); 
				 return redirect('home'); 
			}
				return redirect('/');
			}
		return redirect('/'); 	 
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
		if (Auth::check()) {
			# code...
			if (Auth::user()->type==1) {
			# code...
			$activity = Activity::findOrFail($id);

			return view('activity.editActivity',compact('activity'));  
			}
			return redirect('/');
		}
		return redirect('/');		 
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id, Request $request)
	{
		//
		if (Auth::check()) {
			# code...
			if (Auth::user()->type == 1) {
			# code...
			$rules = [
				'activity_name'=>'required', 
				'description'=>'required'
			]; 

			$validator = Validator::make($request->all(),$rules);
			if ($validator->fails()) {
			 	# code...
			 	return redirect()->back()->withErrors($validator);
			 } 

			// $input = $request->all(); 
			 $activity = Activity::findOrFail($id);
			 $activity->update($request->all());
			 Session::flash('activityUpdated',$activity->activity_name.' has been updated!');
			 return redirect('home');     
			}

			return redirect('/');
		}
		return redirect('/');

	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
		if (Auth::check()) {
			# code...
			if (Auth::user()->type == 1) {
			# code...
			//$activity = Activity::findOrFail($id);
			$activity=Activity::destroy($id); 
			Session::flash('deleteActivity','The activity has been deleted!');
			return redirect('activity');  
			}

			return redirect('/');
		}
		return redirect('/');		 
	}

	public function getActivities(){
		$activities=Activity::all(); 
		return Response::json($activities,200); 
	}

}
