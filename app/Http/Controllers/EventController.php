<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Auth; 
use Session; 
use App\Activity; 
use App\Event;
use Validator;
use DB;
use File; 
use Mail;
use Response;

class EventController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		if (Auth::check()) {
			# code...
		
			if (Auth::user()->type==1) {
				# code...
				$events=Event::all();
				return view('events.viewEvents',compact('events')); 
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
	 	if (Auth::check()) {
	 		# code...
	 		if (Auth::user()->type==1) {
			# code...
			$activities = Activity::lists('activity_name','id');
			return view('events.addNewEvent',compact('activities'));  

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
		if (Auth::check()) {
			# code...
			if (Auth::user()->type==1) {
				# code...
				$rules = [
					'activity_id'=>'required|integer',
					'event_name'=>'required|unique:events',
					'image_path'=>'required|image'
				]; 

				$validator = Validator::make($request->all(),$rules);

				if ($validator->fails()) {
				 	# code...
				 	return redirect()->back()->withErrors($validator); 
				 } 

				 if($request->hasFile('image_path')){
				 	$input = $request->all(); 
				 	$image = $input['image_path'];
				 	$name = ''.$input['event_name'].'.png';
				 	//dd($name); 
				 	$image = $image->move(public_path().'/images/events/',studly_case($name)); 
				 	$url = '/images/events/'.studly_case($name);
				 	$event = Event::create(['activity_id'=>$input['activity_id'],'event_name'=>$input['event_name'],'image_path'=>$url]);
				 	if ($event) {
				 		# code...
				 		$subscribedUsers = $this->getUsers($event->activity_id); 
				 		
				 		$this->sendEmail($subscribedUsers, $event->event_name); 
				 		Session::flash('eventCreated',$event->event_name.' has been created!');

				 	}else{
				 		return "error creating the event."; 
				 	}
				 	
				 	return redirect('home');  	
				 }
				 return redirect('/');
			}
		}
		return redirect('/'); 
	}

	//get all Users that subscribed to the //activities
	public function getUsers($activity_id){
		if (Auth::check()) {
			# code...
			if (Auth::user()->type==1) {
				# code...
				$activity=Activity::findOrFail($activity_id);
				$users = $activity->users; 
				return $users; 
			}
			return redirect('/'); 
		}
		return redirect('/'); 
	}

	/*
	 * send email to all of them 
	*/
	public function sendEmail($users,$eventname){
		if (Auth::check()) {
			# code...
			if (Auth::user()->type==2) {
				# code...
				//dd("Does this work? ");
				foreach ($users as $user) {
					$email = $user->email; 
					Mail::send("emails.newEvent",['eventname'=>$eventname],function($message) use ($email) {
						$message->send($email)->subject('New Event Created'); 
					});
 
				}
				
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
		if (Auth::check()) {
			# code...
		
			if (Auth::user()->type==1) {
				# code...
				$events = DB::table('events')
				->join('activities','events.activity_id','=','activities.id')
				->where('events.id','=',$id)
				->select('events.id as event_id','events.event_name as event_name','events.image_path as image_path','activities.activity_name as activity_name')
				->get(); 
				//dd($event::first());
				return view('events.showEvent',compact('events')); 
			}
			return redirect('/');
		}
		return redirect('/'); 
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
			$event = Event::findOrFail($id);
			$activities=Activity::lists('activity_name','id');  
			return view('events.editEvent',compact('event','activities')); 
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
					'activity_id'=>'required|integer',
					'event_name'=>'required'
				]; 

				$validator = Validator::make($request->all(),$rules);
				if ($validator->fails()) {
					# code...
					return redirect()->back()->withErrors($validator);
				}

				$event = Event::findOrFail($id);
				$event->update($request->all());
				Session::flash('editedEvent','The Event Has Been edited!');
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
			if (Auth::user()->type==1) {
				# code...
				//$event=Event::findOrFail($id);
				$events = Event::findOrFail($id);
				$image_path = $events->image_path; 
				\File::delete($image_path); 
				$event=Event::destroy($id);
				Session::flash('eventDeleted','The event has been deleted');
				return redirect('event');  
			}
			return redirect('/');
		}
		return redirect('/'); 
	}

	//returns a response
	public function getEvents(){
		$events=Event::all(); 
		return Response::json($events,200);
	}
}
