<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
//use Request; 
use App\Activity;
use App\Subscribed_Activity; 
use Auth;
use Validator;
use Session;
class SubscriberController extends Controller {

	//
	public function getAllActivities(){
		if (Auth::check()) {
			# code...
			if (Auth::user()->type==2) {
				# code...
				$activities = Activity::all();
				return view('subscription.subscribe',compact('activities')); 
			}
			return redirect('/'); 
		}
		return redirect('/'); 
	}

	public function firstTimeSubscribe(Request $request){

		if (Auth::check()) {
			# code...
			if(Auth::user()->type==2)
			{
				$results = $request->all();
				$userid = Auth::user()->id; 
				//dd($results['subscribe_activity']); 
				//$this->getActivity($results); 
				$duplicates = $this->getDuplicates($results['subscribe_activity'],Auth::user()->id); 
				//dd($duplicates);

				if(count($duplicates))
				{
					
					return redirect()->back()->withErrors($duplicates); 
					
				}

				foreach ($results['subscribe_activity'] as $result) 
				{
						# code...
					$subscribedActivity = Subscribed_Activity::create(['user_id'=>$userid,'activity_id'=>$result]); 					
				}
				return redirect('home'); 

			}
			return redirect('/'); 
		}
		return redirect('/'); 
		
	}

	public function getDuplicates($activityIds,$userId){

		$subscribedActivities = Subscribed_Activity::all(); 
		//dd($userId); 
		$duplicates = []; 
		if (count($subscribedActivities)) {
			# code...
			foreach ($subscribedActivities as $subscribedActivity) {
			# code...
				foreach ($activityIds as $activityId) {
					//dd($subscribedActivity->activity_id);
					# code...
					if ($subscribedActivity->activity_id == $activityId && $subscribedActivity->user_id==$userId) {
						# code...
						$duplicates = array_add($duplicates,$activityId,$activityId); 

						//dd($duplicates); 
					}
				}
			}
			
		}
		return $duplicates;
		
	}


}
