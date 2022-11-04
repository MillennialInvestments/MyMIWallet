<?php
$pageURIA 		= $this->uri->segment(1);
$pageURIB 		= $this->uri->segment(2);
$pageURIC 		= $this->uri->segment(3);
$pageURID 		= $this->uri->segment(4);
$pageType		= Template::get('pageType');
if ($pageURIA === 'admin') {
    ?>
<script>
$(document).ready(function() {
	$('#dashboardTasksDatatable').DataTable( {
		"order": [[ 0, "desc" ]],     
	}	
	);
} );
</script>
<?php
}
if ($pageURIA === 'Management') {
    ?>
	<script>
	$(document).ready(function() {
		$('#supportRequestOverview').DataTable( {
			"order": [[ 0, "asc" ]],     
			"lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]]
		}	
		);
	} );
	</script>
<?php
}
if ($pageURIA === 'Swing-Trades') {
    ?>
	<script>
	$(document).ready(function() {
		$('#alertOverviewDatatable').DataTable( {
			"order": [[ 5, "desc" ]],     
			"lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]]
		}	
		);
	} );
	</script>
<?php
}
if ($pageURIA === 'Option-Trades') {
    ?>
	<script>
	$(document).ready(function() {
		$('#alertOverviewDatatable').DataTable( {
			"order": [[ 5, "desc" ]],     
			"lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]]
		}	
		);
	} );
	</script>
<?php
}
if ($pageURIA === 'Trade-Tracker') {
    ?>
	<script>
	$(document).ready(function() {
		$('#tradeTrackerDatatable').DataTable( {
			"order": [[ 5, "desc" ]],     
			"lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]]
		}	
		);
	} );
	</script>
	<script>
	// $(document).ready(function() {
	// 	$('#tradeHistoryDatatable').DataTable( {
	// 		"order": [[ 0, "desc" ]],     
	// 		"lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]]
	// 	}	
	// 	);
	// } );
	</script>    
<?php
}
if ($pageURIA === 'Wallet-Details') {
    ?>
	<script>
	$(document).ready(function() {
		$('#walletTradeOverviewDatatable').DataTable( {
			"order": [[ 0, "desc" ]],     
			"lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]]
		}	
		);
	} );
	</script>
    <?php
}
if ($pageURIA === 'Accounting') {
    ?>

	<script>
	$(document).ready(function() {
		$('.accountingDatatable').DataTable( {
			"order": [[ 3, "desc" ]],     
			"lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]]
		}	
		);
	} );
	</script>
<?php
}
if ($pageURIA === 'Alerts' or 'Trade-Alerts') {
    ?>  
	<script>
	$(document).ready(function() {
		$('#alertOverviewDatatable').DataTable( {
			"order": [[ 5, "desc" ]],     
			"lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]]
		}	
		);
	} );
	</script>
<?php
}
if ($pageURIA === 'Investment-Management') {
    ?>
	<script>
	$(document).ready(function() {
		$('#investmentRequestDatatable').DataTable( {
			"order": [[ 0, "desc" ]],     
			"lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]]
		}	
		);
	} );
	</script>
	<script>
	$(document).ready(function() {
		$('#investmentGrowthDatatable').DataTable( {
			"order": [[ 0, "desc" ]],     
			"lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]]
		}	
		);
	} );
	</script>
<?php
}
if ($pageURIA === 'Wallets') {
    ?>	
	<script>
	$(document).ready(function() {
		$('#walletTransactionDatabase').DataTable( {
			"order": [[ 0, "desc" ]],     
			"lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],    
				
		});
	});
	</script>
<?php
}
if ($pageURIA === 'MyMI-Coins') {
    ?>
	<script>
	$(document).ready(function() {
		$('#userInvestmentTable').DataTable( {
			"order": [[ 0, "desc" ]],     
			"lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],    
				
		});
	});
	</script>
<?php
}
if ($pageURIA === 'Exchange') {
    ?>
	<script>
	$(document).ready(function() {
		$('#exchangeOverviewDataTable').DataTable( {
			"order": [[ 2, "desc" ]],     
			"lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],    
				
		});
	});
	</script>
<?php
}
if ($pageURIA === 'Exchange-Management') {
    ?>
<script>
$(document).ready(function() {
	$('#exchangeOverviewDataTable').DataTable( {  
		"lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],    
			
	});
});
</script>
<?php
}
if ($pageURIA === 'Investor-Profile') {
?>
<script>
$(document).ready(function() {
	$('#userActivityDatatable').DataTable( {  
		"order": [[ 0, "desc" ]],     
		"lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],    
			
	});
});
</script>
<?php
}
if ($pageURIA === 'My-Referrals') {
?>
<script>
$(document).ready(function() {
	$('#myReferralsDatatable').DataTable( {  
		"order": [[ 0, "desc" ]],     
		"lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],    
			
	});
});
</script>
<?php
}
if ($pageURIA === 'Exchange' && $pageURIB === 'Market') {
    ?>
	<script>
	$(document).ready(function() {
		$('#exchangeBuyOrders').DataTable( {
			"searching": false,
			"paging": false,
			"info": false,
			"order": [[ 0, "desc" ]],       
				
		});
		$('#exchangeSellOrders').DataTable( {   
			"searching": false,
			"paging": false,
			"info": false,
			"order": [[ 1, "desc" ]],     
				
		});
		$('#exchangeTradeHistory').DataTable( {   
			"searching": false,
			"paging": false,
			"info": false,
			"order": [[ 0, "desc" ]],     
				
		});
	});
	</script>
<?php
} else {
        ?>
<script>
$(document).ready(function() {
    $('.datatableOverview').DataTable( {
        "order": [[ 0, "desc" ]],     
        "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],    
            
    });
});
</script>
<?php
    }
?>
