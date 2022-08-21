<h5 class="card-title">Infrastructure Breakdown</h5>
<p class="card-description">Infrastructure Breakdown &amp; Overview for Millennial Investments</p>
<div class="tab-content full-width">
<!--
	<div class="tab-pane fade" id="administration-management">
		<?php //$this->load->view('Infrastructure_Overview/Navbar');?>
		<div class="pt-5 pl-3">					
			<h5 class="card-title">Administration/Management</h5>
			<p class="card-description">Information regarding Administration Management &amp; Tasks</p>
			<?php //$this->load->view('Web_Design/Infrastructure_Overview/Administration_Management/Overview');?>
		</div>
	</div>
	<div class="tab-pane fade" id="accounting-overview">
		<?php //$this->load->view('Infrastructure_Overview/Navbar');?>
		<div class="pt-5 pl-3">        
			<h6 class="card-title">Accounting System</h6>     
			<p class="card-description">Information regarding our Investment Account System</p>
			<?php //$this->load->view('Web_Design/Infrastructure_Overview/Current_Positions/Overview');?>
		</div>
	</div> 	
-->
	<div class="tab-pane active" id="alerting-system">  
		<?php $this->load->view('Infrastructure_Overview/Navbar'); ?>
		<div class="pt-5 pl-3">                    
			<h6 class="card-title">Alerting System</h6>   
			<p class="card-description">Information regarding our Investment Alerting System &amp; Management</p>
			<?php $this->load->view('Web_Design/Infrastructure_Overview/Alerting_System/Overview'); ?>
		</div>
	</div> 	
	<div class="tab-pane" id="communities">  
		<?php $this->load->view('Infrastructure_Overview/Navbar'); ?>
		<div class="pt-5 pl-3">                    
			<h6 class="card-title">Our Communities</h6>   
			<p class="card-description">Information regarding our Communities &amp; Community Management</p>
			<?php $this->load->view('Web_Design/Infrastructure_Overview/Communities/Overview'); ?>
		</div>
	</div> 	
	<div class="tab-pane" id="user-management"> 
		<?php $this->load->view('Infrastructure_Overview/Navbar'); ?>
		<div class="pt-5 pl-3">           
			<h6 class="card-title">User Management</h6>
			<p class="card-description">Information regarding User Accounts &amp; Management</p>
			<?php $this->load->view('Web_Design/Infrastructure_Overview/User_Management/Overview'); ?>
		</div>
	</div> 	
</div>
<?php $this->load->view('Web_Design/Infrastructure_Overview/Modals'); ?>
