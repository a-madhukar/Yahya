<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Auth; 
use Session; 
use DB; 
use Validator;
use App\Activity; 
use App\Event; 
use App\Special_Event; 
use File; 
use Response;

class SpecialEventsController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		//
		if (Auth::check()) {
			# code...
			if (Auth::user()->type==1) {
				# code...
				$specials = Special_Event::all(); 

				return view('specialevents.viewSpecialEvents',compact('specials')); 
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
			if (Auth::user()->type==1) {
				# code...
				return view('specialevents.addNewSpecialEvent'); 
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
			if (Auth::user()->type==1) {
				# code...
				$rules = [
					'name'=>'required|unique:special__events',
					'image_path'=>'required|image'
				]; 

				$validator = Validator::make($request->all(),$rules);
				if ($validator->fails()) {
					# code...
					return redirect()->back()->withErrors($validator);
				}

				if ($request->hasFile('image_path')) {
					# code...
					$input = $request->all();
					$image = $input['image_path'];
					$name = ''.$input['name'].'.png';
					$image = $image->move(public_path().'/images/specials/',$name);
					$url = '/images/specials/'.$name; 
					$specialEvent=  Special_Event::create(['name'=>$input['name'], 'image_path'=>$url]); 
					Session::flash('specialEventCreated','A New Special Event Has Been Created!');
					return redirect('home');  
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
				$special = Special_Event::findOrFail($id);
				return view('specialevents.showSpecialEvent',compact('special'));  
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
				$special = Special_Event::findOrFail($id);
				return view('specialevents.editSpecialEvent',compact('special'));  
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
			if (Auth::user()->type==1) {
				# code...
				$rules = [
					'name'=>'required',
					//'event_name'=>'required'
				]; 

				$validator = Validator::make($request->all(),$rules);
				if ($validator->fails()) {
					# code...
					return redirect()->back()->withErrors($validator);
				}

				$special=Special_Event::findOrFail($id);
				$special->update($request->all());
				Session::flash('editedSpecialEvent','The Special Event Has Been Updated');  
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
				$specials = Special_Event::findOrFail($id);
				File::delete($specials->image_path);
				Special_Event::destroy($id);
				Session::flash('deletedSpecialEvent','The Special Event Has Been Deleted!');  
				return redirect('home');   
			}
			return redirect('/'); 
		}
		return redirect('/');
	}

	//returns a response
	public function getSpecials(){
		$specials=Special_Event::all(); 
		return Response::json($specials,200);
	}

}
