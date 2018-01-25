<?php
require ("../header.php");
include '../sidebar.php';
?>
<div class="content-wrapper" ng-app="unwindApp">
  <div ng-cloak ng-controller="reportController" data-ng-init="init()">
    <section class="content-header">
      <h1>
        ChartJS
        <small>Preview sample</small>
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-6">
          <!-- AREA CHART -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Area Chart</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <div class="box-body">
              <div class="chart">
              <canvas id="polar-area" class="chart chart-polar-area"
                chart-data="data" chart-labels="labels" chart-options="options">
              </canvas>
              </div>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->

          <!-- DONUT CHART -->
          <div class="box box-danger">
            <div class="box-header with-border">
              <h3 class="box-title">Pie Chart</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <div class="box-body">
            <canvas id="pie" class="chart chart-pie"
              chart-data="data" chart-labels="labels" chart-options="options">
            </canvas> 
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->

        </div>
        <!-- /.col (LEFT) -->
        <div class="col-md-6">
          <!-- LINE CHART -->
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Line Chart</h3>
              <button ng-click="getReports()"></button>
              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <div class="box-body">
              <div class="chart">
              <canvas id="line" class="chart chart-line" chart-data="data"
              chart-labels="labels">
              </canvas>
              </div>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->

          <!-- BAR CHART -->
          <div class="box box-success">
            <div class="box-header with-border">
              <h3 class="box-title">Bar Chart</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <div class="box-body">
              <div class="chart">
              <canvas id="bar" class="chart chart-bar"
                chart-data="data" chart-labels="labels"> chart-series="series"
              </canvas
              </div>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->

        </div>
        </div>
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
    $scope.data = [
      [65, 59, 80, 81, 56, 55, 40]
    ];
    $scope.labels = ["January", "February", "March", "April", "May", "June", "July"];
  };
  $scope.getReports = function(){
    $http.get('../queries/get/getReport.php').then(function (response) {
      $scope.records = response.data.records;
      for($x=0;$x<12;$x++){
        console.log("Month:"+$scope.records[$x].Month+"||Number:"+$scope.records[$x].Number);
      }
    });
  };
});
</script>