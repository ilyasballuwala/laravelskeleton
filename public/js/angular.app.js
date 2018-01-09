//var baseurl = 'http://192.168.0.12/ec/public/';
var app = angular.module('ecApp',[])
		 .constant('API_URL',hosturl);

app.directive('input', function ($parse) {
  return {
    restrict: 'E',
    require: '?ngModel',
    link: function (scope, element, attrs) {
      if (attrs.ngModel && attrs.value) {
        $parse(attrs.ngModel).assign(scope, attrs.value);
      }
    }
  };
});

app.directive('textarea', function ($parse) {
  return {
    restrict: 'E',
    require: '?ngModel',
    link: function (scope, element, attrs) {
      if (attrs.ngModel && attrs.value) {
        $parse(attrs.ngModel).assign(scope, attrs.value);
      }
    }
  };
});

app.directive('numericOnly',function(){
    return {
        require: 'ngModel',
        link: function(scope,element,attrs,modelCtrl){
    modelCtrl.$parsers.push(function(inputValue){
                 var transformedInput = inputValue ? inputValue.replace(/[^\d-]/g,'') : null;
     if(transformedInput != inputValue){
                     modelCtrl.$setViewValue(transformedInput);
                     modelCtrl.$render();
                 }
                 return transformedInput;
             });
           }
    };
});

app.directive('numericDigitOnly',function(){
    return {
        require: 'ngModel',
        link: function(scope,element,attrs,modelCtrl){
    modelCtrl.$parsers.push(function(inputValue){
                 var transformedInput = inputValue ? inputValue.replace(/[^\d.]/g,'') : null;
     if(transformedInput != inputValue){
                     modelCtrl.$setViewValue(transformedInput);
                     modelCtrl.$render();
                 }
                 return transformedInput;
             });
           }
    };
});

app.directive('validFile',function(){
  var validFormats = ['jpg', 'gif', 'png', 'jpeg'];	
  return {
    require:'ngModel',
    link:function(scope,el,attrs,ngModel){
      //change event is fired when file is selected
      el.bind('change',function(){
        scope.$apply(function(){
		  var value = el.val(),
              ext = value.substring(value.lastIndexOf('.') + 1).toLowerCase();
		  if(validFormats.indexOf(ext) === -1){
			   ngModel.$setViewValue('');
			   el.val('');
		   }else{
			   ngModel.$setViewValue(el.val());
		   }
          ngModel.$render();
        });
      });
    }
  }
});

app.directive('validDocFile',function(){
  var validFormats = ['docx', 'doc', 'pdf'];	
  return {
    require:'ngModel',
    link:function(scope,el,attrs,ngModel){
      //change event is fired when file is selected
      el.bind('change',function(){
        scope.$apply(function(){
		  var value = el.val(),
              ext = value.substring(value.lastIndexOf('.') + 1).toLowerCase();
		  if(validFormats.indexOf(ext) === -1){
			   ngModel.$setViewValue('');
			   el.val('');
		   }else{
			   ngModel.$setViewValue(el.val());
		   }
          ngModel.$render();
        });
      });
    }
  }
});

// Admin Controller Action
	app.controller('mainController', function($scope, $http) {
	  //$scope.metatags = [];
	});

	// CMS Controller Action
	app.controller('cmsController', function($scope, $http) {
	  
	});

	// Property Controller Action
	app.controller('propertyController', function($scope, $http, $compile) {
		$scope.property = {};
		$scope.property.weekhours = {};
		$scope.property.weekhours.monday = {};
		$scope.property.generalinfo = {};
		$scope.roomsinfo = [];
		$scope.selectedAmenities = [];
		$scope.selectedFeatures = [];
		$scope.selectedFeatures = [];
		$scope.property.propertyimagesdata = {};
		$scope.propertyotherimagesdata = [];
		
		$scope.roomsinfo = [{ 
			'studiocount' : "0",
			'studiooption' : "0",
			'bedroomcount' : "0",
			'bedroomoption' : "0",
			'bathcount' : "0",
			'start_price' : "",
			'end_price' : "",
		}];
		
		$scope.propertyimagesdata = [{ 
			'property_images' : "",
		}];
		
		$scope.assignoldRoom = function(roomarray) {
			var finalrooms = JSON.parse(roomarray);
			//console.log(finalrooms);
			if(finalrooms != null && Object.keys(finalrooms).length > 0){
				$scope.roomsinfo = finalrooms;
			}
			//console.log($scope.roomsinfo);
		}
		
		$scope.assignoldHours = function(hoursarray) {
			var finalhours = JSON.parse(hoursarray);
			//console.log(finalhours);
			if(finalhours != null && Object.keys(finalhours).length > 0){
				$scope.property.weekhours = finalhours;
			}
			//console.log($scope.property.weekhours);
		}
		
		$scope.assignPropertyimages = function(imagesarray) {
			var finalimages = JSON.parse(imagesarray);
			//console.log(finalimages);
			if(finalimages != null && Object.keys(finalimages).length > 0){
				$scope.propertyotherimagesdata = finalimages;
			}
			//console.log($scope.propertyotherimagesdata);
		}
		
		$scope.addNewRoom = function() {
			$scope.roomsinfo.push({ 
				'studiocount' : "0",
				'studiooption' : "0",
				'bedroomcount' : "0",
				'bedroomoption' : "0",
				'bathcount' : "0",
				'start_price' : "",
				'end_price' : "",
			});
			//console.log($scope.roomsinfo);
		}
		
		$scope.addMoreImage = function() {
			$scope.propertyimagesdata.push({ 
				'property_images' : "",
			});
			//console.log($scope.propertyimagesdata);
		}
		
		/*$scope.removeRoominfo = function($index) {
			$scope.roomsinfo.splice($index, 1);
			//console.log($scope.roomsinfo);
		}*/
		
		$scope.numericValidation = function(ev){
		  var elementID = ev.target.id;
		  var elementVal = angular.element(document.querySelector('#'+elementID)).val();
		  if(isNaN(elementVal)){
		   elementVal = elementVal.replace(/[^0-9]/g,'');
		  }
		   angular.element(document.querySelector('#'+elementID)).val(elementVal);
		 }
		
		$scope.getCity = function(stateid){
			$http({
				url: hosturl+'/admin/property/getcity', 
				method: "POST",
				data: {stateid:stateid}
			}).then(function(response){
				//console.log(response.data);
				$scope.citydata = response.data;
				//angular.element(document.querySelector('#laundryblock')).html($compile(page)($scope));*/
				//$scope.enableContinueButton();
			},function (response){
				//$scope.throwError();
			});
		}
		
		 $scope.submitGeneralinfo = function(isValid) {

			// check to make sure the form is completely valid
			if(isValid) {
			  var generalinfo = $scope.property.generalinfo;
			  var profile_msg = '<center><div class="alert alert-info alert-dismissable"><h4>Please wait, we are saving the property data...</h4></div></center>';
   			  angular.element(document.querySelector('#datasave_message')).html($compile(profile_msg)($scope));
   			  angular.element(document.querySelector('#savePropertyinfobtn')).attr("disabled",true);
				
			   $http({
					url: hosturl+'/admin/property/savegeneralinfo', 
					method: "POST",
					data: {generalinfo:generalinfo, propertyid:$scope.property.property_id }
				}).then(function(response){
					   console.log(response.data);
					   if(response.data.status == 1){
						   var profile_msg = '<center><div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><h4>Property details saved successfully.</h4></div></center>';
						   //alert('Property Details Saved Successfully.');	
					   }
					   else{
						   var profile_msg = '<center><div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><h4>There are some problem occcured in save the details.</h4></div></center>';
					   }
				   	   angular.element(document.querySelector('#datasave_message')).html($compile(profile_msg)($scope));
					   angular.element(document.querySelector('#savePropertyinfobtn')).attr("disabled",false);	
				},function (response){
					$scope.throwError();
				    var profile_msg = '<center><div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><h4>There are some problem occcured in save the details.</h4></div></center>';
				    angular.element(document.querySelector('#datasave_message')).html($compile(profile_msg)($scope));
				    angular.element(document.querySelector('#savePropertyinfobtn')).attr("disabled",false);
				});	
			}
		  };
		  
		$scope.submitRoomsinfo = function(isValid) {

			// check to make sure the form is completely valid
			if(isValid) {
			  var roomsinfo = $scope.roomsinfo;
			  var hoursinfo = $scope.property.weekhours;
			  //console.log($scope.property.weekhours);
			  var profile_msg = '<center><div class="alert alert-info alert-dismissable"><h4>Please wait, we are saving the property data...</h4></div></center>';
   			  angular.element(document.querySelector('#dataroomsave_message')).html($compile(profile_msg)($scope));
   			  angular.element(document.querySelector('#saveRoominfobtn')).attr("disabled",true);
				
			   $http({
					url: hosturl+'/admin/property/saveroomsinfo', 
					method: "POST",
					data: {roomsinfo:roomsinfo, hoursinfo:hoursinfo, propertyid:$scope.property.property_id }
				}).then(function(response){
					   /*console.log(response.data);
				   	   return false;*/
					   if(response.data.status == 1){
						   var profile_msg = '<center><div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><h4>Property details saved successfully.</h4></div></center>';
						   //alert('Property Details Saved Successfully.');	
					   }
					   else{
						   var profile_msg = '<center><div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><h4>There are some problem occcured in save the details.</h4></div></center>';
					   }
				   	   angular.element(document.querySelector('#dataroomsave_message')).html($compile(profile_msg)($scope));
					   angular.element(document.querySelector('#saveRoominfobtn')).attr("disabled",false);	
				},function (response){
					//$scope.throwError();
				    var profile_msg = '<center><div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><h4>There are some problem occcured in save the details.</h4></div></center>';
				    angular.element(document.querySelector('#dataroomsave_message')).html($compile(profile_msg)($scope));
				    angular.element(document.querySelector('#saveRoominfobtn')).attr("disabled",false);
				});	
			}
		  };
		  
		  $scope.amenitiesdata = [];
		  $scope.submitAmenitiesinfo = function(isValid) {
			  
			if(isValid) {
			  var amenitiesinfo = $scope.selectedAmenities;
			  var featuresinfo = $scope.selectedFeatures;
			  
			  if((Object.keys(amenitiesinfo).length > 0) && (Object.keys(featuresinfo).length > 0))
			  {
				  /*console.log(amenitiesinfo);
				  console.log(featuresinfo);
				  return false;*/
				  
				  var profile_msg = '<center><div class="alert alert-info alert-dismissable"><h4>Please wait, we are saving the property data...</h4></div></center>';
				  angular.element(document.querySelector('#dataamenitiessave_message')).html($compile(profile_msg)($scope));
				  angular.element(document.querySelector('#saveAmenitiesinfobtn')).attr("disabled",true);

				   $http({
						url: hosturl+'/admin/property/saveamenitiesinfo', 
						method: "POST",
						data: {amenitiesinfo:amenitiesinfo, featuresinfo:featuresinfo, propertyid:$scope.property.property_id }
					}).then(function(response){
						   /*console.log(response.data);
						   return false;*/
						   if(response.data.status == 1){
							   var profile_msg = '<center><div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><h4>Property details saved successfully.</h4></div></center>';
							   //alert('Property Details Saved Successfully.');	
						   }
						   else{
							   var profile_msg = '<center><div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><h4>There are some problem occcured in save the details.</h4></div></center>';
						   }
						   angular.element(document.querySelector('#dataamenitiessave_message')).html($compile(profile_msg)($scope));
						   angular.element(document.querySelector('#saveAmenitiesinfobtn')).attr("disabled",false);	
					},function (response){
						//$scope.throwError();
						var profile_msg = '<center><div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><h4>There are some problem occcured in save the details.</h4></div></center>';
						angular.element(document.querySelector('#dataamenitiessave_message')).html($compile(profile_msg)($scope));
						angular.element(document.querySelector('#saveAmenitiesinfobtn')).attr("disabled",false);
					});	
			  }
			}
		  };
		  
		  $scope.selectedAmenities = [];
		  $scope.selectedFeatures = [];
		  
		 $scope.assignAmenitesandFeatures = function(amenities,features){
			  if(Object.keys(amenities).length > 0){
				  $scope.selectedAmenities = JSON.parse(amenities);
			  }
			  if(Object.keys(features).length > 0){
				 $scope.selectedFeatures = JSON.parse(features);
			  }
		  }
		  	
	      $scope.checkamenityandfeatyure = function(){
			  if((Object.keys($scope.selectedAmenities).length > 0) && (Object.keys($scope.selectedFeatures).length > 0)){
				  return true;
			  }
			  else{
				  return false;
			  }
		  }
		  
		  $scope.isAmenitieshave = function(id){
			 var match = false;
			   for(var i = 0;i < $scope.selectedAmenities.length;i++){
				 if($scope.selectedAmenities[i] == id){
					match = true;
				 }
			   }
			   return match;
		  }
		  $scope.isFeatureshave = function(id){
			 var match = false;
			   for(var i = 0;i < $scope.selectedFeatures.length;i++){
				 if($scope.selectedFeatures[i] == id){
					match = true;
				 }
			   }
			   return match;
		  }
		  
		  $scope.saveAmenities = function(bool,item){
		  	if(bool){
				// add item
				$scope.selectedAmenities.push(item);
			}else{
				// remove item
				for(var j = 0;j < $scope.selectedAmenities.length;j++){
					if($scope.selectedAmenities[j] == item){
						$scope.selectedAmenities.splice(j,1);
					}
				}      
			 }
			 //console.log($scope.selectedAmenities); 
		   }
		  $scope.saveFeatures = function(bool,item){
		  	if(bool){
				// add item
				$scope.selectedFeatures.push(item);
			}else{
				// remove item
				for(var j = 0;j < $scope.selectedFeatures.length;j++){
					if($scope.selectedFeatures[j] == item){
						$scope.selectedFeatures.splice(j,1);
					}
				}      
			 }
			 //console.log($scope.selectedFeatures); 
		   }
		   $scope.submitSeoinfo = function(isValid) {

			// check to make sure the form is completely valid
			if(isValid) {
			  var seoinfo = $scope.property.seoinfo;
			  var profile_msg = '<center><div class="alert alert-info alert-dismissable"><h4>Please wait, we are saving the property data...</h4></div></center>';
   			  angular.element(document.querySelector('#dataseosave_message')).html($compile(profile_msg)($scope));
   			  angular.element(document.querySelector('#savePropertyseoinfobtn')).attr("disabled",true);
				
			   $http({
					url: hosturl+'/admin/property/saveseoinfo', 
					method: "POST",
					data: {seoinfo:seoinfo, propertyid:$scope.property.property_id }
				}).then(function(response){
					   //console.log(response.data);
					   if(response.data.status == 1){
						   var profile_msg = '<center><div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><h4>Property details saved successfully.</h4></div></center>';
						   //alert('Property Details Saved Successfully.');	
					   }
					   else{
						   var profile_msg = '<center><div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><h4>There are some problem occcured in save the details.</h4></div></center>';
					   }
				   	   angular.element(document.querySelector('#dataseosave_message')).html($compile(profile_msg)($scope));
					   angular.element(document.querySelector('#savePropertyseoinfobtn')).attr("disabled",false);	
				},function (response){
					//$scope.throwError();
				    var profile_msg = '<center><div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><h4>There are some problem occcured in save the details.</h4></div></center>';
				    angular.element(document.querySelector('#dataseosave_message')).html($compile(profile_msg)($scope));
				    angular.element(document.querySelector('#savePropertyseoinfobtn')).attr("disabled",false);
				});	
			}
		  };
		
		$scope.files = [];
		$scope.logofiles = [];
		$scope.multiplefiles = [];
		$scope.property.images = [];
		$scope.property_document = [];
		//$scope.property.images.source = null;
		
		$scope.submitImagesinfo = function(isValid) {
			// check to make sure the form is completely valid
			if(isValid) {	
			  
			  $scope.property.images.property_mainimage = (Object.keys($scope.files).length > 0) ? $scope.files[0] : null;
			  $scope.property.images.property_logoimage = (Object.keys($scope.logofiles).length > 0) ? $scope.logofiles[0] : null;
			  $scope.property.property_document = (Object.keys($scope.property_document).length > 0) ? $scope.property_document[0] : null;
				
			  if((Object.keys($scope.files).length > 0) || (Object.keys($scope.logofiles).length > 0) || (Object.keys($scope.multiplefiles).length > 0) || (Object.keys($scope.property_document).length > 0)){
				  var profile_msg = '<center><div class="alert alert-info alert-dismissable"><h4>Please wait, we are saving the property data...</h4></div></center>';
   			  	  angular.element(document.querySelector('#dataimagessave_message')).html($compile(profile_msg)($scope));
   			  	  angular.element(document.querySelector('#savePropertyimageinfobtn')).attr("disabled",true);
				  
				  var formData = new FormData();
				  formData.append("mainimage", $scope.property.images.property_mainimage);
				  formData.append("logoimage", $scope.property.images.property_logoimage);
				  formData.append("propertydocument", $scope.property.property_document);
				  for (var i in $scope.multiplefiles) {
					  formData.append("multipleimages[]", $scope.multiplefiles[i]);	
				  }	
				  formData.append("propertyid", $scope.property.property_id);
				  //return formData;

				   $http({
						url: hosturl+'/admin/property/savepropertyimages', 
						method: "POST",
						processData: false,
						transformRequest: angular.identity,
						data : formData,
						headers: {
						 'Content-Type': undefined
						},
					}).then(function(response){
						   //console.log(response.data);
							//return false;
						   if(response.data.status == 1){
							   $scope.files = [];
							   $scope.logofiles = [];
							   $scope.property_document = [];
							   $scope.property.images.property_mainimage = '';
							   $scope.property.images.property_logoimage = '';
							   $scope.property.property_document = '';
							   angular.element("input[name='property_mainimage']").val(null);
							   angular.element("input[name='property_logoimage']").val(null);
							   angular.element("input[name='property_document']").val(null);
							   $scope.multiplefiles = [];
							   $scope.propertyimagesdata = [{ 
									'property_images' : "",
							   }];
							   $scope.property.mainimagesrc = $scope.property.mainimagesrc + '?decache=' + new Date().getTime();
							   $scope.property.logoimagesrc = $scope.property.logoimagesrc + '?decache=' + new Date().getTime();
							   if(response.data.imagesdata != ''){
								   $scope.propertyotherimagesdata = response.data.imagesdata;
							   }
							   if(response.data.newdocpath != ''){
								   $scope.property.documentlink = response.data.newdocpath;
							   }
							   
							   var profile_msg = '<center><div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><h4>Property details saved successfully.</h4></div></center>';
							   //alert('Property Details Saved Successfully.');	
						   }
						   else{
							   var profile_msg = '<center><div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><h4>There are some problem occcured in save the details.</h4></div></center>';
						   }
						   angular.element(document.querySelector('#dataimagessave_message')).html($compile(profile_msg)($scope));
						   angular.element(document.querySelector('#savePropertyimageinfobtn')).attr("disabled",false);	
					},function (response){
						//$scope.throwError();
						var profile_msg = '<center><div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><h4>There are some problem occcured in save the details.</h4></div></center>';
						angular.element(document.querySelector('#dataimagessave_message')).html($compile(profile_msg)($scope));
						angular.element(document.querySelector('#savePropertyimageinfobtn')).attr("disabled",false);
					});	
			   }
			  
			}
		  };
		
		 $scope.uploadedFile = function(element) {
			 $scope.$apply(function($scope) {
				$scope.files = element.files;
			 });
		    //$scope.currentFile = element.files[0];
		    //var reader = new FileReader();
		    /*reader.onload = function(event) {
		      $scope.image_source = event.target.result
		      
		    }*/
            //reader.readAsDataURL(element.files[0]);
			 //console.log($scope.files);
		  }
		 
		 $scope.uploadeLogoFile = function(element) {
			 $scope.$apply(function($scope) {
				$scope.logofiles = element.files;
			 });
		  }
		  
		 $scope.uploadDocumentFile = function(element) {
			 $scope.$apply(function($scope) {
				$scope.property_document = element.files;
			 });
			 //console.log($scope.property_document);
		  }
		 
		 $scope.uploadeMultipleFile = function(element) {
			 $scope.$apply(function($scope) {
				$scope.multiplefiles.push(element.files[0]);
			 });
			 //console.log($scope.multiplefiles);
		 }
		 
		 $scope.removeMultipleFile = function(index) {
			 if(Object.keys($scope.propertyimagesdata).length > 1){
				$scope.multiplefiles.splice(index,1);
			 	$scope.propertyimagesdata.splice(index, 1); 
			 }
			 //console.log($scope.multiplefiles);
		 }
		 
		 $scope.removePropertyimage = function(index,propertyimageid) {
			 
			 var confirmstatus = confirm("Are you sure you want to delete this image?");
			 
			 if(confirmstatus){
				    $http({
						url: hosturl+'/admin/property/deletepropertyimage', 
						method: "POST",
						data: {propertyimageid:propertyimageid, propertyid:$scope.property.property_id }
					}).then(function(response){
						   console.log(response.data);
						   if(response.data.status == 1){
							   var profile_msg = '<center><div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><h4>Property image deleted successfully.</h4></div></center>';
							   $scope.propertyotherimagesdata.splice(index,1);
						   }
						   else{
							   var profile_msg = '<center><div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><h4>There are some problem occcured in delete image.</h4></div></center>';
						   }
						   angular.element(document.querySelector('#dataimagessave_message')).html($compile(profile_msg)($scope));	
					},function (response){
						//$scope.throwError();
						var profile_msg = '<center><div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><h4>There are some problem occcured in delete image.</h4></div></center>';
						angular.element(document.querySelector('#dataimagessave_message')).html($compile(profile_msg)($scope));
					});
			 }
			   
			 //console.log($scope.multiplefiles);
		 }
		 
		 
	});