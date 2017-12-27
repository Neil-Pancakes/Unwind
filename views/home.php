<?php
require ("../header.php");
include '../sidebar.php';
?>
 <!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
  <section class="content" ng-app="unwindApp">
    <div ng-cloak ng-controller="floorController" data-ng-init="init()">
      <div layout="row">
        <md-button id="createRoomButton" class="md-raised" data-target="#createRoom" data-toggle="modal">Add New Room</md-button>
      </div>

      <div id="createRoom" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <form ng-submit="createRoom()">
                    <div class="modal-content">
                        <div class="modal-header" id="createHeader">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h2>Create Menu</h2>
                        </div>
                        <div class="modal-body">
                            <select class="form-control" placeholder="Room Type" ng-model="roomType" ng-options="x.RoomName for x in roomTypeList" required></select>
                            <select class="form-control" placeholder="Floor" ng-model="floorId" ng-options="x.FloorId for x in floor" required>

                            </select>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-success" onclick="$('#createRoom').modal('hide');">Create Menu <span class="fa fa-edit"></span></button>
                            <button type="button" class="btn btn-danger" onclick="$('#createRoom').modal('hide');">Close <span class="fa fa-close"></span></button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

      <md-content>
        <md-tabs md-dynamic-height md-border-bottom class="md-no-animation">
          <md-tab label="Floor 1">
            <md-content>  
            <div>
              <md-content class="md-padding" layout-xs="column" layout="row">

                <div flex-xs flex-gt-xs="50" layout="column" ng-repeat = "room in room1">
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
              </md-content>
            </div>
            </md-content>
          </md-tab>

          <md-tab label="Floor 2">
            <md-content>  
            <div>
              <md-content class="md-padding" layout-xs="column" layout="row">

                <div flex-xs flex-gt-xs="50" layout="column" ng-repeat = "room in room2">
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
              </md-content>
            </div>
            </md-content>
          </md-tab>

          <md-tab label="Floor 3">
            <md-content>  
            <div>
              <md-content class="md-padding" layout-xs="column" layout="row">

                <div flex-xs flex-gt-xs="50" layout="column" ng-repeat = "room in room3">
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
              </md-content>
            </div>
            </md-content>
          </md-tab>

          <md-tab label="Floor 4">
            <md-content>  
            <div>
              <md-content class="md-padding" layout-xs="column" layout="row">

                <div flex-xs flex-gt-xs="50" layout="column" ng-repeat = "room in room4">
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
              </md-content>
            </div>
            </md-content>
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

var app = angular.module('unwindApp', ['ngMaterial']);

app.controller('floorController', function($scope, $http, $mdDialog) {
    $scope.init = function () {
      $scope.roomSet = {rooms: []};
      $scope.rooms = [];
      $http.get("../queries/get/getFloor.php").then(function (response) {
        $scope.floor = response.data.records;
        $floorList = $scope.floor;

        $http.get("../queries/get/getRoomPerFloor.php?floorId=1").then(function (response) {
            
            $scope.room1 = response.data.records;
        });
        $http.get("../queries/get/getRoomPerFloor.php?floorId=2").then(function (response) {
            
            $scope.room2 = response.data.records;
        });
        $http.get("../queries/get/getRoomPerFloor.php?floorId=3").then(function (response) {
            
            $scope.room3 = response.data.records;
        });
        $http.get("../queries/get/getRoomPerFloor.php?floorId=4").then(function (response) {
            
            $scope.room4 = response.data.records;
        });
      });
    };
      
      

/*
      $http.get("../queries/get/getRoomTypes.php").then(function (response) {
        
        $scope.roomTypeList = response.data.records;
      });*/
});
</script>
