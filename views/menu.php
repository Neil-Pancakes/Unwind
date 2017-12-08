<?php
require ("../header.php");
include '../sidebar.php';
?>
 <!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
  <section class="content" ng-app="unwindApp">
    <div ng-cloak ng-controller="floorController" data-ng-init="init()">
        <div layout="row" style="float:right;">
            <md-button class="md-raised" style="color:white; background-color:lightgreen">Add Food to Menu</md-button>
        </div>
        
        
      <md-content>
        
        <md-tabs md-dynamic-height md-border-bottom>
          <md-tab ng-repeat="x in floor track by $index" label="Floor {{x.FloorNumber}}">
            <md-content>
                
                <div layout="row" style="float:right;">
                    <md-button class="md-raised md-warn" style="float:right; ">Remove Food from Menu</md-button>
                </div>
                <div layout="row" style="float:right;">
                    <md-button class="md-raised" style="color:white; background-color:green">Add Food to Menu</md-button>
                </div>
                <md-list flex style="width:68%;">
                    <md-list-item class="md-3-line" ng-click="null">
                        <div class="md-list-item-text" layout="column">
                            <h3>Name</h3>
                            <h4>Description</h4>
                            <p>price</p>
                        </div>
                    </md-list-item>

                    <md-list-item class="md-3-line" ng-click="null">
                        <div class="md-list-item-text" layout="column">
                            <h3>Name</h3>
                            <h4>Description</h4>
                            <p>price</p>
                        </div>
                    </md-list-item>
                    <md-list-item class="md-3-line" ng-click="null">
                        <div class="md-list-item-text" layout="column">
                            <h3>Name</h3>
                            <h4>Description</h4>
                            <p>price</p>
                        </div>
                    </md-list-item>
                <md-list>            
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
    };
});
</script>
