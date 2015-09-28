<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Auth; 
use App\Event; 
use App\Activity; 
use Session; 
use DB; 
use App\Special_Event;
//use User;
use App\User;
use App\Subscribed_Activity; 


class HomeController extends Controller {

	//
	public function index(){
		if (Auth::check()) {
			# code...
			Auth::logout();
		}
		//$events = DB::table('events')
	//	->join('');
		//$events = Event::all(); 
		$events = DB::table('events')
		->join('activities','events.activity_id','=','activities.id')
		->select('events.id as event_id','events.event_name as event_name','events.activity_id','events.image_path as image_path','activities.activity_name')
		->get();
		$specials = Special_Event::all(); 
		$activities = Activity::all(); 

		return view('index.index',compact('activities','events','specials')); 

		return view('index.index'); 
	}

	public function home(){
		if (Auth::check()) {
			# code...
			if (Auth::user()->type==1) {
				# code...
				//dd($this->countSignUps());
				$numberOfSubscribers=$this->countSubscribers(); 
				$numberOfSignUps=$this->countSignUps(); 
				$numberOfLogins=$this->countLogins(); 
				$averageLoginPerUser=$this->averageLoginPerUser(); 
				$numberOfActivities=$this->countActivities(); 
				$numberOfEvents=$this->countEvents(); 
				$numberOfSpecialEvents=$this->countSpecialEvents(); 
				$activityWithMostSubscribers = $this->activityWithMostSubscribers();
				return view('home.adminHome',compact('numberOfSignUps','numberOfLogins','averageLoginPerUser','numberOfActivities','numberOfEvents','numberOfSpecialEvents','numberOfSubscribers','activityWithMostSubscribers')); 
			}
			$count = Auth::user()->count; 
			//dd($count); 
			$user=Auth::user(); 
			$activities=$user->activities; 
			//$events=Event::all();
			$events=DB::table('events')
						->join('activities','events.activity_id','=','activities.id')
						->select('events.id','events.activity_id','activities.activity_name as activity_name','events.event_name','events.image_path')
						->get(); 
			$specials=Special_Event::all();
			return view('home.home',compact('count','activities','events','specials')); 
		}
		return redirect('/'); 
	}

	//counts the number of people that signed up
	public function countSignUps(){
		$users=User::where('type','2')->get();
		return count($users);  
		//return $users;
	}

	//counts the number of times people have logged in
	public function countLogins(){
		$numberOfLogins = DB::table('users')
				->where('users.type','=','2') 
				->sum('count');
				
		return $numberOfLogins; 
	}

	//counts the average number of times a user logs in
	public function averageLoginPerUser(){
		$numberOfLogins = $this->countLogins(); 
		$numberOfSignUps = $this->countSignUps(); 
		return $numberOfLogins/$numberOfSignUps*100; 
	}

	//count number of activities
	public function countActivities(){
		$countActivities = count(Activity::all());
		return $countActivities;  
	}

	//count number of created events
	public function countEvents(){
		$countEvents = count(Event::all());
		return $countEvents; 
	}

	//count number of special events
	public function countSpecialEvents(){
		$countSpecialEvents = count(Special_Event::all());
		return $countSpecialEvents;  
	}

	//count number of subscribers
	public function countSubscribers(){
		$countSubscribers = DB::table('subscribed__activities')->groupBy('user_id')->get();
		return count($countSubscribers);  
	}

	//activities with the most subscribers
	public function activityWithMostSubscribers(){
		$activities = Activity::all(); 
		$_temp = []; 
		foreach ($activities as $activity) {
			$subs = DB::table('subscribed__activities')
			->where('subscribed__activities.activity_id',
				'=',$activity->id)
			->count();

			$_temp = array_add($_temp,$activity->id,$subs); 
		}   
		
		$max = max($_temp); 
		$mostSubs=[]; 
		foreach ($activities as $activity) {
			# code...
			if ($_temp[$activity->id]==$max) {
				# code...
				$mostSubs=array_add($mostSubs,$activity->id,$activity->activity_name); 
			}

		}
		return $mostSubs; 
	} 

	//activity with most no. of events
	public function activityWithMostEvents(){

	}

	//count number of emails sent 
	public function countSentEmails(){

	}



	public function sign_up(){
		if (Auth::check()) {
			# code...
			Auth::logout();
		}

		return view('auth.signup'); 
	}

	public function sign_in(){
		if (Auth::check()) {
			# code...
			Auth::logout();
		}
		return view('auth.signin'); 
	}

	

}
