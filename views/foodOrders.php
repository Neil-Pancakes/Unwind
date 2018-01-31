<?php
require ("../header.php");
include '../sidebar.php';
?>
 <!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
  <section class="content" ng-app="unwindApp">
    <input ng-model="checkInId" ng-init="checkInId = '<?php if(isset($_GET['checkInId'])){echo $_GET['checkInId'];}else{echo "";}?>'" hidden>
    <div ng-cloak ng-controller="orderController" data-ng-init="init()">
        <md-content>
        <h3>Food Orders <md-button class="md-raised" ng-click="init()">Refresh</md-button></h3>
            <md-list flex style="float:left;">
                <md-list-item ng-repeat = "x in orderList track by $index" class="md-3-line rrList">
                    <div>
                        <div>{{$index+1}}.) Ordered by {{x.Name}}</div>    
                        <div>Total Price: {{x.Price}}</div>
                        <div>{{x.FoodOrderMonth}} {{x.FoodOrderDay}}, {{x.FoodOrderYear}}</div>
                        
                        <button class="btn btn-success" ng-click="getOrder(x.FoodOrderId)" data-target="#viewFood" data-toggle="modal">View Order <span class="fa fa-check-square-o"></span></button>    
                        <button class="btn btn-warning" ng-click="completeOrder(x.FoodOrderId)">Complete Order <span class="fa fa-check-square-o"></span></button>    
                    </div>  
                </md-list-item>
            <md-list>            
        </md-content>
        <div id="viewFood" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <form ng-submit="completeOrder()">
                    <div class="modal-content">
                        <div class="modal-header createRoom">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h2>Food order</h2>
                        </div>
                        <div class="modal-body">
                        <md-list flex ng-repeat = "food in foodPerOrder track by $index">
                        <md-list-item class="md-3-line rrList" ng-click="null">
                                <div>
                                    <!--<div>{{food.FoodItemId}}</div>-->
                                    <div>Name: {{food.Name}}</div>
                                    <div>Description: {{food.Description}}</div>
                                    <div>Quantity: {{food.Qty}}</div>
                                    <div>Item Price: {{food.Price}} Php</div>
                                    <div>Subtotal: {{food.Price*food.Qty}} Php</div>
                                </div>  
                        </md-list-item>
                    <md-list>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn createRoom" onclick="$('#viewFood').modal('hide');">Complete Order <span class="fa fa-check"></span></button>
                            <button type="button" class="btn btn-danger" onclick="$('#viewFood').modal('hide');">Close <span class="fa fa-close"></span></button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
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
app.controller('orderController', function($scope, $http, $mdDialog, SweetAlert) {

     $scope.init = function () {
        if($scope.checkInId==""){
            $http.get("../queries/get/getFoodOrder.php").then(function (response) {
            $scope.orderList = response.data.records;
            });
        }else{
            $http.get("../queries/get/getFoodOrderFromCheckIn.php?check_in_id="+$scope.checkInId).then(function (response) {
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
        }
    };

    $scope.getOrder = function($id){
        $http.get("../queries/get/getFoodItemPerOrder.php?food_order_id="+$id).then(function (response){
            $scope.foodPerOrder = response.data.records;
        });
    }

    $scope.completeOrder = function($id){
        SweetAlert.swal({
            title: "Are you sure?",
            text: "Is the order completed?",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55", confirmButtonText: "It's Completed!",
            cancelButtonText: "Cancel!",
            closeOnConfirm: false,
            closeOnCancel: false }, 
        function(isConfirm){ 
            if (isConfirm) {
                $http.post('../queries/update/updateFoodOrderCompleted.php', {
                    'id': $id,
                }).then(function(data, status){
                    $scope.init();
                    SweetAlert.swal("Success!", "Order was completed", "success");
                })
            } else {
               SweetAlert.swal("Cancelled", "You didn't confirm that the order was completed", "error");
            }
        });
    };
});
</script>
