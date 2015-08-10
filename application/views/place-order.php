	<div class="add-item-layer dont-display">

	</div>
	<div class="choose-item-img dont-display">
		<?php echo form_open_multipart('item/uploadItemImg', array('method' => 'post', 'id' => 'img-upload-form'));?>
			<input type="file" name="userfile" size="20"/>
			<br/>
			<input type="submit" value="upload"/>

		</form>
		<button id="cancle-upload-addchange" onclick="cancleAddChange(this)">Cancel</button>
	</div>

	<div class="add-item-img dont-display">
		<?php echo form_open_multipart('item/addChangeItemImg', array('method' => 'post', 'id' => 'img-add-form'));?>
			<input type="file" name="userfile" size="20" />
			<input type="hidden" name="sn"/>
			<br/>
			<input type="submit" value="upload"/>
		</form>
		<button id="cancle-upload-addchange" onclick="cancleAddChange(this)">Cancel</button>
	</div>


	<div class="order-status-header">
		<p><strong>Add New Event to Your Order</strong></p>
		<h4>You are viewing the most frequently ordered items</h4>
	</div>

	<div class="order-search-panel">
		<div class="search-by-field">
			<ul>
				<li><strong>Keyword&nbsp</strong></li>
				<li><input type="text" name="keyword" id="keyword" placeholder="keyword"/></li>
				<li><input type="button" onclick="showAvailableItem(this)" value="Search"/></li>
				<li><input type="button" onclick="addNewItem(this)" value="Add New Item" id="add-new-item"/></li>
			</ul>
		</div>
	</div>

	<div class="order-search-panel">
		<span><p>New Item</p></span>
		<span><p>All Item</p></span>
		<div style="clear: both;"></div>
	</div>



	<div class="table-content">
		<div class="order-table-title">
			<p><strong>The Item You Search</strong></p>
		</div>
		<div class="order-table">
			<table class="altrowstable" id="alternatecolor">
				<tr id="itemlist-header">
					<th>Add/change Image</th>
					<th>Image</th>
				    <th>Stock Number</th>
				    <th>Description</th>
				    <th>Avail Qty</th>
				    <th>Backorder Qty</th>
				</tr>
				<?php 
				if ($items) {
					foreach ($items as $item) { ?>
				<tr alt="pencil">
					<td><button id="item-change-img" onclick="changeImg(this)">Add/Change</button></td>
					<?php 
					$opts = array(
							'http' => array (
									'timeout' => 3,
								)
						);

					$context = stream_context_create($opts);
					$resource = @file_get_contents(base_url()."static/images/item-images/" . $item['stock_number'] . ".jpg", false, $context);
					if ($resource) { ?>
					<td><img src="<?php echo base_url();?>static/images/item-images/<?php echo $item['stock_number'] . '.jpg' ?>" height="128px" width="128px"></td>
				    <?php } else { ?>
				    <td><img src="<?php echo base_url();?>static/images/no-img.png" height="128px" width="128px"></td>
				    <?php } ?>

				    <td><?php echo $item['stock_number']; ?></td>
				    <td><?php echo $item['description']; ?></td>
				    <td><?php echo $item['avail_qty']; ?></td>
				   	<td><?php echo $item['backorder_qty']; ?></td>
				</tr>
				<?php } }?>
				
			</table>
		</div>

		
	</div>

	<div class="paginator">

		<div id="prev-page">prev</div>
		<div id="page-num">1/1</div>
		<div id="next-page">next</div>
		<div style="clear:both;" ></div>

	<div>
	<script>
		$( document ).ready(function() {
		    if(document.getElementsByTagName){  
        
		        var table = document.getElementById("alternatecolor");  
		        var rows = table.getElementsByTagName("tr"); 
		         
		        for(i = 0; i < rows.length; i++){          
		            if(i % 2 == 0){
		                rows[i].className = "evenrowcolor";
		            }else{
		                rows[i].className = "oddrowcolor";
		            }      
		        }
		    }
		});

		$('#img-upload-form').submit(function() {
				
				 $.ajax({
			           type: "POST",
			           url: "http://localhost/~maydaygjf/AdlerOrdering/index.php/item/uploadItemImg",
			           // data: $("#img-upload-form").serialize(), // serializes the form's elements.
			           data: new FormData(this),
			           processData: false,
			           contentType: false,
			           success: function(data)
			           {
			               // alert(data); // show response from the php script.
			               $('.choose-item-img').toggleClass('dont-display');
			               $('#new-item-img-show').find('img').attr('src', 'http://localhost/~maydaygjf/AdlerOrdering/static/images/item-images/tmp.jpg');
			           }
			         });
			    return false; // avoid to execute the actual submit of the form.
			});

		$('#img-add-form').submit(function() {
				
				 $.ajax({
			           type: "POST",
			           url: "http://localhost/~maydaygjf/AdlerOrdering/index.php/item/addChangeItemImg",
			           data: new FormData(this),
			           processData: false,
			           contentType: false,
			           success: function(data)
			           {
			           		// alert("here");
			               	// alert(data); // show response from the php script.
			               	$('.add-item-img').toggleClass('dont-display');
			               	// $('#new-item-img-show').find('img').attr('src', 'http://localhost/~maydaygjf/AdlerOrdering/static/images/item-images/tmp.jpg');
			           }
			         });
			    return false; // avoid to execute the actual submit of the form.
			});

	</script>