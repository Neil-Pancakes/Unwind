<?php
require ("../header.php");
include '../sidebar.php';
?>
 <!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <section class="content" ng-app="unwindApp">
    <div ng-cloak ng-controller="employeeController" data-ng-init="init()">
      <md-content>
        <md-tabs md-dynamic-height md-border-bottom class="md-no-animation">
          <md-tab label="Employee List">
            <md-content>  
                <md-list-item class="md-3-line rrList" ng-repeat="x in employee">
                    <div id="rrListDiv">
                        <span class="employeeName">{{x.Name}}</span>
                        <span>({{x.Position}})</span>
                        <div>
                            <img src="{{x.Picture}}" class="logoPic">
                        </div>
                        <div id="employeeDetails">
                            <div>
                                {{x.Email}}
                            </div>
                            <div>
                                {{x.Birthdate}}
                            </div>
                            <div>
                                {{x.Gender}}
                            </div>
                            <div>
                                {{x.ContactNo}}
                            </div>
                        </div>
                    </div>       
                </md-list-item>
            </md-content>
          </md-tab>
          <md-tab label="Add Employee">
            <md-content class="md-padding" layout-xs="column" layout="row">
                <div id="createEmployee">
                    <div>
                        <form ng-submit="createEmployee()">
                            <div>
                                <div>
                                    <md-input-container>
                                        <label>First Name</label>
                                        <input type="text" class="form-control" ng-model="firstName" required>
                                    </md-input-container>
                                    <md-input-container>
                                        <label>Middle Initial</label>
                                        <input type="text" class="form-control" max-length="1" ng-model="middleInitial" required>
                                    </md-input-container>
                                    <md-input-container>
                                        <label>Last Name</label>
                                        <input type="text" class="form-control" ng-model="lastName" required>
                                    </md-input-container>

                                    <md-input-container>
                                        <label>Position</label>
                                        <input type="text" class="form-control" ng-model="position" required>
                                    </md-input-container>

                                    <md-input-container>
                                        <label>Email</label>
                                        <input type="text" class="form-control" ng-model="email" required>
                                    </md-input-container>
                                    
                                    <md-input-container>
                                        <label>Number</label>
                                        <input type="number" class="form-control" ng-model="contactNo" required>
                                    </md-input-container>
                                    <br>
                                    <md-input-container>
                                        <label>Gender</label>
                                        <md-select ng-model="gender">
                                            <md-option>Male</md-option>
                                            <md-option>Female</md-option>
                                        </md-select>
                                    </md-input-container>
                                    <br>
                                    <label>Picture</label>
                                    <input type="file" file-model="myFile"/>
                                    <input type="text" ng-model="picture" ng-hide="true"></input>
                                    <br>
                                    <br>
                                    <md-datepicker ng-model="birthDate" md-placeholder="Birth date" required></md-datepicker>
                                    <br>
                                </div>
                            </div>
                            <md-button type="submit" class="md-raised md-primary">Create Employee <span class="fa fa-check"></span></button>
                        </form>
                    </div>
                </div>
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
var active = angular.element( document.querySelector( '#employeeTab' ) );
active.addClass('active');

var app = angular.module('unwindApp', ['ngMaterial', 'oitozero.ngSweetAlert', 'chieffancypants.loadingBar', 'ngAnimate']);
app.config(function(cfpLoadingBarProvider) {
    cfpLoadingBarProvider.includeSpinner = true;
  })

app.directive('fileModel', ['$parse', function ($parse) {
    return {
        restrict: 'A',
        link: function(scope, element, attrs) {
            var model = $parse(attrs.fileModel);
            var modelSetter = model.assign;
            
            element.bind('change', function(){
                scope.$apply(function(){
                    modelSetter(scope, element[0].files[0]);
                });
            });
        }
    };
}]);

app.service('fileUpload', ['$http', function ($http) {
    this.uploadFileAndFieldsToUrl = function(file, fields, uploadUrl){
        var fd = new FormData();
        fd.append('file', file);
        for(var i = 0; i < fields.length; i++){
            fd.append(fields[i].name, fields[i].data)
        }
        $http.post(uploadUrl, fd, {
            transformRequest: angular.identity,
            headers: {'Content-Type': undefined}
        });
    }
}]);


app.controller('employeeController', function($scope, $http, $mdDialog, SweetAlert) {
   
    $scope.$watch('myFile', function(newFileObj){
        if(newFileObj){
            $scope.picture = newFileObj.name; 
        }
    });

    $scope.uploadForm = function(){
        var file = $scope.myFile;
        var uploadUrl = "http://localhost/Unwind/includes/img/";
        var fields = [{"name": "picture", "data": $scope.picture}];
        fileUpload.uploadFileAndFieldsToUrl(file, fields, uploadUrl);
    };

    $scope.init = function () {
        $http.get("../queries/get/getEmployee.php").then(function (response) {
           $scope.employee = response.data.records;
        });
    };

    $scope.createEmployee = function(){
        $scope.uploadForm();
        $http.post('../queries/insert/insertEmployee.php', {
            'firstName': $scope.firstName,
            'lastName': $scope.lastName,
            'mi': $scope.middleInitial,
            'position': $scope.position,
            'email': $scope.email,
            'contactNo': $scope.contactNo,
            'birthDate': moment($scope.birthDate).format('YYYY-MM-DD'),
            'gender': $scope.gender,
            'picture': $scope.picture  
        }).then(function(data, status){
            $scope.init();
        })
    };
});
</script>
