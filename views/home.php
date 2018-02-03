<?php
require ("../header.php");
include '../sidebar.php';
?>
 <!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
  <section class="content" ng-app="unwindApp">
    <input ng-model="checkInId" ng-init="checkInId = '<?php if(isset($_GET['checkInId'])){echo $_GET['checkInId'];}else{echo "";}?>'" hidden>
    <div ng-cloak ng-controller="appController" data-ng-init="init()">
      <div layout="row">
        <md-button id="createRoomTypeButton" class="md-raised" data-target="#createRoomType" data-toggle="modal">Create Room Type</md-button>
        <md-button id="createRoomButton" class="md-accent md-raised" data-target="#createRoom" data-toggle="modal">Add New Room <span class="fa fa-bed"></span></md-button>
      </div>

      <div id="createRoomType" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <form ng-submit="createRoomType()">
                    <div class="modal-content">
                        <div class="modal-header createRoomType">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h2>Create Room Type</h2>
                        </div>
                        <div class="modal-body">
                            <md-input-container>
                              <label>Room Name</label>
                              <input type="text" class="form-control" ng-model="name" required>
                            </md-input-container>
                            <md-input-container>
                              <label>Price</label>
                              <input type="number" class="form-control" ng-model="price" required>
                            </md-input-container>
                            
                            <md-input-container>
                              <label>Max Adults</label>
                              <input type="number" class="form-control" ng-model="max_adult" required>
                            </md-input-container>
                            <md-input-container>
                              <label>Max Children</label>
                              <input type="number" class="form-control" ng-model="max_child" required>
                            </md-input-container>
                            <textarea placeholder="Description of the Room" ng-model="description" rows="4" cols="40" style="width:100%;"></textarea>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn createRoomType" onclick="$('#createRoomType').modal('hide');">Create Room Type <span class="fa fa-check"></span></button>
                            <button type="button" class="btn btn-danger" onclick="$('#createRoomType').modal('hide');">Close <span class="fa fa-close"></span></button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

      <div id="createRoom" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <form ng-submit="createRoom()">
                    <div class="modal-content">
                        <div class="modal-header createRoom">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h2>Create Room</h2>
                        </div>
                        <div class="modal-body">
                            <select class="form-control" placeholder="Room Type" ng-model="room_type_id" required>
                              <option ng-repeat="x in roomTypeList" value="{{x.RoomTypeId}}">{{x.RoomName}}</option>
                              <option value="" disabled hidden selected>Type of Room</option>
                            </select>
                            <select class="form-control" placeholder="Floor" ng-model="floor_id" required>
                              <option ng-repeat="x in floor" value="{{x.FloorId}}" >Floor {{x.FloorNumber}}</option>
                              <option value="" disabled hidden selected>Floor Number</option>
                            </select>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn createRoom" onclick="$('#createRoom').modal('hide');">Create Room <span class="fa fa-check"></span></button>
                            <button type="button" class="btn btn-danger" onclick="$('#createRoom').modal('hide');">Close <span class="fa fa-close"></span></button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

      <md-content>
        <md-tabs md-dynamic-height md-border-bottom class="md-no-animation">
          <md-tab ng-repeat="x in floor track by $index" label="Floor {{x.FloorNumber}}" ng-click="getRooms(x.FloorId)">
           
              <md-grid-list
        md-cols-xs="1" md-cols-sm="2" md-cols-md="4" md-cols-gt-md="4"
        md-row-height-gt-md="1:1">
                
        <md-grid-tile ng-repeat = "room in room" style=" border-style: solid; border-width:1px;" class="red"
            md-rowspan="1" md-colspan="1" md-colspan-sm="1" md-colspan-xs="1" ng-click="getInfo(room.RoomId, room.RoomStatus)" data-target="#viewRoom" data-toggle="modal">
            <img src="{{room.Picture}}" class="logoPic">
          <md-grid-tile-footer style="{{room.Color}};">
            <h3><span>Room {{room.RoomNumber}} ({{room.RoomStatus}})</span></h3>
          </md-grid-tile-footer>
        </md-grid-tile>
    </md-grid-list>

          </md-tab>

        </md-tabs>
        

        <div id="viewRoom" class="modal fade" role="dialog">
                  <div class="modal-dialog">
                    <div class="modal-content" ng-if="occupied">
                      <div class="modal-header viewUserRoom">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h2>{{user[0].Name}}</h2>
                      </div>
                      <div class="modal-body">
                        Check-In Information<br>
                        {{user[0].CheckInMonth}} {{user[0].CheckInDay}}, {{user[0].CheckInYear}} - {{user[0].CheckOutMonth}} {{user[0].CheckOutDay}}, {{user[0].CheckOutYear}}
                      </div>
                      <div>
                        <a href="services.php?checkInId={{user[0].CheckInId}}"><md-button id="" class="md-raised">View Service Requests <span class="fa fa-wrench"></md-button></a>
                        <a href="foodOrders.php?checkInId={{user[0].CheckInId}}"><md-button id="" class="md-raised">View Food Orders <span class="fa fa-book"></span></md-button></a>
                      </div>
    
                      <div class="modal-footer">
                        <button type="button" class="btn btn-danger" onclick="$('#viewRoom').modal('hide');">
                          Close <span class="fa fa-close"></span>
                        </button>
                      </div>
                    </div>

                    <div class="modal-content" ng-if="available">
                      <div class="modal-header viewUserRoom">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h2>Room is Available</h2>
                      </div>
                      <div class="modal-body">
                        There is nobody staying in this Room
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-danger" onclick="$('#viewRoom').modal('hide');">Close <span class="fa fa-close"></span></button>
                      </div>
                    </div>

                    <div class="modal-content" ng-if="unavailable">
                      <div class="modal-header viewUserRoom">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h2>UNAVAILABLE</h2>
                      </div>
                      <div class="modal-body">
                        The Room is Unavailable
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-danger" onclick="$('#viewRoom').modal('hide');">Close <span class="fa fa-close"></span></button>
                      </div>
                    </div>

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
</div>
</body>

<script>
var active = angular.element( document.querySelector( '#homeTab' ) );
active.addClass('active');

var app = angular.module('unwindApp', ['ngMaterial', 'oitozero.ngSweetAlert', 'chieffancypants.loadingBar', 'ngAnimate']);
app.config(function(cfpLoadingBarProvider) {
    cfpLoadingBarProvider.includeSpinner = true;
  })
app.controller('appController', function($scope, $http, $mdDialog, SweetAlert) {

  
    $scope.init = function () {
      $scope.name=$scope.price=$scope.description=$scope.max_child=$scope.max_adult=$scope.room_type_id=$scope.floor_id="";

      $http.get("../queries/get/getFloor.php").then(function (response) {
        $scope.floor = response.data.records;
        $floorList = $scope.floor;
        $http.get("../queries/get/getRoomPerFloor.php?floorId="+$scope.floor[0].FloorId).then(function (response) {
            
            $scope.room = response.data.records;
        });
      });
      $scope.getRoomTypes();
    };

    $scope.getRooms = function($id){
      $http.get("../queries/get/getRoomPerFloor.php?floorId="+$id).then(function (response) {
          $scope.room = response.data.records;
      });
    };

    $scope.getRoomTypes = function(){
      $http.get("../queries/get/getRoomTypes.php").then(function(response){
        $scope.roomTypeList = response.data.records;
      });
    }

    
    $scope.getInfo = function($id, $status){
      $scope.occupied=false;
      $scope.available=false;
      $scope.unavailable=false;
      if($status=='Occupied'){
        $scope.occupied = true;
        $http.get("../queries/get/getUserFromRoomId.php?roomId="+$id).then(function (response) {
          $scope.user = response.data.records;
          if($scope.user==""){
            $http.get("../queries/get/getServiceRequestFromCheckIn.php?check_in_id="+$scope.user[0].CheckInId).then(function (response){
              $scope.service = response.data.records;
            });
            $http.get("../queries/get/getFoodOrderFromCheckIn.php?check_in_id="+$scope.user[0].CheckInId).then(function (response){
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
        });
      }else if($status=='Available'){
        $scope.available = true;
      }else if($status=='Unavailable'){
        $scope.unavailable = true;
      }
    };

    $scope.createRoomType = function(){
        $http.post('../queries/insert/insertRoomType.php', {
            'name': $scope.name,
            'price': $scope.price,
            'description': $scope.description,
            'max_adult': $scope.max_adult,
            'max_child': $scope.max_child
        }).then(function(data, status){
            $scope.getRoomTypes();
            SweetAlert.swal("Success!", "You Created a New Type of Room", "success");
        })
    };

    $scope.createRoom = function(){
        $http.post('../queries/insert/insertRoom.php', {
            'room_type_id': $scope.room_type_id,
            'floor_id': $scope.floor_id
        }).then(function(data, status){
            $scope.getRooms($scope.floor_id);
            $scope.name=$scope.price=$scope.description=$scope.max_child=$scope.max_adult=$scope.room_type_id=$scope.floor_id="";
            SweetAlert.swal("Success!", "You Created a Room", "success");
        })
    };
});
</script>