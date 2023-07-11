<div class="col-lg-12 col-sm-12 form-group" data-for="Additional Materials">
	<textarea name="materials" placeholder="Add Additional Materials Used (if necessary)" class="form-control display-7" id="materials-formbuilder-2q" value="<?php echo set_value('materials', isset($user) ? $user->materials : ''); ?>" rows="5"></textarea>
</div>
<div class="col-lg-12 col-sm-12 form-group" data-for="Details">
	<textarea name="additional_details" placeholder="Additional Details" class="form-control display-7" id="Details-formbuilder-2q" value="<?php echo set_value('additional_details', isset($user) ? $user->additional_details : ''); ?>" rows="5"></textarea>
</div>
