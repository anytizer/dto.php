<!--
<div class="w3-container w3-teal entity-action">
	<h2>
		<span href="#" class="disabled"><i class="fas fa-book"></i> Add</span>
		<span class="no-print">| <a class="enabled" href="#" ui-sref="#__CLASS_NAME__.List({})"><i class="fas fa-list"></i> List</a></span>
	</h2>
</div>
-->

<div>
<form name="add-#__CLASS_NAME__" class="add add-#__CLASS_NAME__">

	<div class="w3-card-4 w3-margin">
		#__ADD_FIELDS__
	</div>

	<div class="w3-card-4 w3-margin w3-padding">

		<a href="#" class="w3-btn w3-teal" ng-click="#__CLASS_NAME__.add(record)">
			<i class="fa fa-plus"></i>
			Add
		</a>

		<a href="#" ui-sref="#__CLASS_NAME__.List({})">
			<i class="fa fa-list"></i>
			Cancel
		</a>
	</div>
</form>
</div>

<!--{{record}}-->

<script type="text/javascript">reinstall_resources();</script>

<div ui-view=""></div>
