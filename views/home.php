<?php
require ("../header.php");
include '../sidebar.php';
?>
 <!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
  <section class="content" ng-app="unwindApp">
    <div ng-cloak ng-controller="floorController" data-ng-init="init()">
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
            <md-content>  
            <div>
              <md-content class="md-padding" layout-xs="column" layout="row">

                <div flex-xs flex-gt-xs="50" layout="column" ng-repeat = "room in room">
                  <md-card md-theme-watch ng-click="" style="{{room.Color}}">
                    <md-card-title>
                      <md-card-title-text>
                        <span ng-if="room.RoomStatus=='Available' || room.RoomStatus=='Occupied'" class="md-headline">Room {{room.RoomNumber}}</span>
                        <span ng-if="room.RoomStatus=='Unavailable'" class="md-headline" style="color:white;">Room {{room.RoomNumber}} (Unavailable)</span>
                      </md-card-title-text>
                      <md-card-title-media>
                        <div class="md-media-xs card-media">
                          <img src="{{room.Picture}}" class="logoPic">
                        </div>
                        <img src="../includes/img/room-service.png" class="servicePic">
                        <img src="../includes/img/cleaning.png" class="servicePic" style="margin-right:2%;">
                      </md-card-title-media>
                    </md-card-title>
                  </md-card>      
                </div>
                
            </md-content>
<!--
            <md-content class="md-padding" layout-xs="column" layout="row">

                <div flex-xs flex-gt-xs="50" layout="column" ng-repeat = "room in room1 | limitTo : -3">
                  <md-card md-theme-watch ng-click="">
                    <md-card-title>
                      <md-card-title-text>
                        <span class="md-headline">Room {{room.RoomNumber}}</span>
                      </md-card-title-text>
                      <md-card-title-media>
                        <div class="md-media-xs card-media"><img src="../includes/img/bed2.png"></div>  
                      </md-card-title-media>
                    </md-card-title>
                  </md-card>      
                </div>
                
            </md-content>-->
          </md-tab>

        </md-tabs>
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
var active = angular.element( document.querySelector( '#homeTab' ) );
active.addClass('active');

var app = angular.module('unwindApp', ['ngMaterial', 'oitozero.ngSweetAlert', 'chieffancypants.loadingBar', 'ngAnimate']);
app.config(function(cfpLoadingBarProvider) {
    cfpLoadingBarProvider.includeSpinner = true;
  })
app.controller('floorController', function($scope, $http, $mdDialog, SweetAlert) {

  
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

    $scope.createRoomType = function(){
        $http.post('../queries/insert/insertRoomType.php', {
            'name': $scope.name,
            'price': $scope.price,
            'description': $scope.description,
            'max_adult': $scope.max_adult,
            'max_child': $scope.max_child
        }).then(function(data, status){
            $scope.init();
            SweetAlert.swal("Success!", "You Created a New Type of Room", "success");
        })
    };

    $scope.createRoom = function(){
        $http.post('../queries/insert/insertRoom.php', {
            'room_type_id': $scope.room_type_id,
            'floor_id': $scope.floor_id
        }).then(function(data, status){
            $scope.init();
            SweetAlert.swal("Success!", "You Created a Room", "success");
        })
    };
});
</script>