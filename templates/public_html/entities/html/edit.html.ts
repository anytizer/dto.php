<div class="w3-container w3-teal entity-action">
	<h2>
		<span class="disabled"><i class="fas fa-book"></i> Edit</span>
		<span class="no-print">| <a class="enabled" href="#" ui-sref="#__CLASS_NAME__.List({})"><i class="fas fa-list"></i> List</a></span>
	</h2>
</div>

<div>
<form name="edit-#__CLASS_NAME__" class="edit edit-#__CLASS_NAME__">

	<div class="w3-card-4 w3-margin">
		#__EDIT_FIELDS__
	</div>
	<div class="w3-card-4 w3-margin w3-padding">
		<a href="#" class="w3-btn w3-teal" ng-click="#__CLASS_NAME__.Edit(#__CLASS_NAME__.record)">
			<i class="fa fa-pencil-square-o"></i>
			Edit
		</a>
		<a href="#" ui-sref="#__CLASS_NAME__.List()">
			<i class="fa fa-list"></i>
			Cancel
		</a>
	</div>

</form>
</div>

<!--{{#__CLASS_NAME__.record}}-->

<script type="text/javascript">reinstall_resources();</script>

<div ui-view=""></div>
