<style>
	.textarea-modal-btn {border:none;background:none;width:100%;max-width:100%}
	.btn-secondary {
		background-color: #fff;
		color: #212529 !important;
		border:none;
	}
	.user-comment-btns {
		color: #212529 !important;
		border:none;
	}
</style>                                                                                             
<input type="hidden" name="redirectURL" id="redirectURL" value="<?php echo set_value('redirectURL', isset($user) ? $user->redirectURL : $redirectURL); ?>">	
<input type="hidden" class="form-control" name="submitted_date" id="submitted_date" placeholder="Enter Alert Date" value="<?php echo set_value('submitted_date', isset($user) ? $user->submitted_date : $date); ?>">						
<input type="hidden" name="time" id="time" value="<?php echo set_value('time', isset($user) ? $user->time : $hostTime); ?>">				
<input type="hidden" name="user_id" id="user_id" value="<?php echo set_value('user_id', isset($user) ? $user->user_id : $cuID); ?>">	
<input type="hidden" name="stock" id="stock" value="<?php echo set_value('stock', isset($user) ? $user->stock : $symbol); ?>">	
<div class="form-group row text-center pb-3">
	<?php
	// Mobile Version
	if ($this->agent->is_mobile())
	{  
		echo '<h4 class="card-title text-center">Add Due Diligence</h4>';
	} else {
		echo '<h1 class="card-title">Add Due Diligence for this Stock</h1>';
	}
	?>
</div>
<div class="form-group row">
	<label for="url_link" class="col-12 col-sm-12 col-md-3 col-form-label">Topic:</label>
	<div class="col-12 col-sm-12 col-md-9">      						
		<input type="text" class="form-control" name="topic" id="topic" placeholder="Enter Due Diligence Topic" value="<?php echo set_value('topic', isset($user) ? $user->topic : ''); ?>">						
	</div>
</div> 
<div class="form-group row">
	<label for="details" class="col-12 col-sm-12 col-md-3 col-form-label">Details</label>
	<div class="col-12 col-sm-12 col-md-9">
		<textarea class="form-control" name="details" id="details" rows="5" placeholder="Enter Additional Details" value="<?php echo set_value('details', isset($user) ? $user->details : ''); ?>"></textarea>
	</div>
</div>
<div class="form-group row">
	<label for="url_link" class="col-12 col-sm-12 col-md-3 col-form-label">URL Link:</label>
	<div class="col-12 col-sm-12 col-md-9">      						
		<input type="text" class="form-control" name="url_link" id="url_link" placeholder="Enter Trade Review URL" value="<?php echo set_value('url_link', isset($user) ? $user->url_link : ''); ?>">						
	</div>
</div> 
