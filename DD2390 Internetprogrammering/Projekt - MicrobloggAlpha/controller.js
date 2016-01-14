

var  app = angular.module('createPost',[]); 




	app.controller('simpleController', function ($scope){
	
	
		/*************************initiering nedanför**************************/
		
		$scope.allPostJsonData = {'allPostUnfiltered' : " "};
		$.ajax({
			type 		: 'POST',
			url 		: 'clientConnector.php',
			data 		: $scope.allPostJsonData,
			dataType 	: 'json',
			success 	: function(data) {
				$scope.posts = data;
				$scope.$apply();
			}});
		
		$.ajax({
			type 		: 'POST',
			url 		: 'clientConnector.php',
			data 		: {'checkLoginStatus' : " "},
			dataType 	: 'json',
			success 	: function(data) {
				
				if(data.status == "Yes")
				{
					$scope.profile = {userid: data.userid, 
			            	   myNickname:data.myNickname, 
			            	   myDescription: data.myDescription,
			            	   mySex: data.mySex};
					 $scope.apply();
				}
				
			}});
		
		//Alla poster visas som standard
		$scope.starMarked = false;
		
		
		/*************************initiering ovanför**************************/
	
		//Hämtar prenumerationsvärden
		$scope.uppdateSubscriptions = function(){
			$scope.subscriptionJsonData = {'subscriptiongetUpdate' : $scope.profile.userid };
			$.ajax({
				type 		: 'POST',
				url 		: 'clientConnector.php',
				data 		: $scope.subscriptionJsonData,
				dataType 	: 'json',
				success 	: function(data) {
					$scope.subscriptions = data;
					
					$scope.$apply();
				}});
		};
		
		
		//TODO fixa smart överförningsmetod (kan man spara ett värde direkt istället för alla?)
		$scope.saveSubscription = function(subscription){
			$scope.newSubscriptionJsonData = {'subscriptionSave' : $scope.profile.userid, 'subscribing' : subscription.subscribing,
												'userid' : subscription.userid};
			$.ajax({
				type 		: 'POST',
				url 		: 'clientConnector.php',
				data 		: $scope.newSubscriptionJsonData,
				dataType 	: 'json',
				});
		};
	
	
		//Hämtar upplagda blog poster och ser efter om användaren forfarande är inloggad
		$scope.uppdatePosts = function(){
			$scope.uppdateSubscriptions();
			//MyPosts
			$scope.allPostJsonData = {'allPostUnfiltered' : $scope.profile.userid };
			$.ajax({
				type 		: 'POST',
				url 		: 'clientConnector.php',
				data 		: $scope.allPostJsonData,
				dataType 	: 'json',
				success 	: function(data) {
					$scope.posts = data;
					$scope.$apply();
				}});
			$scope.uppdateSignedOnStatus();
		};
		
		//Uppdaterar eller skapar en profil 
		$scope.uppdateOrSaveProfileSettings = function(){
			
			//Samtliga fält måste vara ifyllda
			if($scope.profile.myNickname != null && $scope.profile.myDescription != null && $scope.profile.mySex != null )
			{
				$scope.updateProfile = {'uppdateProfile' : $scope.profile.userid,
						'myNickname' : $scope.profile.myNickname,
						'myDescription' : $scope.profile.myDescription,
						'mySex' : $scope.profile.mySex};
				$.ajax({
					type 		: 'POST',
					url 		: 'clientConnector.php',
					data 		: $scope.updateProfile,
					dataType 	: 'json'
					});
				alert("Profile saved");
			}
		};
		
		
		//uppdaterar inloggningsinformationen
		$scope.uppdateSignedOnStatus = function(){
			$scope.signInJsonData = {'checkLoginStatus' : "value"};
			$.ajax({
				type 		: 'POST',
				url 		: 'clientConnector.php',
				data 		: $scope.signInJsonData,
				dataType 	: 'json',
				success 	: function(data) {
					if(data.status == "No")
					{
						delete $scope.profile; 
					}
					if(data.status == "Yes")
					{
						$scope.profile = {userid: data.userid, 
				            	   myNickname:data.myNickname, 
				            	   myDescription: data.myDescription,
				            	   mySex: data.mySex};
					}
				}});
		};
		
		//inloggnings-status
		$scope.signedIn = function(){
				
				if($scope.profile == null)
				{
					return false;
				}
				else
				{
					return true;
				}
			
				$scope.apply();
			
		};
		
		
		//Vid anrop så kan användaren logga in.
		$scope.signIn = function(){
			gapi.auth.signIn({
					'clientid' : '119681315949-8u7gq6bohffl56mvr9v6iqq8eq5u4fb2.apps.googleusercontent.com',
					'cookiepolicy' : 'single_host_origin',
					'callback' : $scope.signInCallback
					});
		};
		
		//Vid inloggning genom Google API så anropas den här funktionen
		$scope.signInCallback = function(authResult){
			 
			//Användaren är nu inloggad
			if (authResult['status']['signed_in']) {
				    
				 	//Hämtar profil specifik information om bloggaren
				 	gapi.client.load('plus','v1', function(){
				 											gapi.client.plus.people.get( {'userId' : 'me'} )
				 											.execute(function(profile){
				 												
				 												//Genomför inloggning procedur för appens model (Databasen)
				 												$scope.signInJsonData = {'signIn' : profile['id']};
				 												$.ajax({
				 													type 		: 'POST',
				 													url 		: 'clientConnector.php',
				 													data 		: $scope.signInJsonData,
				 													dataType 	: 'json',
				 													success 	: function(data) {
				 														
				 														$scope.profile = data;
				 														$scope.uppdatePosts();
				 														$scope.$apply();
				 													}});
				 												});
				 	});
					$scope.$apply(); //uppdaterar angular modellen
	
		} else {//Ej inloggad (Används inte av appen just nu)
				    console.log('Sign-in state: ' + authResult['error']);
			}
		};
		
		//Loggar ut klientet från appen, php session variabeln uppdateras också 
		//tömmer satta variabler hos klienten och dropar anslutningen mot google-api
		$scope.signOut = function(){
			gapi.auth.signOut();
			delete $scope.newPostSubject;
			delete $scope.newPostContent;
			delete $scope.profile;
			
			$scope.signOutJsonData = {'signOut' : " "};
			$.ajax({
				type 		: 'POST',
				url 		: 'clientConnector.php',
				data 		: $scope.signOutJsonData,
				dataType 	: 'json'
			});			
		};
		
		
		//Lägger till en bloggpost i databasen och uppdaterar alla upplagda poster
		$scope.addPost = function(){
			alert("Post added");
				
			$scope.addPostJsonData = {'addPost' : $scope.profile.userid
									, 'newPostSubject' : $scope.newPostSubject, 
									'newPostContent' : $scope.newPostContent, 
									'newPostUpploadDate' : new Date().getTime()};
			$.ajax({
				type 		: 'POST',
				url 		: 'clientConnector.php',
				data 		: $scope.addPostJsonData,
				dataType 	: 'json'
			});	
	
			delete $scope.newPostSubject;
			delete $scope.newPostContent;
		};	
		
		
		
		$scope.starValue = function(){
			if($scope.signedIn() == true)
			{
				if($scope.starMarked)
				{
					return 'yes';
				}
			}
			return '';
				};
				
				$scope.showstar = function(){
					
					if($scope.signedIn() == true)
					{
						return $scope.starMarked;
					}
					
					
				};
				$scope.showstarempty = function(){
					
					if($scope.signedIn() == true)
					{
						return !$scope.starMarked;
					}
				};
				
				$scope.starclicked = function(){
						 $scope.starMarked = !$scope.starMarked;
						 $scope.apply();
				};
	
	});