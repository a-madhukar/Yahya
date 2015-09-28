<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Validator; 
use App\Contact;
use Session;
use Mail;
class ContactController extends Controller {

	//

	public function getMessage(Request $request){
		
		$rules = [
		'emailUser'=>'required',
		'message'=>'required'
		]; 

		$validator=Validator::make($request->all(),$rules);

		if ($validator->fails()) {
		 	# code...
		 	return redirect()->back()->withErrors($validator); 
		 } 

		 $input = $request->all(); 

		 $contact = Contact::create($input);
		 if ($contact) {
		 	# code...

		 	$this->sendEmail($contact->emailUser); 
		 	Session::flash("receivedMessage","We've received your feedback. Thanks!"); 
		 }else{
		 	return "error creating the contact variable"; 
		 }
		 
		 return redirect('/');  

	}

	public function sendEmail($email){

		Mail::send('emails.contact',[],function($message) use ($email){

			$message->to($email)->subject("Thanks for the feedback"); 
		});
	}

}
