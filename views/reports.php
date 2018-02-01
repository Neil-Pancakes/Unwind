<?php
require ("../header.php");
include '../sidebar.php';
?>
<div class="content-wrapper" ng-app="unwindApp">
  <div ng-cloak ng-controller="reportController" data-ng-init="init()">
    <section class="content-header">
      <h1>
        Reports
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">
    <md-tabs md-dynamic-height md-border-bottom>
        
        <md-tab label="Monthly Reports" ng-click="">
            <md-content>
                
      <div class="row">
      
      <!-- /.col (LEFT) -->
      <div class="col-md-6">
        <!-- LINE CHART -->
        <div class="box box-info">
          <div class="box-header with-border">
            <h3 class="box-title">Check-in</h3>
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
        </div>
        <!-- /.box -->

        </div>

        <div class="col-md-6">
        <!-- LINE CHART -->
        <div class="box box-info">
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
            <canvas id="line" class="chart chart-line" chart-data="fooddata"
            chart-labels="foodlabels">
            </canvas>
            </div>
          </div>
          <!-- /.box-body -->
        </div>
        <!-- /.box -->

        </div>

        </div>
    
            </md-content>
          </md-tab>
          
      <md-tabs>

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
  $scope.series = ['Series A', 'Series B'];
    $scope.checklabels = [];
  $scope.check = [];
  $scope.foodlabels = [];
  $scope.fooddata = [];
    $http.get('../queries/get/getReportByMonth.php').then(function (response) {
      $scope.records = response.data.records;

      $len=$scope.records.length;
      for($x=0;$x<$len;$x++){
        $scope.checklabels.push($scope.records[$x].Month);
        $scope.check.push($scope.records[$x].Number);
        console.log("Month:"+$scope.records[$x].Month+"||Number:"+$scope.records[$x].Number);
        $scope.foodlabels.push($scope.records[$x].FoodMonth);
        $scope.fooddata($scope.records[$x].FoodAmount);
      }
    });
  };
});
</script>