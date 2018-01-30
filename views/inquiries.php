<?php
require ("../header.php");
include '../sidebar.php';
?>
 <!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
  <section class="content" ng-app="unwindApp">
    <div ng-cloak ng-controller="inquiriesController" data-ng-init="init()">
        <md-content>
            <h3>Inquiries</h3>
            <md-list flex style="float:left;width:100%;">
                <md-list-item class="md-3-line rrList" ng-repeat="x in inquiry" style="width:100%;">
                    <div id="rrListDiv">
                        <div>
                            <md-button class="md-raised" style="color:white; background-color:orange; float:right;" data-target="#insertFood" data-toggle="modal">Respond</md-button>
                            <div>{{x.Name}} ({{x.Month}} {{x.Day}}, {{x.Year}}) </div>
                            <div>{{x.Message}}</div>
                        </div>  
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
var active = angular.element( document.querySelector( '#inquiriesTab' ) );
active.addClass('active');

var app = angular.module('unwindApp', ['ngMaterial', 'oitozero.ngSweetAlert', 'chieffancypants.loadingBar', 'ngAnimate']);
app.config(function(cfpLoadingBarProvider) {
    cfpLoadingBarProvider.includeSpinner = true;
  })
app.controller('inquiriesController', function($scope, $http, $mdDialog, SweetAlert) {

    $scope.init = function () {

        $http.get("../queries/get/getInquiry.php").then(function (response){
            $scope.inquiry = response.data.records;
            
        });
    };

    $scope.respond = function(){
      
    };
});
</script>