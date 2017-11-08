<?php
require ("../header.php");
include '../sidebar.php';
?>
 <!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
  <section class="content" ng-app="unwindApp">
    <div ng-cloak ng-controller="floorController">
      <md-content>
        <md-tabs md-dynamic-height md-border-bottom>
          <md-tab label="1st floor">
            <md-content>
            </md-content>
          </md-tab>

          <md-tab label="2nd floor">
            <md-content>
            </md-content>
          </md-tab>

          <md-tab label="3rd floor">
            <md-content>
            </md-content> 
          </md-tab>

          <md-tab label="4th floor">
            <md-content>
            </md-content> 
          </md-tab>

          <md-tab label="5th floor">
            <md-content>
            </md-content> 
          </md-tab>

          <!--Weird bug with last tab-->
          <md-tab ng-hide="true"></md-tab>

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
var app = angular.module('unwindApp', ['ngMaterial']);
app.controller('floorController', function($scope) {});
</script>