<h1>List #__CLASS_NAME__</h1>

<table>
    <thead>
		<tr>
			<th>??</th>
			#__COLUMN_NAMES__
		</tr>
    </thead>
    <tbody>
		<tr ng-repeat="record in records">
			<td>
				??
			</td>
			#__LISTED_ROWS__
		</tr>
    </tbody>
</table>

<div ui-view=""></div>