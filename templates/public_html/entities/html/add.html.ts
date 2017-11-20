<h1>Add #__CLASS_NAME__</h1>

<div>
<form name="add-#__CLASS_NAME__" class="add add-#__CLASS_NAME__">

	#__ADD_FIELDS__

	<a href="#" class="w3-btn w3-purple" ng-click="#__CLASS_NAME__.add(record)">
		<i class="fa fa-plus" aria-hidden="true"></i>
		Add
	</a>
</form>
</div>

{{record}}

<script type="text/javascript">reinstall_resources();</script>

<div ui-view=""></div>