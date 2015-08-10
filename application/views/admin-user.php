
		<div class="manager-title">
			<p>Manage User Information</p>
		</div>

		<div class="search-user">
			<input type="text/css" id="search-user" placeholder="fuzzy search with username or email">
			<span id="search-submit" onclick="search()">Search</span>
		</div>
		<div class="manager-table">
			<!-- Table goes in the document BODY -->
			<table class="altrowstable" id="alternatecolor">
			<tr>
			    <th>User ID</th>
			    <th>Username</th>
			    <th>User E-mail</th>
			    <th>User Password</th>
			    <th>Operation</th>
			</tr>
			<?php 
			if ($all_user) {
				foreach($all_user as $user) { ?>
					<tr>
			    		<td><?php echo $user['id']; ?></td>
			    		<td><?php echo $user['name']; ?></td>
			    		<td><?php echo $user['email']; ?></td>
			    		<td><?php echo $user['pw']; ?></td>
			    		<td><span id="edit" onclick="editUser(this)">Edit</span>&nbsp&nbsp&nbsp<span id="delete" onclick="deleteUser(this)">Delete</span></td>
			    		<td style="display: none;"><span id="edit-confirm" onclick="confirmUser(this)">Confirm Edit</span></td>
			    		<td style="display: none;"><span id="delete-confirm" onclick="deleteConfirmUser(this)">Confirm Delete</span></td>
			    		<td style="display: none;"><span id="cancel-confirm" onclick="cancel(this)">cancel</span></td>
			    	</tr>
			<?php }	} ?>
			</table>
		</div>

		<div class="paginator">

				<div id="prev-page" onclick="setPrevPage(this)">prev</div>
				<div id="page-num"><?php echo $page;?>/<?php echo $page_num;?></div>
				<div id="next-page" onclick="setNextPage(this)">next</div>
				<div style="clear:both;" ></div>

		<div>

		
	
