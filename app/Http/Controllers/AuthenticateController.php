<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Validator; 
use Auth; 
use Session; 
use App\User; 

class AuthenticateController extends Controller {

	//adds in the new user
	public function register(Request $request){ 
		if (!Auth::check()) {
			# code...
			$rules = [
				'first_name'=>'required',
				'last_name'=>'required',
				'email'=>'required|email|unique:users',
				'password'=>'required|confirmed',
				'password_confirmation'=>'required'
			]; 

			$validator = Validator::make($request->all(),$rules);
			if ($validator->fails()) {
			 	# code...
			 	return redirect()->back()->withErrors($validator); 
			 } 

			$input = $request->all(); 
			//dd($input); 
			$user = User::create(['first_name'=>$input['first_name'],'last_name'=>$input['last_name'],'email'=>$input['email'],'password'=>bcrypt($input['password']),'type'=>'2','active'=>'1']); 
			if ($user) {
			//	Session::flash('signUpSuccess','You\'ve successfully created a new account');
			}
		}
		return redirect('/'); 
	}

	//logs in the user 
	// updates the count row. 
	public function login(Request $request){
		if (!Auth::check()) {
			# code...
			$rules = [
				'email'=>'required|email',
				'password'=>'required'
			];

			$validator = Validator::make($request->all(), $rules); 
			if ($validator->fails()) {
				# code...
				return redirect()->back()->withErrors($validator); 
			}

			$input = $request->all(); 

			if (Auth::attempt(['email'=>$input['email'],'password'=>$input['password'],'type'=>'1','active'=>'1'])) {
				# code...
				Session::flash('loginSuccessful','Welcome Admin. You\'ve successfully logged in!'); 
				return redirect('home'); 
			}elseif(Auth::attempt(['email'=>$input['email'],'password'=>$input['password'],'type'=>'2','active'=>'1'])) {
				# code...
				$username = Auth::user()->first_name; 
				Session::flash('loginSuccessful','Welcome '.$username.' You\'ve successfully logged in!');
				$this->updateCount();
				return redirect('home');

			}elseif(Auth::attempt(['email'=>$input['email'],'password'=>$input['password'],'type'=>'1','active'=>'0'])) {
				# code...
				Session::flash('loginUnsuccessful','Your account has been deactivated'); 
			}elseif(Auth::attempt(['email'=>$input['email'],'password'=>$input['password'],'type'=>'2','active'=>'0'])) {
				# code...
				Session::flash('loginUnsuccessful','Your account has been deactivated'); 
			}else{
				Session::flash('incorrect','Whoops! Looks like you used the wrong email and password. Re-enter them!'); 
			}
		}
		return redirect('/'); 
	}

	public function updateCount(){

		if (Auth::check()) {
			# code...
		 	if (Auth::user()->type == 2) {
		 		# code...	
		 		$user = Auth::user(); 
		 		$count = $user->count +1; 
		 		//dd($count); 
		 		$user->update(['count'=>$count]); 
		 	}

		}

	}


}
