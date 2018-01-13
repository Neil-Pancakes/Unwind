<?php
require ("../header.php");
include '../sidebar.php';
?>
 <!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
  <section class="content" ng-app="unwindApp">
    <div ng-cloak ng-controller="floorController" data-ng-init="init()">
        <md-content>
            <md-list flex>
                <md-list-item class="md-3-line rrList" ng-click="null" ng-repeat = "x in feedback track by $index">
                    <div>
                        <div>{{x.Name}}</div>
                        <div>{{x.Comment}}</div>
                        <img ng-if="x.Rating>0" src="../includes/img/star.png" style="height:32px; width:32px;">
                        <img ng-if="x.Rating>1" src="../includes/img/star.png" style="height:32px; width:32px;">
                        <img ng-if="x.Rating>2" src="../includes/img/star.png" style="height:32px; width:32px;">
                        <img ng-if="x.Rating>3" src="../includes/img/star.png" style="height:32px; width:32px;">
                        <img ng-if="x.Rating>4" src="../includes/img/star.png" style="height:32px; width:32px;">
                        
                        <img ng-if="x.Rating<5" src="../includes/img/star-empty.png" style="height:32px; width:32px;">
                        <img ng-if="x.Rating<4" src="../includes/img/star-empty.png" style="height:32px; width:32px;">
                        <img ng-if="x.Rating<3" src="../includes/img/star-empty.png" style="height:32px; width:32px;">
                        <img ng-if="x.Rating<2" src="../includes/img/star-empty.png" style="height:32px; width:32px;">
                        <img ng-if="x.Rating<1" src="../includes/img/star-empty.png" style="height:32px; width:32px;">
                        
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
var active = angular.element( document.querySelector( '#feedbackTab' ) );
active.addClass('active');
var app = angular.module('unwindApp', ['ngMaterial']);
app.controller('floorController', function($scope, $http, $mdDialog) {
    $scope.init = function () {

        $http.get("../queries/get/getFeedback.php").then(function (response){
            $scope.feedback = response.data.records;
            
        });
    };
});
</script>