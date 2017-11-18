<h1>#__CLASS_NAME__ Details</h1>

<div class="details">
	#__DETAILS_FIELDS__
	
	<div>
		<a class="w3-btn w3-purple" href="#!/#__CLASS_NAME__/edit" ng-click="#__CLASS_NAME__.edit(record)">Edit</a>
		<a class="w3-btn w3-purple" href="#!/#__CLASS_NAME__/delete" ng-click="#__CLASS_NAME__.delete(record)">Delete</a>
	</div>
</div>

<div ui-view=""></div>
