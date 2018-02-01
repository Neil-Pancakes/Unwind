<?php
require ("../header.php");
include '../sidebar.php';
?>
<div class="content-wrapper" ng-app="unwindApp">
  <div ng-cloak ng-controller="reportController" data-ng-init="init()">
    <section class="content-header">
      <h1>
        Reports
        <md-button class="md-raised" ng-click="init()">Refresh <span class="fa fa-refresh"></span></md-button>
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">
    <md-content>
      <md-tabs md-dynamic-height md-border-bottom class="md-no-animation">
          <md-tab label="Check-in Reports">
            <md-content>  
                <!-- /.col (LEFT) -->
      <div class="col-md-6">
        <!-- LINE CHART -->
          <div class="box-header with-border">
            <h3 class="box-title">Check-in per month</h3>
            <div class="box-tools pull-right">
              <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
              </button>
              <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
            </div>
          </div>
          <div class="box-body">
            <div class="chart">
            <canvas id="line" class="chart chart-line" chart-data="check"
            chart-labels="checklabels">
            </canvas>
            </div>
          </div>
          <!-- /.box-body -->
        <!-- /.box -->

        </div>
            </md-content>
          </md-tab>
          <md-tab label="Food Reports">
            <md-content>  
                <!-- /.col (LEFT) -->
      <div class="col-md-6">
        <!-- LINE CHART -->
          <div class="box-header with-border">
            <h3 class="box-title">Food Sold</h3>
            <div class="box-tools pull-right">
              <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
              </button>
              <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
            </div>
          </div>
          <div class="box-body">
            <div class="chart">
              <canvas id="bar" class="chart chart-bar" chart-data="fooddata" chart-labels="foodlabels" chart-series="series">
              </canvas>
            </div>
          </div>
          <!-- /.box-body -->
        <!-- /.box -->

        </div>
            </md-content>
          </md-tab>
        </md-tabs>     
        </md-content>
      </section>
    </div>  
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
var active = angular.element( document.querySelector( '#reportsTab' ) );
active.addClass('active');

var app = angular.module('unwindApp', ['ngMaterial', 'oitozero.ngSweetAlert', 'chieffancypants.loadingBar', 'ngAnimate', 'chart.js']);
app.config(function(cfpLoadingBarProvider) {
    cfpLoadingBarProvider.includeSpinner = true;
  })
app.config(function (ChartJsProvider) {
  ChartJsProvider.setOptions({ colors : [ '#803690', '#00ADF9', '#DCDCDC', '#46BFBD', '#FDB45C', '#949FB1', '#4D5360'] });
});
app.controller('reportController', function($scope, $http, $mdDialog, SweetAlert) {
  $scope.init = function(){
  $scope.checklabels = [" "];
  $scope.check = [0];
  $scope.foodlabels = [];
  $scope.fooddata = [];
    $http.get('../queries/get/getCheckinReportByMonth.php').then(function (response) {
      $scope.checkrecords = response.data.records;

      $len=$scope.checkrecords.length;
      for($x=0;$x<$len;$x++){
        $scope.checklabels.push($scope.checkrecords[$x].Month);
        $scope.check.push($scope.checkrecords[$x].Number);
      }
    });
    $http.get('../queries/get/getFoodReport.php').then(function (response) {
      $scope.foodrecords = response.data.records;

      $len=$scope.foodrecords.length;
      for($x=0;$x<$len;$x++){
        $scope.foodlabels.push($scope.foodrecords[$x].FoodName);
        $scope.fooddata.push($scope.foodrecords[$x].FoodAmount);
      }
      $scope.foodlabels.push();
      $scope.fooddata.push(0);
    });
  };
});
</script>