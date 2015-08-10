	<div class="order-status-header">
		<p><strong>Generate Report</strong></p>
	</div>

	<div class="order-search-panel">
		<div class=search-by-field>
			<ul>
				<li><strong>Choose Report Type&nbsp</strong></li>
				<li>
					<select>
						<option value="1">Deliverables Report</option>
						<option value="2">Recent Order Report</option>
						<option value="3">Complete Order Report</option>
						<option value="4" selected>Inventory Report</option>
						<option value="5">Low Inventory Report</option>
					</select>
				</li>
				<li><input type="button" onclick="showReportType()" value="Get Report"/></li>
			</ul>
		</div>
		<div class=search-by-field>
			<ul>
				<li><strong>Select the Format of Report You Want to Generate&nbsp</strong></li>
				<li>
					<select style="width: 6em">
						<option value="1" selected>print</option>
						<option value="2">email (excel)</option>
						<option value="3">email (pdf)</option>
					</select>
				</li>
				<li><input type="button" onclick="generateReport()" value="Print or Email" /></li>
			</ul>
		</div>
	</div>

	<div class="table-content" id="table-content-report">
		<div class="order-table-title">
			<p><strong>Inventory Report</strong></p>
		</div>
		<!-- <div class="order-table">
			<table class="altrowstable" id="alternatecolor">
				<tr>
					<th>Image</th>
				    <th>Stock Number</th>
				    <th>Description</th>
				    <th>Avail Qty</th>
				    <th>Backorder Qty</th>
				</tr>
				<?php for ($i = 0; $i <3; $i++) { ?>
				<tr>
				    <td><img src="<?php echo base_url();?>static/images/product.png"></td>
				    <td>EXP015</td>
				    <td>EXP015 Yellow Pails</td>
				    <td>245</td>
				   	<td>0</td>
				</tr>
				<?php }?>
				
			</table>
		</div> -->

		<div class="order-table">
			<table class="altrowstable" id="alternatecolor">
				<tr>
				    <th>Image</th>
				    <th>Item Id</th>
				    <th>Description</th>
				    <th>Job Number</th>
				    <th>Avail Qty</th>
				    <th>Order Date</th>
				    <th>Logos</th>
				    <th>Order Amount</th>
				    <th>Cost/Unit</th>
				    <th>Lead Time</th>
				</tr>
				<?php for ($i = 0; $i < 5; $i++) { ?>
				<tr>
				    <td><img src="<?php echo base_url();?>static/images/product.png"></td>
				    <td>A1</td>
				    <td>LPS Lanyards w/o badge holder</td>
				    <td>EXP640</td>
				    <td>945</td>
				    <td>07/02/2015 7:45:17 AM</td>
				    <td>LPS</td>
				    <td>5000</td>
				    <td>3.74</td>
				    <td>4 Weeks</td>
				</tr>
				<?php }?>
				
			</table>
		</div>
	</div>

	<div class="paginator">

		<div id="prev-page">prev</div>
		<div id="page-num">1/2</div>
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

		function generateReport() {
			$("#table-content-report").jqprint({
				operaSupport:false,
				importCSS: true,
				printContainer: true,
				debug: false
			});
		}


		

	</script>