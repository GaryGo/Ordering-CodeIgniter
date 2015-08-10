	<div class="order-status-header">
		<p><strong>Track Order for XXXXXX</strong></p>
		<h4>Look up and Track Orders (placed within last six months)</h4>
	</div>

	<div class="order-search-panel">
		<div class="search-by-field">
			<ul>
				<li><strong>Search with time&nbsp</strong></li>
				<li><input type="date" name="from_date" id="from-date"/></li>
				<li><input type="date" name="today_date" id="to-date"/></li>
				<li><input type="button" onclick="submit_with_time(this)" value="Submit"/></li>
			</ul>
		</div>

		<div class="search-by-field">
			<ul>
				<li><strong>Search with location&nbsp</strong></li>
				<li><input type="text" name="ship-city" id="ship-city" placeholder="City name"/></li>
				<li>
					<select>
						<option value="AL">Alabama</option>
						<option value="AK">Alaska</option>
						<option value="AZ">Arizona</option>
						<option value="AR">Arkansas</option>
						<option value="CA">California</option>
						<option value="CO">Colorado</option>
						<option value="CT">Connecticut</option>
						<option value="DE">Delaware</option>
						<option value="DC">District Of Columbia</option>
						<option value="FL">Florida</option>
						<option value="GA">Georgia</option>
						<option value="HI">Hawaii</option>
						<option value="ID">Idaho</option>
						<option value="IL">Illinois</option>
						<option value="IN">Indiana</option>
						<option value="IA">Iowa</option>
						<option value="KS">Kansas</option>
						<option value="KY">Kentucky</option>
						<option value="LA">Louisiana</option>
						<option value="ME">Maine</option>
						<option value="MD">Maryland</option>
						<option value="MA">Massachusetts</option>
						<option value="MI">Michigan</option>
						<option value="MN">Minnesota</option>
						<option value="MS">Mississippi</option>
						<option value="MO">Missouri</option>
						<option value="MT">Montana</option>
						<option value="NE">Nebraska</option>
						<option value="NV">Nevada</option>
						<option value="NH">New Hampshire</option>
						<option value="NJ">New Jersey</option>
						<option value="NM">New Mexico</option>
						<option value="NY">New York</option>
						<option value="NC">North Carolina</option>
						<option value="ND">North Dakota</option>
						<option value="OH">Ohio</option>
						<option value="OK">Oklahoma</option>
						<option value="OR">Oregon</option>
						<option value="PA">Pennsylvania</option>
						<option value="RI">Rhode Island</option>
						<option value="SC">South Carolina</option>
						<option value="SD">South Dakota</option>
						<option value="TN">Tennessee</option>
						<option value="TX">Texas</option>
						<option value="UT">Utah</option>
						<option value="VT">Vermont</option>
						<option value="VA">Virginia</option>
						<option value="WA">Washington</option>
						<option value="WV">West Virginia</option>
						<option value="WI">Wisconsin</option>
						<option value="WY">Wyoming</option>
					</select>			
				</li>
				<li><input type="button" onclick="submit_with_location(this)" value="Submit"/></li>
			</ul>
		</div>

		<div class="search-by-field">
			<ul>
				<li><strong>Search with field&nbsp</strong></li>
				<li>
					<select>
						<option value="orderid">Order Id</option>
						<option value="controlnumber">Control Number</option>
						<option value="login">Login</option>
						<option value="upsreffield">UPS Ref Field</option>
						<option value="status">Status</option>
						<option value="shipto">Ship To</option>
						<option value="zip">Zip</option>
						<option value="shipmethod">Ship Method</option>
						<option value="view">View</option>
					</select>
				<li><input type="text" name="contains-word" id="contains-word" placeholder="Where it contains"/></li>
				<li><input type="button" onclick="submit_with_field(this)" value="Submit"/></li>
			</ul>
		</div>

		<div class="search-by-field">
			<ul>
				<li><strong>Fuzzy Search&nbsp</strong></li>
				<li><input type="text" name="keyword" id="keyword" placeholder="keywords"/></li>
				<li><input type="button" onclick="submit_with_keyword(this)" value="Submit"/></li>
			</ul>
		</div>
	</div>

	<div class="table-content">
		<div class="order-table-title">
			<p><strong>The Orders You Search</strong></p>
		</div>

		<div class="order-table">
			<table class="altrowstable" id="alternatecolor">
				<tr>
				    <th>Order Id</th>
				    <th>Control Number</th>
				    <th>Order Date</th>
				    <th>Login</th>
				    <th>UPS Ref Field</th>
				    <th>Status</th>
				    <th>Ship To</th>
				    <th>City</th>
				    <th>State</th>
				    <th>Zip</th>
				    <th>Ship Method</th>
				    <th>View</th>
				</tr>
				
				<?php if ($orders) { foreach ($orders as $order) { ?>
				<tr>
				    <td><?php echo $order['orderid']; ?></td>
				    <td><?php echo $order['controlnumber']; ?></td>
				    <td><?php echo $order['orderdate']; ?></td>
				    <td><?php echo $order['login']; ?></td>
				    <td><?php echo $order['upsreffield']; ?></td>
				    <?php if ($order['status'] == 1) { ?>
				    <td><img id="check-img" src="<?php echo base_url();?>static/images/check.png"></img></td>
					<?php } else { ?>
					<td><img id="check-img" src="<?php echo base_url();?>static/images/cross.png"></img></td>
					<?php } ?>
				    <td><?php echo $order['shipto']; ?></td>
				    <td><?php echo $order['city']; ?></td>
				    <td><?php echo $order['state']; ?></td>
				    <td><?php echo $order['zip']; ?></td>
				    <td><?php echo $order['shipmethod']; ?></td>
				    <td><?php echo $order['view']; ?></td>
				</tr>
				<?php }}?>
			</table>
		</div>
	</div>

	<div class="paginator">

		<div id="prev-page" onclick="setPrevPage(this)">prev</div>
		<div id="page-num">1/1</div>
		<div id="next-page" onclick="setNextPage(this)">next</div>
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
		     
		    
	
	</script>