<div class="w3-container w3-teal entity-action">
	<h2>
		<span class="disabled"><i class="fas fa-list"></i> List</span>
		<span class="no-print">| <a class="enabled" ui-sref="#__CLASS_NAME__.Add({})"><i class="fas fa-plus"></i> Add</a></span>
	</h2>
</div>

<!-- w3-hoverable -->
<table class="w3-table w3-bordered w3-striped w3-border list">
	<tbody class="no-print">
		<tr class="w3-brown">
			<td><i class="fas fa-search w3-text-green"></i></td>
			#__COLUMN_NAMES_QUICKIES__
			<td><span class="w3-btn w3-yellow" ng-click="quickies={}"><i class="fas fa-times"></i></span></td>
			<td>&nbsp;</td>
		</tr>
	</tbody>
    <thead>
		<tr class="w3-pale-blue">
			<th>S.N.</th>
			#__COLUMN_NAMES__
			<th class="no-print">&nbsp;</th>
			<th class="no-print">&nbsp;</th>
		</tr>
    </thead>
    <tbody>
		<tr ng-repeat="(r, record) in #__CLASS_NAME__.records|filter:quickies">
			<td>{{r+1}}</td>
			#__LISTED_ROWS__
			<td class="no-print"><a class="action" href="#" ui-sref="#__CLASS_NAME__.Details({'#__PRIMARY_KEY__': record.#__PRIMARY_KEY__})">Details</a></td>
			<td class="no-print"><a class="action" href="#" ui-sref="#__CLASS_NAME__.Edit({'#__PRIMARY_KEY__': record.#__PRIMARY_KEY__})">Edit</a></td>
		</tr>
    </tbody>
</table>

<div ui-view=""></div>
