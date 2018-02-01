<?php
require ("../header.php");
include '../sidebar.php';
?>
 <!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
  <section class="content" ng-app="unwindApp">
    <div ng-cloak ng-controller="appController">
      <md-content>
      <md-tabs md-dynamic-height md-border-bottom>
        
        <md-tab label="Currently Checked-in" ng-click="">
            <md-content>
                <md-list flex>
                    <md-list-item class="md-3-line rrList" ng-repeat = "">
                       
                    </md-list-item>
                <md-list>
    
            </md-content>
          </md-tab>

          <md-tab label="Create a Check-in" ng-click="">
            <md-content>
                
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
var active = angular.element( document.querySelector( '#checkinTab' ) );
active.addClass('active');

var app = angular.module('unwindApp', ['ngMaterial', 'oitozero.ngSweetAlert', 'chieffancypants.loadingBar', 'ngAnimate']);
app.config(function(cfpLoadingBarProvider) {
    cfpLoadingBarProvider.includeSpinner = true;
  })
app.controller('appController', function($scope, $http, $mdDialog, SweetAlert) {

});
</script>