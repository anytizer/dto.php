<h1>Edit #__CLASS_NAME__</h1>

<div>
<form name="edit-#__CLASS_NAME__" class="edit edit-#__CLASS_NAME__">
	#__EDIT_FIELDS__

	<a href="#" class="w3-btn w3-purple" ng-click="#__CLASS_NAME__.edit(record)">
		<i class="fa fa-pencil-square-o" aria-hidden="true"></i>
		Edit
	</a>
</form>
</div>

{{record}}

<script type="text/javascript">reinstall_resources();</script>

<div ui-view=""></div>