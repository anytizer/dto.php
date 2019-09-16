<div class="w3-container w3-teal entity-action">
	<h2>Add <!-- #__CLASS_NAME__ --></h2>
</div>

<div>
<form name="add-#__CLASS_NAME__" class="add add-#__CLASS_NAME__">

	#__ADD_FIELDS__

	<a href="#" class="w3-btn w3-purple" ng-click="#__CLASS_NAME__.add(record)">
		<i class="fa fa-plus" aria-hidden="true"></i>
		Add
	</a>

	<a href="#" ui-sref="#__CLASS_NAME__.list({})">
		<i class="fa fa-list" aria-hidden="true"></i>
		Cancel
	</a>

</form>
</div>

{{record}}

<script type="text/javascript">reinstall_resources();</script>

<div ui-view=""></div>
