<h1>List #__CLASS_NAME__</h1>

<table class="list">
    <thead>
		<tr>
			<th>SN</th>
			#__COLUMN_NAMES__
			<th>Edit</th>
		</tr>
    </thead>
    <tbody>
		<tr ng-repeat="(r, record) in records">
			<td>
				{{r+1}}
			</td>
			#__LISTED_ROWS__
			<td><a href="#!{{#__CLASS_NAME__}}/edit/:{{record.id}}">Edit</a></td>
		</tr>
    </tbody>
</table>

<div ui-view=""></div>