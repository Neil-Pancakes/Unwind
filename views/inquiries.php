<?php
require ("../header.php");
include '../sidebar.php';
?>
 <!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
  <section class="content" ng-app="unwindApp">
    <div ng-cloak ng-controller="inquiriesController" data-ng-init="init()">
        <md-content>
                <section class="content-header">
                    <h1>
                        Inquiries
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Inquiries</li>
                    </ol>
                </section>
                <div class="box box-primary">
                    <div class="box-body no-padding">
                        <div class="table-responsive mailbox-messages">
                            <table class="table table-hover table-striped">
                                <tbody>
                                    <tr ng-repeat="x in inquiry" ng-click="viewThread(x.InquiryId)">
                                    <td class="mailbox-name"><b>{{x.Name}}</b></td>
                                        <td class="mailbox-subject"> {{x.Message}}
                                        </td>
                                        <td style="float:right;">{{x.Month}} {{x.Day}}, {{x.Year}}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
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
app.controller('inquiriesController', function($scope, $http, $mdDialog, SweetAlert, $window) {

    $scope.init = function () {

        $http.get("../queries/get/getInquiry.php").then(function (response){
            $scope.inquiry = response.data.records;
            
        });
    };

    $scope.viewThread = function(id){
        $window.location.href = 'thread.php?inquiryId='+id;
    };
});
</script>