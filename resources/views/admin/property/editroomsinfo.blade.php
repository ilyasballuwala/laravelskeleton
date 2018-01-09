<!-- Edit Room Info Property Admin -->
<form class="roomsinfo" name="roomsinfoForm" ng-submit="submitRoomsinfo(roomsinfoForm.$valid)" novalidate role="form" method="post" enctype="multipart/form-data">
	{{ csrf_field() }}
	<b>Rooms &amp; Price Range</b><br/><br/>
	<div class="rooms-container" data-ng-init="assignoldRoom('{{ $finalrooms }}'); assignoldHours('{{ $hoursdata }}')">
	  <div class="individual-roominfo" data-ng-repeat="roomrow in roomsinfo">
		<div class="individual-pricerange">
			<a class="remove-pricebox" href="javascript:void(0)" data-ng-click="roomsinfo.splice([$index], 1)"><i class="fa fa-times"></i></a>
			<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
				<div class="col-xs-6 col-sm-4 col-md-6 col-lg-6">
					<select name="studiocount_@{{$index}}" id="studiocount" data-ng-model="roomrow.studiocount" class="form-control countbox">
						<option value="0">Select Studio Count</option>
						<option value="1">1</option>
						<option value="2">2</option>
						<option value="3">3</option>
						<option value="4">4</option>
						<option value="5">5</option>
					</select>
				</div>
				<div class="col-xs-6 col-sm-8 col-md-6 col-lg-6">
					<select name="studiooption_@{{$index}}" id="studiooption" data-ng-model="roomrow.studiooption" class="form-control countbox">
						<option value="0">Select Studio Type</option>
						<option value="ST">Studio</option>
						<option value="STFUR">Studio Furnished</option>
						<option value="STUNFUR">Studio Unfurnished</option>
						<option value="STMS">Studio Mastersuite</option>
					</select>
				</div>
			</div>
			<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
				<div class="col-xs-6 col-sm-4 col-md-6 col-lg-6">
					<select name="bedroomcount_@{{$index}}" id="bedroomcount" data-ng-model="roomrow.bedroomcount" class="form-control countbox">
						<option value="0">Select No of Bedroom</option>
						<option value="1">1</option>
						<option value="2">2</option>
						<option value="3">3</option>
						<option value="4">4</option>
						<option value="5">5</option>
					</select>
				</div>
				<div class="col-xs-6 col-sm-8 col-md-6 col-lg-6">
					<select name="bedroomoption_@{{$index}}" id="bedroomoption" data-ng-model="roomrow.bedroomoption" class="form-control countbox">
						<option value="0">Select Bedroom Type</option>
						<option value="BD">Bedroom</option>
						<option value="BDFR">Bedroom Furnished</option>
						<option value="BDUNFUR">Bedroom Unfurnished</option>
						<option value="BDMS">Bedroom Mastersuite</option>
					</select>
				</div>
			</div>
			<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
				<div class="col-xs-6 col-sm-4 col-md-6 col-lg-6">
					<select name="bathcount_@{{$index}}" id="bathcount" data-ng-model="roomrow.bathcount" class="form-control countbox">
						<option value="0">Select No of Bath</option>
						<option value="1">1</option>
						<option value="2">2</option>
						<option value="3">3</option>
						<option value="4">4</option>
						<option value="5">5</option>
					</select>
				</div>
				<div class="col-xs-6 col-sm-8 col-md-6 col-lg-6">
					<label class="control-label">Bath</label>
				</div>
			</div>

			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 pricegroup">
				<div class="form-group col-xs-6 col-sm-4 col-md-4 col-lg-4">
				  <div class="row">
					  <label for="start_price" class="col-sm-5 control-label">Start Price($)<span class="required-mark">*</span> : </label>
					  <div class="col-sm-6">
						<input type="text" class="form-control" id="start_price" name="start_price_@{{$index}}" placeholder="Enter Start Price" data-ng-model="roomrow.start_price" numeric-digit-only required minlength="3">
					  </div>
				  </div>	
				</div>
				<div class="form-group col-xs-6 col-sm-4 col-md-4 col-lg-4">
				  <div class="row">	
					  <label for="end_price" class="col-sm-5 control-label">End Price($)<span class="required-mark">*</span> : </label>
					  <div class="col-sm-6">
						<input type="text" class="form-control" id="end_price" name="end_price_@{{$index}}" placeholder="Enter End Price" data-ng-model="roomrow.end_price" numeric-digit-only>
					  </div>
				  </div>
				</div>
			</div>
		</div>
	  </div>	
		<button name="addmore_room" data-ng-click="addNewRoom()" class="btn btn-primary pull-right addroombtn">Add New Room Information</button>
	</div>
	<hr class="room-hour-seperator">
	<div class="hours-container">
		<h3 class="property-tabheadline">Office Hours</h3>

		<table class="hours_table" id="hours_table" cellpadding="10" border="0">
			<tr>
				<th>&nbsp;</th>
				<th>Hours Range</th>
				<th>Closed</th>
			</tr>
			<tr>
				<td><label class="hours-label">Monday :</label></td>
				<td><input type="text" class="form-control" id="monday_hours" name="monday_hours" placeholder="Enter Hours" data-ng-model="property.weekhours.monday.hours" ng-disabled="property.weekhours.monday.close"></td>
				<td><div class="checkbox marginnone">
				  <label>
					<input type="checkbox" name="monday_close" id="monday_close" data-ng-model="property.weekhours.monday.close">
				  </label>
				</div></td>
			</tr>
			<tr>
				<td><label class="hours-label">Tuesday :</label></td>
				<td><input type="text" class="form-control" id="tuesday_hours" name="tuesday_hours" placeholder="Enter Hours" data-ng-model="property.weekhours.tuesday.hours" ng-disabled="property.weekhours.tuesday.close"></td>
				<td><div class="checkbox marginnone">
				  <label>
					<input type="checkbox" name="tuesday_close" id="tuesday_close" data-ng-model="property.weekhours.tuesday.close">
				  </label>
				</div></td>
			</tr>
			<tr>
				<td><label class="hours-label">Wednesday :</label></td>
				<td><input type="text" class="form-control" id="wednesday_hours" name="wednesday_hours" placeholder="Enter Hours" data-ng-model="property.weekhours.wednesday.hours" ng-disabled="property.weekhours.wednesday.close"></td>
				<td><div class="checkbox marginnone">
				  <label>
					<input type="checkbox" name="wednesday_close" id="wednesday_close" data-ng-model="property.weekhours.wednesday.close">
				  </label>
				</div></td>
			</tr>
			<tr>
				<td><label class="hours-label">Thursday :</label></td>
				<td><input type="text" class="form-control" id="thursday_hours" name="thursday_hours" placeholder="Enter Hours" data-ng-model="property.weekhours.thursday.hours" ng-disabled="property.weekhours.thursday.close"></td>
				<td><div class="checkbox marginnone">
				  <label>
					<input type="checkbox" name="thursday_close" id="thursday_close" data-ng-model="property.weekhours.thursday.close">
				  </label>
				</div></td>
			</tr>
			<tr>
				<td><label class="hours-label">Friday :</label></td>
				<td><input type="text" class="form-control" id="friday_hours" name="friday_hours" placeholder="Enter Hours" data-ng-model="property.weekhours.friday.hours" ng-disabled="property.weekhours.friday.close"></td>
				<td><div class="checkbox marginnone">
				  <label>
					<input type="checkbox" name="friday_close" id="friday_close" data-ng-model="property.weekhours.friday.close">
				  </label>
				</div></td>
			</tr>
			<tr>
				<td><label class="hours-label">Saturday :</label></td>
				<td><input type="text" class="form-control" id="saturday_hours" name="saturday_hours" placeholder="Enter Hours" data-ng-model="property.weekhours.saturday.hours" ng-disabled="property.weekhours.saturday.close"></td>
				<td><div class="checkbox marginnone">
				  <label>
					<input type="checkbox" name="saturday_close" id="saturday_close" data-ng-model="property.weekhours.saturday.close">
				  </label>
				</div></td>
			</tr>
			<tr>
				<td><label class="hours-label">Sunday :</label></td>
				<td><input type="text" class="form-control" id="sunday_hours" name="sunday_hours" placeholder="Enter Hours" data-ng-model="property.weekhours.sunday.hours" ng-disabled="property.weekhours.sunday.close"></td>
				<td><div class="checkbox marginnone">
				  <label>
					<input type="checkbox" name="sunday_close" id="sunday_close" data-ng-model="property.weekhours.sunday.close">
				  </label>
				</div></td>
			</tr>
		</table>
		<div class="row">
			<div class="col-sm-12 col-md-12 col-lg-12 pull-right">
				<div id="dataroomsave_message"></div>
			</div>
		</div>
		<div class="button-group">
			<button class="btn btn-primary mrgn-right10" type="submit" ng-disabled="roomsinfoForm.$invalid" id="saveRoominfobtn">Save</button>
			<a class="btn btn-primary" href="{{ url('admin/property') }}">Cancel</a>
		</div>
	</div>
</form>							  
<!-- /.content -->