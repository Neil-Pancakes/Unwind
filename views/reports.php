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
        <!-- LINE CHART -->
          <div class="box-header with-border">
            <h3 class="box-title">Check-in per month</h3>
          </div>
          <div class="box-body">
            <div class="chart">
              <canvas id="bar" class="chart chart-bar" chart-data="check" chart-labels="checklabels" chart-series="series">
              </canvas>
            </div>
          </div>
          <!-- /.box-body -->
        <!-- /.box -->

        <!-- LINE CHART -->
          <div class="box-header with-border">
            <h3 class="box-title">Frequency of Reservation per Room Type</h3>
          </div>
          <div class="box-body">
            <div class="chart">
            <canvas id="bar" class="chart chart-bar" chart-data="rt" chart-labels="rtlabels" chart-series="series">
              </canvas>
            </div>
          </div>
          <!-- /.box-body -->
        <!-- /.box -->
            </md-content>
          </md-tab>
          <md-tab label="Food Reports">
            <md-content>  
                <!-- /.col (LEFT) -->
        <!-- LINE CHART -->
          <div class="box-header with-border">
            <h3 class="box-title">Food Sold</h3>
          </div>
          <div class="box-body">
            <div class="chart">
              <canvas id="bar" class="chart chart-bar" chart-data="fooddata" chart-labels="foodlabels" chart-series="series">
              </canvas>
            </div>
          </div>
          <!-- /.box-body -->
        <!-- /.box -->
            </md-content>
          </md-tab>

          <md-tab label="Financial Report">
            <md-content>  
              <div class="box-header with-border">
                <h3 class="box-title">Earnings from Rooms per Month</h3>
              </div>
              <div class="box-body">
                <div class="chart">
                  <canvas id="line" class="chart chart-line" chart-data="financeRoom" chart-labels="financeRoomLabels" chart-series="series">
                  </canvas>
                </div>
              </div>

              <div class="box-header with-border">
                <h3 class="box-title">Earnings from Food per Month</h3>
              </div>
              <div class="box-body">
                <div class="chart">
                <canvas id="line" class="chart chart-line" chart-data="financeFood" chart-labels="financeFoodLabels" chart-series="series">
                  </canvas>
                </div>
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
  $scope.checklabels = [];
  $scope.check = [];
  
  $scope.foodlabels = [];
  $scope.fooddata = [];
  
  $scope.rtlabels = [];
  $scope.rt = [];

  $scope.financeFoodLabels = [];
  $scope.financeFood = [];
  
  $scope.financeRoomLabels = [];
  $scope.financeRoom = [];

    $http.get('../queries/get/getCheckinReportByMonth.php').then(function (response) {
      $scope.checkrecords = response.data.records;

      $len=$scope.checkrecords.length;
      for($x=0;$x<$len;$x++){
        $scope.checklabels.push($scope.checkrecords[$x].Month);
        $scope.check.push($scope.checkrecords[$x].Number);
      }
      $scope.checklabels.push();
      $scope.check.push(0);
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
    $http.get('../queries/get/getMostReservedRoom.php').then(function (response) {
      $scope.rtrecords = response.data.rtrecords;

      $len=$scope.rtrecords.length;
      for($x=0;$x<$len;$x++){
        $scope.rtlabels.push($scope.rtrecords[$x].rtname);
        $scope.rt.push($scope.rtrecords[$x].rtnum);
      }
      $scope.rtlabels.push();
      $scope.rt.push(0);
    });
  };

  $http.get('../queries/get/getFinancialReportFood.php').then(function (response) {
      $scope.financeFoodRecords = response.data.records;

      $len=$scope.financeFoodRecords.length;
      for($x=0;$x<$len;$x++){
        $scope.financeFoodLabels.push($scope.financeFoodRecords[$x].Month);
        $scope.financeFood.push($scope.financeFoodRecords[$x].Total);
      }
      $scope.financeFoodLabels.push();
      $scope.financeFood.push(0);
    });

    
  $http.get('../queries/get/getFinancialReportRooms.php').then(function (response) {
      $scope.financeRoomRecords = response.data.records;

      $len=$scope.financeRoomRecords.length;
      for($x=0;$x<$len;$x++){
        $scope.financeRoomLabels.push($scope.financeRoomRecords[$x].Month);
        $scope.financeRoom.push($scope.financeRoomRecords[$x].Total);
      }
      $scope.financeRoomLabels.push();
      $scope.financeRoom.push(0);
    });
});
</script>