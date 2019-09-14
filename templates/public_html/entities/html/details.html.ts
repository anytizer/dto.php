<div class="w3-container w3-teal">
	<h1>#__CLASS_NAME__ Details</h1>
</div>

<div class="details">
	#__DETAILS_FIELDS__
	
	<div>
		<a class="w3-btn w3-purple" href="#!/#__CLASS_NAME__/edit" ng-click="#__CLASS_NAME__.edit(record)">
			<i class="fa fa-pencil-square-o" aria-hidden="true"></i>
			Edit
		</a>
		<a class="w3-btn w3-purple" href="#!/#__CLASS_NAME__/delete" ng-click="#__CLASS_NAME__.delete(record)">
			<i class="fa fa-trash-o" aria-hidden="true"></i>
			Delete
		</a>
		<a class="w3-btn w3-purple" href="#" ui-sref="#__CLASS_NAME__.list({})">Back</a>
	</div>
</div>

<div ui-view=""></div>
