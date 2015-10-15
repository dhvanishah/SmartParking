var app = angular.module('parking', ['ngRoute']);


app.config(['$routeProvider',
            function($routeProvider,$locationProvider) {
				$routeProvider.
				when('/', {
					templateUrl: 'dashboard.html',
					controller: 'dashboardController'
     
				}).when('/customer', {
					templateUrl: 'customer.html',
					controller: 'customerController'
				})
				.when('/vehicle', {
					templateUrl: 'vehicle.html',
				    controller: 'vehicleController'
				}).
				when('/parking', {
					templateUrl: 'parking.html',
					controller: 'parkingController'
     
				}).
				when('/history', {
					templateUrl: 'history.html',
					controller: 'historyController'
     
				}).
                otherwise({
                  redirectTo: '/',
                });
              //$locationProvider.html5Mode(true);
          }

          ]);



app.controller('customerController',function($scope,$http){
	$http.get("/Parking226/model/service.php/customer").success(function(response){
		$scope.customers = response;
	});
	$scope.searchCustomer = function(customer){
		
		$http.get("/Parking226/model/service.php/customer/"+$("#txtCustomerSearch").val()).success(function(response){
			$scope.customers = response;
		});
	}
});

app.controller('vehicleController',function($scope,$http){
	$http.get("/Parking226/model/service.php/vehicle").success(function(response){
		$scope.vehicles = response;
	});
	
	$scope.searchVehicle = function(vehicle){		
		$http.get("/Parking226/model/service.php/vehicle/"+$("#txtVehicleSearch").val()).success(function(response){
			$scope.vehicles = response;
		});
	}
});

app.controller('parkingController',function($scope,$http){	
	$http.get("/Parking226/model/service.php/parking").success(function(response){
		console.log(response);
		$scope.parkings = (response);
	});
	
	$scope.searchParking = function(vehicle){		
		$http.get("/Parking226/model/service.php/parking/"+$("#txtParkingSearch").val()).success(function(response){
			$scope.parkings = response;
		});
	}
	
});

app.controller('historyController',function($scope,$http){
	$http.get("/Parking226/model/service.php/history").success(function(response){
		$scope.histories = response;
	});
});


app.controller('historyController',function($scope,$http){
	$http.get("/Parking226/model/service.php/history").success(function(response){
		$scope.histories = response;
	});
});
 

