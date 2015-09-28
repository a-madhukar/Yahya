<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model {

	//
	protected $fillable = [
	'activity_name',
	'description'
	]; 

	public function events(){
		return $this->hasMany('App\Event','activity_id'); 
	}

	public function users(){
		return $this->belongsToMany('App\User','subscribed__activities','activity_id'); 
	}

}
