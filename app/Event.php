<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model {

	//
	protected $fillable = [
		'activity_id',
		'event_name',
		'image_path'	
	];

	public function activities(){
		return $this->belongsTo('App\Activity','activity_id'); 
	}

	public function users(){
		return $this->hasMany('App\User','choice','user_id','event_id')->withTimestamps(); 
	}

}
