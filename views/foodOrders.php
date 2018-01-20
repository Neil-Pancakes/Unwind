<?php
require ("../header.php");
include '../sidebar.php';
?>
 <!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
  <section class="content" ng-app="unwindApp">
    <div ng-cloak ng-controller="floorController" data-ng-init="init()">
        <md-content>
            <md-list flex ng-repeat = "x in orderList">
                <md-list-item class="md-3-line rrList" ng-click="null">
                    <div>
                        <div>{{x.FoodOrderId}}</div>
                        <div>{{x.Price}}</div>
                        <div>{{x.TimestampOrdered}}</div>
                        <div>{{x.Name}}</div>
                        
                        <md-list flex ng-repeat = "food in foodSet.food track by $index">
                            <md-list-item class="md-3-line rrList" ng-click="null">
                                    <div>
                                        <div>{{food.FoodItemId}}</div>
                                        <div>{{food.Name}}</div>
                                        <div>{{food.Description}}</div>
                                        <div>{{food.Qty}}</div>
                                        <div>{{food.Price}} Php</div>
                                    </div>  
                            </md-list-item>
                        <md-list>            
                    </div>  
                </md-list-item>
            <md-list>            
        </md-content>
    </div>  
  </section>
</div>

<?php
include '../footer.php';
include '../control_sidebar.php';
?>
<!-- End of div wrapper-->
</div>
<!-- End of body-->
</body>


<script>
var active = angular.element( document.querySelector( '#foodTab' ) );
active.addClass('active');
var active2 = angular.element( document.querySelector( '#orderTab' ) );
active2.addClass('active'); 

var app = angular.module('unwindApp', ['ngMaterial', 'oitozero.ngSweetAlert', 'chieffancypants.loadingBar', 'ngAnimate']);
app.config(function(cfpLoadingBarProvider) {
    cfpLoadingBarProvider.includeSpinner = true;
  })
app.controller('floorController', function($scope, $http, $mdDialog, SweetAlert) {

     $scope.init = function () {
        $scope.foodSet = {food: []};
        $scope.food = [];
        
        $http.get("../queries/get/getFoodOrder.php").then(function (response) {
        $scope.orderList = response.data.records;
            for($x=0; $x<$scope.orderList.length; $x++){
                $http.get("../queries/get/getFoodItemPerOrder.php?food_order_id="+$scope.orderList[$x].FoodOrderId).then(function (response){
                    $scope.foodPerOrder = response.data.records;
                    if($scope.foodPerOrder!=""){
                        $scope.foodSet.food = $scope.foodPerOrder;
                    }
                });
            }
        });
    };
});
</script>
