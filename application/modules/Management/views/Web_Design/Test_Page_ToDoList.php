<?php
$completed = '<strong style="color: green">COMPLETED: </strong>';
?>
<div class="row">
	<div class="col-md-12 grid-margin stretch-card">
		<div class="card">
			<div class="card-body">
				<h3 class="card-header">Path of Transaction</h3>
				<ol>
					<li>
						Customer contacts company<br>
						<ul>
							<li>Marketing Team will need access to the Company Google Voice Line</li>
						</ul>
					</li>
					<li>Employee opens Marketing HomeAdvisor Overview</li>
					<li>
						Services Include:<br>
						<div class="row pt-3">
							<div class="col-sm-12">
								<strong>Residential</strong>
							</div>
						</div>
						<div class="row">
							<div class="col-sm-4">
								Audio/Visual Installations
								<ul>
									<li>TV Mounts</li>   
									<li>Video Installations</li>   
									<li>Whole-Home Audio</li>
								</ul>
							</div>
							<div class="col-sm-4">
								Computer Repair/Troubleshooting
								<ul>
									<li>Hardware/Software Installation</li>
									<li>Printer Installation/Troubleshooting</li>
								</ul> 
							</div>
							<div class="col-sm-4">
								Computer Network Installation/Troubleshooting
								<ul>
									<li>Modem/Router/Switch Installation</li>
									<li>Wired Network Installation</li>
									<li>Wireless Network Installation</li>
								</ul>
							</div>
						</div>
						<div class="row pt-3">
							<div class="col-sm-4">
								Home Automation
								<ul>
									<li>Lighting Control Systems</li>
									<li>Smart Security</li>
									<li>Smart Thermostats/Air Control Systems</li>
									<li>Whole-Home Automation</li>
								</ul>
							</div>
							<div class="col-sm-4">
								Home Security 
								<ul>
									<li>Access Control Systems</li>
									<li>Intrusion Alarm Systems</li>
									<li>Surveillance Systems</li>
								</ul>
							</div>
						</div>
						<div class="row pt-3">
							<div class="col-sm-12">
								<strong>Commercial</strong>
							</div>
						</div>
						<div class="row pb-3">
							<div class="col-sm-4">
								Audio/Visual   
								<ul>          
									<li>Audio Installations</li>
									<li>TV Mounts</li>   
									<li>Video Installation</li> 
								</ul>
							</div>
							<div class="col-sm-4">
								Networking
								<ul>
									<li>Network Infrastructure</li>
									<li>Structured Cabling</li>
									<li>Wireless Infrastructure</li>
								</ul>
							</div>
							<div class="col-sm-4">
								Unified Communications
								
							</div>
						</div>
					</li>
					<li>
						Identifies services being requested<br>
						<ul>
							<li>Create Modals for the Services using the bf_services Database table</li>
							<li>Import/Use what information we already have in Quickbooks</li>
							<li>
								bf_services must include the following:<br>
								<ul>
									<li>Service Name</li>
									<li>Service Description</li>
									<li>Service Costs</li>
								</ul>
							</li>
						</ul>
					</li>
					<li>
						Opens form to submit customer/project information<br>
						<ul>
							<li>Create a form for each service category</li>
							<li>
								Include Section for Customer Information
								<ul>
									<li>Customer Name</li>
									<li>Customer Email</li>
									<li>Customer Phone</li>
									<li>Customer Address</li>
									<li>Customer Type</li>
								</ul>
							</li>
							<li>
								Include Section for Project Information
								<ul>
									<li>Type of Services</li>
								</ul>
							</li>
						</ul>
					</li>
					<li>Results generated to provide an estimate while on the phone</li>
					<li>If customer accepts estimate, employee sends information to Administration</li>
					<li>Email should consist of the Customer Information &amp; Service Requests Information</li>
					<li>Administration submits the estimate into Quickbooks</li>
					<li>Administration schedules technicians based on availability</li>
					<li>Technicians conduct job and submit Job Tracking Report</li>
					<li>Accounting verifies costs and creates invoice</li>
					<li>Accounting confirms invoice is paid off</li>
					<li>Marketing Team sends out Customer Review of Service</li>
					<li>Once Customer Review is completed, send an email with additional services we provide</li>
				</ol>
				<h3 class="card-header">HomeAdvisor Overview To-Do List</h3>
				
				<ul>
					<li>
						Service Database &amp; Layout:
						<ul>
							<li><strong>Services Database:</strong> bf_services</li>
							<li>Name of Service</li>
							<li>Description of Service</li>
							<li>Cost of Services</li>
							<li>Service Formss</li>
						</ul>
					
					</li>
				</ul>
			</div>
		</div>
	</div>
</div>
