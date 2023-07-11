<div class="form-group row">
	<label for="details" class="col-sm-3 col-form-label">Additional Details</label>
	<div class="col-sm-9">
		<textarea type="text" class="form-control" name="details" id="details" rows="5" placeholder="Enter Additional Details" value="<?php echo set_value('details', isset($user) ? $user->details : ''); ?>"></textarea>						
	</div>
</div>
