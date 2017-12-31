<?php
require ("../header.php");
include '../sidebar.php';
?>
 <!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
  <section class="content" ng-app="unwindApp">
    <div ng-cloak ng-controller="floorController">
      <md-content>
       
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
var active = angular.element( document.querySelector( '#servicesTab' ) );
active.addClass('active');

var app = angular.module('unwindApp', ['ngMaterial']);

app.controller('floorController', function($scope, $http, $mdDialog) {
    $scope.init = function () {
        $scope.foodSet = {food: []};
        $scope.food = [];
        
        $http.get("../queries/get/getFoodOrder.php").then(function (response) {
        $scope.orderList = response.data.records;
            for($x=0; $x<$scope.orderList.length; $x++){
                $http.get("../queries/get/getFoodItemPerOrder.php?menuId="+$scope.orderList[$x].FoodOrderId).then(function (response){
                    $scope.foodPerOrder = response.data.records;
                    if($scope.foodPerMenu!=""){
                        $scope.foodSet.food = $scope.foodPerOrder;
                    }
                });
            }
        });
    };
});
</script>
