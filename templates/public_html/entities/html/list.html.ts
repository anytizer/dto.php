<div class="w3-container w3-teal entity-action">
	<h2>List | <a ui-sref="#__CLASS_NAME__.Add({})">Add</a>
	</h2>
</div>

<table class="list">
    <thead>
		<tr>
			<th>SN</th>
			#__COLUMN_NAMES__
			<th>Details</th>
			<th>Edit</th>
		</tr>
    </thead>
    <tbody>
		<tr ng-repeat="(r, record) in #__CLASS_NAME__.records">
			<td>{{r+1}}</td>
			#__LISTED_ROWS__
			<td><a href="#" ui-sref="#__CLASS_NAME__.Details({'#__PRIMARY_KEY__': record.#__PRIMARY_KEY__})">Details</a></td>
			<td><a href="#" ui-sref="#__CLASS_NAME__.Edit({'#__PRIMARY_KEY__': record.#__PRIMARY_KEY__})">Edit</a></td>
		</tr>
    </tbody>
</table>

<div ui-view=""></div>
