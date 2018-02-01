<?php
require ("../header.php");
include '../sidebar.php';
?>
 <!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
  <section class="content" ng-app="unwindApp">
    <div ng-cloak ng-controller="checkinController" data-ng-init="init()">
      <md-content>
      <md-tabs md-dynamic-height md-border-bottom>
        
        <md-tab label="Currently Checked-in" ng-click="">
            <md-content>
              <md-button class="md-raised" ng-click="init()">Refresh <span class="fa fa-refresh"></span></md-button>
              <md-list-item class="md-3-line rrList" ng-repeat="x in checkin">
                  <div id="rrListDiv">
                      <h3>{{x.Name}}</h3>
                      <span>{{x.CheckInMonth}} {{x.CheckInDay}}, {{x.CheckInYear}} - {{x.CheckOutMonth}} {{x.CheckOutDay}}, {{x.CheckOutYear}}</span>
                      <br>
                      <span>Adults: {{x.AdultQty}}</span>
                      <br>
                      <span>Children: {{x.ChildQty}}
                      <div class="acceptrejectDiv">
                          <md-button style="background-color:red; color:white;" ng-click="checkout(x.ReservationId, x.CheckInId)">Check-Out</md-button>
                      </div>
                  </div>       
              </md-list-item>
            </md-content>
          </md-tab>

          <md-tab label="Create a Check-in" ng-click="">
            <md-content>
                
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
var active = angular.element( document.querySelector( '#checkinTab' ) );
active.addClass('active');

var app = angular.module('unwindApp', ['ngMaterial', 'oitozero.ngSweetAlert', 'chieffancypants.loadingBar', 'ngAnimate']);
app.config(function(cfpLoadingBarProvider) {
    cfpLoadingBarProvider.includeSpinner = true;
  })
app.controller('checkinController', function($scope, $http, $mdDialog, SweetAlert) {
  $scope.init = function(){
    $http.get("../queries/get/getCurrentlyCheckedIn.php").then(function (response){
      $scope.checkin = response.data.records;
    })
  };

  $scope.checkout = function($res, $checkin){
    $http.post("../queries/update/checkoutReservation.php", {
      'id': $res
    }).then(function (data, status){
      $http.post("../queries/update/checkout.php", {
        'id': $checkin
      }).then(function (data, status){
        $http.get("../queries/get/getCurrentlyCheckedIn.php").then(function (response){
          $scope.checkin = response.data.records;
        })
        SweetAlert.swal("Success!", "You have checked-out the guest!", "error");
      })
    })
  }
});
</script>