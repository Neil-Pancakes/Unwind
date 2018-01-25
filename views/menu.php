<?php
require ("../header.php");
include '../sidebar.php';
?>
 <!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
  <section class="content" ng-app="unwindApp">
    <div ng-cloak ng-controller="menuController" data-ng-init="init()">
        
        
      <md-content>
      
                
      <div>
        <md-button class="md-raised" style="color:white; background-color:green" data-target="#insertFood" data-toggle="modal">Add Food to Menu</md-button>
    </div>
    <div>
        <!--<md-button class="md-raised md-warn" data-target="#removeFood" data-toggle="modal">Remove Food from Menu</md-button>-->
    </div>
        <div id="insertFood" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <form ng-submit="insertFood()">
                    <div class="modal-content">
                        <div class="modal-header" style="background-color:#003300; color:white;">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h2>Create Food</h2>
                        </div>
                        <div class="modal-body">
                            <input class="form-control" placeholder="Food Name" ng-model="foodName" required>
                            <textarea class="form-control" placeholder="Description" ng-model="foodDesc" required></textarea>
                            <input class="form-control" placeholder="Price" ng-model="foodPrice" type="number" required>
                            <select class="form-control" placeholder="Room Type" ng-model="foodType" required>
                              <option value="Main Course">Main Course</option>
                              <option value="Appetizers">Appetizers</option>
                              <option value="Soup">Soup</option>
                              <option value="Salads">Salads</option>
                              <option value="Side Dish">Side Dish</option>
                              <option value="Desserts">Desserts</option>
                              <option value="Beverages">Beverages</option>
                            </select>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-success" onclick="$('#insertFood').modal('hide');">Create Food <span class="fa fa-edit"></span></button>
                            <button type="button" class="btn btn-danger" onclick="$('#insertFood').modal('hide');">Close <span class="fa fa-close"></span></button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <md-tabs md-dynamic-height md-border-bottom>
        
        <md-tab label="Main Course" ng-click="">
            <md-content>
                <md-list flex>
                    <md-list-item class="md-3-line rrList" ng-repeat = "food in foodPerMenu track by $index" data-target="#editFood" data-toggle="modal" ng-click="editFoodModal(food.FoodId, food.Name, food.Price, food.Description)" ng-if="food.Category=='Main Course'">
                        <!--<md-checkbox ng-model="food.selected"></md-checkbox>-->
                            <div>
                                <img src="{{food.Picture}}" class="logoPic" style="border-radius: 50%;">
                            </div>
                            <div style="width:100%;">
                                {{food.Name}}<br>
                                {{food.Description}}<br>
                                <div style="float:right;"><strong>{{food.Price}} Php</strong></div>
                            </div>
                    </md-list-item>
                <md-list>
    
            </md-content>
          </md-tab>

          <md-tab label="Appetizers" ng-click="">
            <md-content>
                <md-list flex>
                    <md-list-item class="md-3-line rrList" ng-repeat = "food in foodPerMenu track by $index" data-target="#editFood" data-toggle="modal" ng-click="editFoodModal(food.FoodId, food.Name, food.Price, food.Description)" ng-if="food.Category=='Appetizers'">
                        <!--<md-checkbox ng-model="food.selected"></md-checkbox>-->
                            <div>
                                <img src="{{food.Picture}}" class="logoPic" style="border-radius: 50%;">
                            </div>
                            <div style="width:100%;">
                                {{food.Name}}<br>
                                {{food.Description}}<br>
                                <div style="float:right;"><strong>{{food.Price}} Php</strong></div>
                            </div>
                    </md-list-item>
                <md-list>
                    
    
            </md-content>
            
          </md-tab>

          
          <md-tab label="Soup" ng-click="">
            <md-content>
                <md-list flex>
                    <md-list-item class="md-3-line rrList" ng-repeat = "food in foodPerMenu track by $index" data-target="#editFood" data-toggle="modal" ng-click="editFoodModal(food.FoodId, food.Name, food.Price, food.Description)" ng-if="food.Category=='Soup'">
                        <!--<md-checkbox ng-model="food.selected"></md-checkbox>-->
                            <div>
                                <img src="{{food.Picture}}" class="logoPic" style="border-radius: 50%;">
                            </div>
                            <div style="width:100%;">
                                {{food.Name}}<br>
                                {{food.Description}}<br>
                                <div style="float:right;"><strong>{{food.Price}} Php</strong></div>
                            </div>
                    </md-list-item>
                <md-list>
                    
    
            </md-content>
            
          </md-tab>

          
          <md-tab label="Salads" ng-click="">
            <md-content>
                <md-list flex>
                    <md-list-item class="md-3-line rrList" ng-repeat = "food in foodPerMenu track by $index" data-target="#editFood" data-toggle="modal" ng-click="editFoodModal(food.FoodId, food.Name, food.Price, food.Description)" ng-if="food.Category=='Salads'">
                        <!--<md-checkbox ng-model="food.selected"></md-checkbox>-->
                            <div>
                                <img src="{{food.Picture}}" class="logoPic" style="border-radius: 50%;">
                            </div>
                            <div style="width:100%;">
                                {{food.Name}}<br>
                                {{food.Description}}<br>
                                <div style="float:right;"><strong>{{food.Price}} Php</strong></div>
                            </div>
                    </md-list-item>
                <md-list>
                    
    
            </md-content>
            
          </md-tab>

          <md-tab label="Side Dish" ng-click="">
            <md-content>
                <md-list flex>
                    <md-list-item class="md-3-line rrList" ng-repeat = "food in foodPerMenu track by $index" data-target="#editFood" data-toggle="modal" ng-click="editFoodModal(food.FoodId, food.Name, food.Price, food.Description)" ng-if="food.Category=='Side Dish'">
                        <!--<md-checkbox ng-model="food.selected"></md-checkbox>-->
                            <div>
                                <img src="{{food.Picture}}" class="logoPic" style="border-radius: 50%;">
                            </div>
                            <div style="width:100%;">
                                {{food.Name}}<br>
                                {{food.Description}}<br>
                                <div style="float:right;"><strong>{{food.Price}} Php</strong></div>
                            </div>
                    </md-list-item>
                <md-list>
                    
    
            </md-content>
            
          </md-tab>

          
          <md-tab label="Desserts" ng-click="">
            <md-content>
                <md-list flex>
                    <md-list-item class="md-3-line rrList" ng-repeat = "food in foodPerMenu track by $index" data-target="#editFood" data-toggle="modal" ng-click="editFoodModal(food.FoodId, food.Name, food.Price, food.Description)" ng-if="food.Category=='Desserts'">
                        <!--<md-checkbox ng-model="food.selected"></md-checkbox>-->
                            <div>
                                <img src="{{food.Picture}}" class="logoPic" style="border-radius: 50%;">
                            </div>
                            <div style="width:100%;">
                                {{food.Name}}<br>
                                {{food.Description}}<br>
                                <div style="float:right;"><strong>{{food.Price}} Php</strong></div>
                            </div>
                    </md-list-item>
                <md-list>
                    
    
            </md-content>
            
          </md-tab>

          
          <md-tab label="Beverages" ng-click="">
            <md-content>
                <md-list flex>
                    <md-list-item class="md-3-line rrList" ng-repeat = "food in foodPerMenu track by $index" data-target="#editFood" data-toggle="modal" ng-click="editFoodModal(food.FoodId, food.Name, food.Price, food.Description)" ng-if="food.Category=='Beverages'">
                        <!--<md-checkbox ng-model="food.selected"></md-checkbox>-->
                            <div>
                                <img src="{{food.Picture}}" class="logoPic" style="border-radius: 50%;">
                            </div>
                            <div style="width:100%;">
                                {{food.Name}}<br>
                                {{food.Description}}<br>
                                <div style="float:right;"><strong>{{food.Price}} Php</strong></div>
                            </div>
                    </md-list-item>
                <md-list>
                    
    
            </md-content>
            
          </md-tab>
          
        </md-tabs>
        
        <div id="editFood" class="modal fade" role="dialog">
                    <div class="modal-dialog">
                        <form ng-submit="editFood()">
                            <div class="modal-content">
                                <div class="modal-header" style="background-color:#003300; color:white;">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        <h2>Edit Food</h2>
                                </div>
                                <div class="modal-body">
                                    <input ng-model="mod.modalId" required hidden>
                                    <input class="form-control" placeholder="Menu Name" ng-model="mod.modalName" required>
                                    <textarea class="form-control" placeholder="Description" ng-model="mod.modalDesc" required></textarea>
                                    <input class="form-control" placeholder="Price" ng-model="mod.modalPrice" type="number" required>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-warning" onclick="$('#editFood').modal('hide');">Edit Food <span class="fa fa-edit"></span></button>
                                    <button type="button" class="btn btn-danger" onclick="$('#editFood').modal('hide');">Close <span class="fa fa-close"></span></button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
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
var active2 = angular.element( document.querySelector( '#menuTab' ) );
active2.addClass('active');

var app = angular.module('unwindApp', ['ngMaterial', 'oitozero.ngSweetAlert', 'chieffancypants.loadingBar', 'ngAnimate']);
app.config(function(cfpLoadingBarProvider) {
    cfpLoadingBarProvider.includeSpinner = true;
  })
app.controller('menuController', function($scope, $http, $mdDialog, SweetAlert) {

    $scope.init = function () {
        $scope.foodSet = {food: []};
        $scope.food = [];

        
        $http.get("../queries/get/getFoodFromMenu.php").then(function (response){
            $scope.foodPerMenu = response.data.records;
        });
        
    };


    $scope.insertFood = function() {
        $http.post('../queries/insert/insertFood.php', {
            'foodName': $scope.foodName,
            'foodDesc': $scope.foodDesc,
            'foodPrice': $scope.foodPrice,
            'foodType': $scope.foodType
        }).then(function(data, status){
            $scope.init();
            $scope.foodName=$scope.foodDesc=$scope.foodPrice=$scope.foodType="";
        })
    };

    $scope.mod = {
        $modalId: "",
        $modalName: "",
        $modalDesc: "",
        $modalPrice: ""
    };
    
    $scope.editFoodModal = function($id, $name, $price, $desc) {
        $scope.mod.modalId = $id;
        $scope.mod.modalName = $name;
        $scope.mod.modalDesc = $desc;
        $scope.mod.modalPrice = parseInt($price);
    };
    
    
    $scope.editFood = function() {
        SweetAlert.swal({
            title: "Are you sure?",
            text: "Do you want to edit "+$scope.mod.modalName,
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55", confirmButtonText: "Yes, edit it!",
            cancelButtonText: "Cancel!",
            closeOnConfirm: false,
            closeOnCancel: false }, 
         function(isConfirm){ 
            if (isConfirm) {
                $http.post('../queries/update/editFood.php', {
                    'id': $scope.mod.modalId,
                    'name': $scope.mod.modalName,
                    'desc': $scope.mod.modalDesc,
                    'price': $scope.mod.modalPrice
                }).then(function(data, status){
                    $scope.init();
                    SweetAlert.swal("Edit Successful!", "You edited the Food", "success");
                })
            } else {
               SweetAlert.swal("Cancelled", "You cancelled editting", "error");
            }
         });
    };
});
</script>