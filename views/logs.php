<?php
require ("../header.php");
include '../sidebar.php';
?>
 <!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
  <section class="content" ng-app="unwindApp">
    <div ng-cloak ng-controller="logController" data-ng-init="init()">
      <md-content>
      <md-button class="md-raised" ng-click="init()">Refresh <span class="fa fa-refresh"></span></md-button>
      <md-tabs md-dynamic-height md-border-bottom>
        
        <md-tab label="Reservations" ng-click="">
            <md-content>
                 <md-list flex>
                    <md-list-item class="md-3-line rrList" ng-repeat = "x in reservationLog">
                            <img ng-if="x.ReservationRequestStatus=='Accepted'" src="http://localhost/Unwind/includes/img/accept.png" class="md-avatar" style="height:32px; width:32px;">
                            <img ng-if="x.ReservationRequestStatus=='Rejected'" src="http://localhost/Unwind/includes/img/reject.png" class="md-avatar" style="height:32px; width:32px;">
                            
                            <div class="md-list-item-text" layout="column">
                                <h3>{{x.Name}}</h3>
                                <h4>
                                <span ng-if="x.ReservationRequestStatus=='Accepted'" style="color:green;">{{x.ReservationRequestStatus}}</span> 
                                <span ng-if="x.ReservationRequestStatus=='Rejected'" style="color:red;">{{x.ReservationRequestStatus}}</span>
                                  a reservation request<h4>
                                <p>{{x.ResponseTime}}</p>
                            </div>
                    </md-list-item>
                <md-list>
    
            </md-content>
          </md-tab>

          <md-tab label="Service Requests" ng-click="">
            <md-content>
                <md-list flex>
                    <md-list-item class="md-3-line rrList" ng-repeat = "x in serviceLog">
                            <img ng-if="x.ServiceRequestStatus=='Waiting'" src="http://localhost/Unwind/includes/img/waiting.png" class="md-avatar" style="height:32px; width:32px;">
                            <img ng-if="x.ServiceRequestStatus=='Completed'" src="http://localhost/Unwind/includes/img/completed.png" class="md-avatar" style="height:32px; width:32px;">
                            <img ng-if="x.ServiceRequestStatus=='Rejected'" src="http://localhost/Unwind/includes/img/reject.png" class="md-avatar" style="height:32px; width:32px;">
                            
                            <div class="md-list-item-text" layout="column">
                                <h3>{{x.EmployeeName}}</h3>
                                <h4> Service request by {{x.Name}} Status: 
                                  <span ng-if="x.ServiceRequestStatus=='Waiting'" style="color:#b3b300;">{{x.ServiceRequestStatus}}</span>
                                  <span ng-if="x.ServiceRequestStatus=='Completed'" style="color:green;">{{x.ServiceRequestStatus}}</span>
                                  <span ng-if="x.ServiceRequestStatus=='Rejected'" style="color:red;">{{x.ServiceRequestStatus}}</span>
                                <h4>
                                <p>{{x.ResponseTime}}</p>
                            </div>
                    </md-list-item>
                <md-list>
    
            </md-content>
          </md-tab>

          
          <md-tab label="Food Orders" ng-click="">
            <md-content>
                <md-list flex>
                    <md-list-item class="md-3-line rrList" ng-repeat = "x in foodLog track by $index">
                      <img src="http://localhost/Unwind/includes/img/waiter.png" class="md-avatar" style="height:32px; width:32px;">
                            
                      <div class="md-list-item-text" layout="column">
                        <h3>{{x.EmployeeName}}</h3>
                        <h4> Food Order from {{x.Name}} was
                        <span style="color:green;">{{x.FoodOrderStatus}}</span>
                        <h4>
                        <p>{{x.ResponseTime}}</p>
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
var active = angular.element( document.querySelector( '#logTab' ) );
active.addClass('active');

var app = angular.module('unwindApp', ['ngMaterial', 'oitozero.ngSweetAlert', 'chieffancypants.loadingBar', 'ngAnimate']);
app.config(function(cfpLoadingBarProvider) {
    cfpLoadingBarProvider.includeSpinner = true;
  })
app.controller('logController', function($scope, $http, $mdDialog, SweetAlert) {
  $scope.init = function(){
    $http.get('../queries/get/getLogsReservationRequest.php').then(function (response){
      $scope.reservationLog = response.data.records;
    });

    $http.get('../queries/get/getLogsServiceRequest.php').then(function (response){
      $scope.serviceLog = response.data.records;
    });

    $http.get('../queries/get/getLogsFoodOrder.php').then(function (response){
      $scope.foodLog = response.data.records;
    });
  }
});
</script>