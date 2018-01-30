<?php
require ("../header.php");
include '../sidebar.php';
?>
 <!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
  <section class="content" ng-app="unwindApp">
    <div ng-cloak ng-controller="roomController" data-ng-init="init()">
      <div layout="row">
        <md-button id="createRoomTypeButton" class="md-raised" data-target="#createRoomType" data-toggle="modal">Create Room Type</md-button>
        <md-button id="createRoomButton" class="md-accent md-raised" data-target="#createRoom" data-toggle="modal">Add New Room <span class="fa fa-bed"></span></md-button>
        <md-button id="createFloorButton" class="md-raised" data-target="#createFloor" data-toggle="modal">Add New Floor </md-button>
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

        <div id="createFloor" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <form ng-submit="insertFloor()">
                    <div class="modal-content">
                        <div class="modal-header createFloor">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h2>Create Floor</h2>
                        </div>
                        <div class="modal-body">
                          <md-input-container>
                            <label>Floor Number</label>
                            <input type="number" class="form-control" ng-model="floor_number" required>
                          </md-input-container>                        
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn createFloor" onclick="$('#createFloor').modal('hide');">Create Floor <span class="fa fa-check"></span></button>
                            <button type="button" class="btn btn-danger" onclick="$('#createFloor').modal('hide');">Close <span class="fa fa-close"></span></button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

      <md-content>
        <md-tabs md-dynamic-height md-border-bottom class="md-no-animation">
          <md-tab ng-repeat="x in floor track by $index" label="Floor {{x.FloorNumber}}" ng-click="getRooms(x.FloorId)">
            <div id="rrListDiv">
                <md-list-item class="md-3-line" ng-repeat="room in room" data-target="#editRoom" data-toggle="modal" ng-click="editFoodModal(room.RoomId, room.RoomNumber, room.RoomStatus, x.FloorId)">
                    <img ng-src="{{room.Picture}}" class="roomListPic"/>
                    <div class="md-list-item-text" layout="column" style="text-indent:2%;">
                        <h3>{{ room.RoomNumber }}</h3>
                        <h4>{{ room.RoomStatus }}</h4>
                    </div>
                    
                    
                </md-list-item>
            </div>
          </md-tab>
            
        </md-tabs>
        
        <div id="editRoom" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <form ng-submit="editRoom()">
                    <div class="modal-content">
                        <div class="modal-header" style="background-color:#003300; color:white;">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h2>Edit Room</h2>
                        </div>
                        <div class="modal-body">
                            <input ng-model="mod.modalId" required hidden>
                            <input ng-model="mod.modalFloor" required hidden>
                            <input class="form-control" placeholder="Price" ng-model="mod.modalNumber" type="number" required>

                            <select class="form-control" ng-if="mod.modalStatus=='Available'" ng-init="mod.modalStatusUpdated=mod.modalStatus" ng-model="mod.modalStatusUpdated" required>
                              <option value="Available">Available</option>
                              <option value="Occupied">Occupied</option>
                              <option value="Unavailable">Unavailable</option>
                            </select>

                            <select class="form-control" ng-if="mod.modalStatus=='Occupied'" ng-init="mod.modalStatusUpdated=mod.modalStatus" ng-model="mod.modalStatusUpdated" required>
                              <option value="Occupied">Occupied</option>
                              <option value="Available">Available</option>
                              <option value="Unavailable">Unavailable</option>
                            </select>

                            <select class="form-control" ng-if="mod.modalStatus=='Unavailable'" ng-init="mod.modalStatusUpdated=mod.modalStatus" ng-model="mod.modalStatusUpdated" required>
                              <option value="Unavailable">Unavailable</option>
                              <option value="Available">Available</option>
                              <option value="Occupied">Occupied</option>
                            </select>
                        </div>
                        
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-warning" onclick="$('#editRoom').modal('hide');">Edit Room <span class="fa fa-edit"></span></button>
                            <button type="button" class="btn btn-danger" onclick="$('#editRoom').modal('hide');">Close <span class="fa fa-close"></span></button>
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
var active = angular.element( document.querySelector( '#roomTab' ) );
active.addClass('active');

var app = angular.module('unwindApp', ['ngMaterial', 'oitozero.ngSweetAlert', 'chieffancypants.loadingBar', 'ngAnimate']);
app.config(function(cfpLoadingBarProvider) {
    cfpLoadingBarProvider.includeSpinner = true;
  })
app.controller('roomController', function($scope, $http, $mdDialog, SweetAlert) {

  
    $scope.init = function () {
      $scope.name=$scope.price=$scope.description=$scope.max_child=$scope.max_adult=$scope.room_type_id=$scope.floor_id="";
      $scope.roomSet = {rooms: []};
      $scope.rooms = [];
      $http.get("../queries/get/getFloor.php").then(function (response) {
        $scope.floor = response.data.records;
        $floorList = $scope.floor;
        $http.get("../queries/get/getRoomPerFloor.php?floorId="+$scope.floor[0].FloorId).then(function (response) {
            
            $scope.room = response.data.records;
        });
      });
      $http.get("../queries/get/getRoomTypes.php").then(function (response) {
        $scope.roomTypeList = response.data.records;
      });
    };

    $scope.getRooms = function($id){
      $http.get("../queries/get/getRoomPerFloor.php?floorId="+$id).then(function (response) {
            
            $scope.room = response.data.records;
      });
    };

    $scope.insertFloor = function(){
        $http.post('../queries/insert/insertFloor.php', {
            'floor': $scope.floor_number
        }).then(function(data, status){
            SweetAlert.swal("Success!", "You Created a Floor", "success");
        })
    }

    $scope.createRoomType = function(){
        $http.post('../queries/insert/insertRoomType.php', {
            'name': $scope.name,  
            'price': $scope.price,
            'description': $scope.description,
            'max_adult': $scope.max_adult,
            'max_child': $scope.max_child
        }).then(function(data, status){
            $http.get("../queries/get/getRoomTypes.php").then(function (response) {
                $scope.roomTypeList = response.data.records;
            });
            SweetAlert.swal("Success!", "You Created a New Type of Room", "success");
        })
    };

    $scope.createRoom = function(){
        $http.post('../queries/insert/insertRoom.php', {
            'room_type_id': $scope.room_type_id,
            'floor_id': $scope.floor_id
        }).then(function(data, status){
            $http.get("../queries/get/getRoomPerFloor.php?floorId="+$scope.floor_id).then(function (response) {
                $scope.room = response.data.records;
            });
            SweetAlert.swal("Success!", "You Created a Room", "success");
        })
    };

    $scope.mod = {
        $modalId: "",
        $modalNumber: "",
        $modalStatus: "",
        $modalStatusUpdated: "",
        $modalFloor: ""
    };
    
    $scope.editFoodModal = function($id, $number, $status, $floor) {
        $scope.mod.modalId = $id;
        $scope.mod.modalNumber = parseInt($number);
        $scope.mod.modalStatus = $status;
        $scope.mod.modalFloor = $floor;
    };

    $scope.editRoom = function(){
        SweetAlert.swal({
            title: "Are you sure?",
            text: "Do you want to edit Room"+$scope.mod.modalNumber,
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55", confirmButtonText: "Yes, edit it!",
            cancelButtonText: "Cancel!",
            closeOnConfirm: false,
            closeOnCancel: false }, 
         function(isConfirm){ 
            if (isConfirm) {
                $http.post('../queries/update/editRoom.php', {
                    'id': $scope.mod.modalId,
                    'number': $scope.mod.modalNumber,
                    'status': $scope.mod.modalStatusUpdated
                }).then(function(data, status){
                    $http.get("../queries/get/getRoomPerFloor.php?floorId="+$scope.mod.modalFloor).then(function (response) {
                        $scope.room = "";
                        $scope.room = response.data.records;
                    });
                    SweetAlert.swal("Edit Successful!", "You edited the Room", "success");
                })
            } else {
               SweetAlert.swal("Cancelled", "You cancelled editting", "error");
            }
         });
    }
});
</script>