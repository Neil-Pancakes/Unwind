<?php
require ("../header.php");
include '../sidebar.php';
?>
 <div class="content-wrapper">
    <section class="content" ng-app="unwindApp">
        <input ng-model="inquiryId" ng-init="inquiryId = '<?php if(isset($_GET['inquiryId'])){echo $_GET['inquiryId'];}else{echo "";}?>'" hidden>
        <div ng-cloak ng-controller="threadController" data-ng-init="init()">
          <md-content>
            <a href="inquiries.php "><md-button class="md-raised md-warn">Go Back</md-button></a>
            <md-button class="md-raised" ng-click="getThread()">Refresh <span class="fa fa-refresh"></span></md-button>
            <div ng-repeat="x in inquiry" layout="row">
              <div ng-if="x.EmployeeId==''" class="box-body no-padding">
                <div class="mailbox-read-info">
                  <h3>From: {{x.Name}}</h3>
                  <h5><span class="mailbox-read-time">{{x.Month}} {{x.Day}}, {{x.Year}} ({{x.Time}})</span></h5>
                </div>
                <div class="mailbox-read-message">
                  <p>{{x.Message}}</p>

                </div>
              </div>

              <div ng-if="x.EmployeeId!=''" class="box-body no-padding" style="float:right;">
                <div class="mailbox-read-info">
                  <h3>From: Employee</h3>
                  <h5><span class="mailbox-read-time">{{x.Month}} {{x.Day}}, {{x.Year}} ({{x.Time}})</span></h5>
                </div>
                <div class="mailbox-read-message">
                  <p>{{x.Message}}</p>

                </div>
              </div>
            </div>
            <form ng-submit="respond()">
              <md-input-container class="md-block">
                <label>Response</label>
                <textarea ng-model="response" md-maxlength="255" rows="5" md-select-on-focus required></textarea>
                
              </md-input-container>
              <button type="submit" class="btn createRoomType">Send Response <span class="fa fa-check"></span></button>
            </form>
        

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
app.controller('threadController', function($scope, $http, $mdDialog, SweetAlert) {

    $scope.init = function () {
      
      if($scope.inquiryId!=""){
        
        $scope.getThread();
      }
    };

    $scope.getThread = function(){
      $http.get("../queries/get/getInquiryThread.php?inquiry_id="+$scope.inquiryId).then(function (response){
            $scope.inquiry = response.data.records;
        });
    }

    $scope.respond = function(){
      $http.post('../queries/insert/insertResponse.php', {
            'message': $scope.response,
            'user_id': $scope.inquiry[0].UserId,
            'inquiry_response_id': $scope.inquiry[0].InquiryId
        }).then(function(data, status){
            $scope.getThread();
            $scope.response="";
            SweetAlert.swal("Success!", "You Responded to the Inquiry", "success");
        })
    };
});
</script>