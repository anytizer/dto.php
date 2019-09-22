<div class="w3-container w3-teal entity-action">
	<h2>
		<span class="disabled" href="#"><i class="fas fa-book-open"></i> Details</span>
		<span class="no-print">| <a class="enabled" href="#" ui-sref="#__CLASS_NAME__.List({})"><i class="fas fa-list"></i> List</a></span>
	</h2>
</div>

<div class="details">

	<div class="w3-card-4 w3-margin w3-padding">
		#__DETAILS_FIELDS__
	</div>
	<div class="w3-card-4 w3-margin w3-padding">
		<!-- Flag -->
		<span class="w3-btn w3-teal" ng-click="#__CLASS_NAME__.Flag(#__CLASS_NAME__.record)">
			<i class="fa fa-flag"></i>
			Flag
		</span>

		<!-- Edit -->
		<a class="w3-btn w3-teal" href="#" ui-sref="#__CLASS_NAME__.Edit({'#__PRIMARY_KEY__': #__CLASS_NAME__.record.#__PRIMARY_KEY__})">
			<i class="fa fa-pencil-square-o"></i>
			Edit
		</a>

		<!-- Delete -->
		<a class="w3-btn w3-red" href="#" ng-click="#__CLASS_NAME__.Delete(#__CLASS_NAME__.record)">
			<i class="fa fa-trash-o"></i>
			Delete
		</a>

		<!-- Cancel -->
		<a href="#" ui-sref="#__CLASS_NAME__.List">
			<i class="fas fa-list"></i>
			Cancel
		</a>
	</div>
</div>

<div ui-view=""></div>
