<?php
require ("../header.php");
include '../sidebar.php';
?>
 <!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
  <section class="content" ng-app="unwindApp">
    <div ng-cloak ng-controller="floorController" data-ng-init="init()">
      <div layout="row">
        <md-button class="md-raised" style="color:white; background-color:lightgreen" data-target="#createRoom" data-toggle="modal">Add New Room</md-button>
      </div>

      <div id="createRoom" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <form ng-submit="createRoom()">
                    <div class="modal-content">
                        <div class="modal-header" style="background-color:#003300; color:white;">
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
        <md-tabs md-dynamic-height md-border-bottom>
          <md-tab ng-repeat="x in floor track by $index" label="Floor {{x.FloorNumber}}">
            <md-content>  
            <div>
              <md-content class="md-padding" layout-xs="column" layout="row">
                <div flex-xs flex-gt-xs="50" layout="column">
                  <md-card md-theme-watch ng-click="">
                    <md-card-title>
                      <md-card-title-text>
                        <span class="md-headline">Room 101</span>
                      </md-card-title-text>
                      <md-card-title-media>
                        <div class="md-media-xs card-media"><img src="../includes/img/bed2.png"></div>  
                      </md-card-title-media>
                    </md-card-title>
                  </md-card>              
                </div>

                <div flex-xs flex-gt-xs="50" layout="column">
                  <md-card  md-theme-watch ng-click="">
                    <md-card-title>
                      <md-card-title-text>
                        <span class="md-headline">Room 101</span>
                      </md-card-title-text>
                      <md-card-title-media>
                        <div class="md-media-xs card-media"><img src="../includes/img/bed2.png"></div>  
                      </md-card-title-media>
                    </md-card-title>
                  </md-card>              
                </div>

                <div flex-xs flex-gt-xs="50" layout="column" >
                  <md-card md-theme-watch ng-click="">
                    <md-card-title>
                      <md-card-title-text>
                        <span class="md-headline">Room 101</span>
                      </md-card-title-text>
                      <md-card-title-media>
                        <div class="md-media-xs card-media"><img src="../includes/img/bed2.png"></div>  
                      </md-card-title-media>
                    </md-card-title>
                  </md-card>              
                </div>

                <div flex-xs flex-gt-xs="50" layout="column">
                  <md-card md-theme-watch ng-click="">
                    <md-card-title>
                      <md-card-title-text>
                        <span class="md-headline">Room 101</span>
                      </md-card-title-text>
                      <md-card-title-media>
                        <div class="md-media-xs card-media"><img src="../includes/img/bed2.png"></div>  
                      </md-card-title-media>
                    </md-card-title>
                  </md-card>              
                </div>

              </md-content>

              <md-content class="md-padding" layout-xs="column" layout="row">
                <div flex-xs flex-gt-xs="50" layout="column">
                  <md-card md-theme-watch ng-click="">
                    <md-card-title>
                      <md-card-title-text>
                        <span class="md-headline">Room 101</span>
                      </md-card-title-text>
                      <md-card-title-media>
                        <div class="md-media-xs card-media"><img src="../includes/img/bed2.png"></div>  
                      </md-card-title-media>
                    </md-card-title>
                  </md-card>              
                </div>

                <div flex-xs flex-gt-xs="50" layout="column">
                  <md-card  md-theme-watch ng-click="">
                    <md-card-title>
                      <md-card-title-text>
                        <span class="md-headline">Room 101</span>
                      </md-card-title-text>
                      <md-card-title-media>
                        <div class="md-media-xs card-media"><img src="../includes/img/bed2.png"></div>  
                      </md-card-title-media>
                    </md-card-title>
                  </md-card>              
                </div>

                <div flex-xs flex-gt-xs="50" layout="column" >
                  <md-card md-theme-watch ng-click="">
                    <md-card-title>
                      <md-card-title-text>
                        <span class="md-headline">Room 101</span>
                      </md-card-title-text>
                      <md-card-title-media>
                        <div class="md-media-xs card-media"><img src="../includes/img/bed2.png"></div>  
                      </md-card-title-media>
                    </md-card-title>
                  </md-card>              
                </div>

                <div flex-xs flex-gt-xs="50" layout="column">
                  <md-card md-theme-watch ng-click="">
                    <md-card-title>
                      <md-card-title-text>
                        <span class="md-headline">Room 101</span>
                      </md-card-title-text>
                      <md-card-title-media>
                        <div class="md-media-xs card-media"><img src="../includes/img/bed2.png"></div>  
                      </md-card-title-media>
                    </md-card-title>
                  </md-card>              
                </div>

              </md-content>

              <md-content class="md-padding" layout-xs="column" layout="row">
                <div flex-xs flex-gt-xs="50" layout="column">
                  <md-card md-theme-watch ng-click="">
                    <md-card-title>
                      <md-card-title-text>
                        <span class="md-headline">Room 101</span>
                      </md-card-title-text>
                      <md-card-title-media>
                        <div class="md-media-xs card-media"><img src="../includes/img/bed2.png"></div>  
                      </md-card-title-media>
                    </md-card-title>
                  </md-card>              
                </div>

                <div flex-xs flex-gt-xs="50" layout="column">
                  <md-card  md-theme-watch ng-click="">
                    <md-card-title>
                      <md-card-title-text>
                        <span class="md-headline">Room 101</span>
                      </md-card-title-text>
                      <md-card-title-media>
                        <div class="md-media-xs card-media"><img src="../includes/img/bed2.png"></div>  
                      </md-card-title-media>
                    </md-card-title>
                  </md-card>              
                </div>

                <div flex-xs flex-gt-xs="50" layout="column" >
                  <md-card md-theme-watch ng-click="">
                    <md-card-title>
                      <md-card-title-text>
                        <span class="md-headline">Room 101</span>
                      </md-card-title-text>
                      <md-card-title-media>
                        <div class="md-media-xs card-media"><img src="../includes/img/bed2.png"></div>  
                      </md-card-title-media>
                    </md-card-title>
                  </md-card>              
                </div>

                <div flex-xs flex-gt-xs="50" layout="column">
                  <md-card md-theme-watch ng-click="">
                    <md-card-title>
                      <md-card-title-text>
                        <span class="md-headline">Room 101</span>
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
var app = angular.module('unwindApp', ['ngMaterial']);

app.controller('floorController', function($scope, $http, $mdDialog) {
    $scope.init = function () {
      $http.get("../queries/get/getFloor.php").then(function (response) {
        
        $scope.floor = response.data.records;
      });

      $http.get("../queries/get/getRoomTypes.php").then(function (response) {
        
        $scope.roomTypeList = response.data.records;
      });
    };
});
</script>
