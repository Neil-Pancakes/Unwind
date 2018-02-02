<?php
require ("../header.php");
include '../sidebar.php';
?>
 <!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
  <section class="content" ng-app="unwindApp">
    <div ng-cloak ng-controller="feedbackController" data-ng-init="init()">
        <md-content>
        <md-tabs md-dynamic-height md-border-bottom>
            <md-tab label="Summary" ng-click="">
                <md-content>
                <h1>Average Star Rating: {{average}}</h1>
                    <div class="box-header with-border">
                                    <h3 class="box-title">Feedback</h3>
                                </div>
                                <div class="box-body">
                                    <div class="chart">
                                    <canvas id="bar" class="chart chart-bar" chart-data="star" chart-labels="starlabels" chart-series="series">
                                    </canvas>
                                    </div>
                                </div>
                </md-content>
            </md-tab>
            <md-tab label="Feedback List" ng-click="">
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
            </md-tab>
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
var app = angular.module('unwindApp', ['ngMaterial', 'oitozero.ngSweetAlert', 'chieffancypants.loadingBar', 'ngAnimate', 'chart.js']);
app.config(function(cfpLoadingBarProvider) {
    cfpLoadingBarProvider.includeSpinner = true;
  })
  
app.config(function (ChartJsProvider) {
  ChartJsProvider.setOptions({ colors : [ '#803690', '#00ADF9', '#DCDCDC', '#46BFBD', '#FDB45C', '#949FB1', '#4D5360'] });
});

app.controller('feedbackController', function($scope, $http, $mdDialog, SweetAlert) {

    $scope.init = function () {
        
  $scope.starlabels = [];
  $scope.star = [];
        $http.get("../queries/get/getFeedback.php").then(function (response){
            $scope.feedback = response.data.records;
            
        });
        $http.get('../queries/get/getFeedbackRatingCount.php').then(function (response) {
            $scope.starrecords = response.data.records;

            $scope.starlabels.push("5 Stars");
            $scope.starlabels.push("4 Stars");
            $scope.starlabels.push("3 Stars");
            $scope.starlabels.push("2 Stars");
            $scope.starlabels.push("1 Stars");
            $scope.starlabels.push("0 Stars");

            $scope.star.push($scope.starrecords[0].FiveCnt);
            $scope.star.push($scope.starrecords[0].FourCnt);
            $scope.star.push($scope.starrecords[0].ThreeCnt);
            $scope.star.push($scope.starrecords[0].TwoCnt);
            $scope.star.push($scope.starrecords[0].OneCnt);
            $scope.star.push($scope.starrecords[0].ZeroCnt);
            $scope.starlabels.push();
            $scope.star.push(0);
            $scope.cnt = parseFloat($scope.starrecords[0].FiveCnt) + parseFloat($scope.starrecords[0].FourCnt) + parseFloat($scope.starrecords[0].ThreeCnt) + parseFloat($scope.starrecords[0].TwoCnt) + parseFloat($scope.starrecords[0].OneCnt) + parseFloat($scope.starrecords[0].ZeroCnt);
            $scope.average = parseFloat((parseFloat($scope.starrecords[0].FiveCnt)*5) + (parseFloat($scope.starrecords[0].FourCnt)*4) + (parseFloat($scope.starrecords[0].ThreeCnt)*3) + (parseFloat($scope.starrecords[0].TwoCnt)*2) + (parseFloat($scope.starrecords[0].OneCnt)*1)) / $scope.cnt;
            });
    };
});
</script>