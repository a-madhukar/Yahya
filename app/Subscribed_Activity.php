<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Subscribed_Activity extends Model {

	//
	protected $fillable=[
		'user_id',
		'activity_id'
	]; 

}
