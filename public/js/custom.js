angular.module("yahyaApp",[])


//all the controllers go here

//controller for activities
.controller("activityCtrl",function($scope,appService){
	console.log("Here in the activityCtrl");
	
	appService.getActivitiesFromServer().then(function(data){
		$scope.activities=data;
	});
})


//controller for events
.controller("eventsCtrl",function($scope,appService){
	console.log("here in the events ctrl"); 
	appService.getEventsFromServer().then(function(data){
		$scope.events=data;
		console.log("made the call "+$scope.events); 
	}); 
})

//controller for events
.controller("specialCtrl",function($scope,appService){
	console.log("here in the special ctrl"); 
	appService.getSpecialEventsFromServer().then(function(data){
		$scope.specials=data;
		console.log("made the call "+$scope.specials); 
	}); 
})


//******************************************


//all the services go here
.service("appService",function($http,$q){
	 
	//this function gets all the activities from server
	this.getActivitiesFromServer = function(){
		return $http.get('/get/activities').then(function(data){
			return data.data;
		},function(error){
			return error;
		}); 
	}

	//this function gets the events from the server
	this.getEventsFromServer=function(){
		return $http.get('/get/events').then(function(data){
			console.log(data.data);
			return data.data;
		},function(error){
			return error;
		}); 
	}

	//this function gets the special events from the server
	this.getSpecialEventsFromServer=function(){
		return $http.get('/get/special').then(function(data){
			console.log(data.data);
			return data.data;
		},function(error){
			return error;
		}); 
	}
})