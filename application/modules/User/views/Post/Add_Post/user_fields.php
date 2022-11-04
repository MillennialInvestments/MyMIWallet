<?php 
// Set Form Config
$formGroup				= $this->config->item('form_container');
$formLabel				= $this->config->item('form_label');
$formConCol				= $this->config->item('form_control_column');
$formControl			= $this->config->item('form_control');
$formSelect				= $this->config->item('form_select');
$formSelectPicker		= $this->config->item('form_selectpicker');
$formText				= $this->config->item('form_text');
$formCustomText			= $this->config->item('form_custom_text');
?>
<style>
	.textarea-modal-btn {border:none;background:none;width:100%;max-width:100%}
	.btn-secondary {
		background-color: #fff !important;
		color: #212529 !important;
		border:none;
	}
	.user-comment-btns {
		color: #212529 !important;
		border:none;
	}
</style>                                                                                             	
<div class="form-group row" id="add-post-form-row">
	<div class="d-none d-sm-block col-sm-1"></div>
	<div class="col-2 col-sm-1 py-4">
		<label>
			<img src="<?php echo base_url('assets/images/Users/Profile_Pictures/' . $cuProfilePic); ?>" class="rounded-circle img-fluid">
		</label>
	</div>
	<div class="col-10 col-sm-8 py-4">
		<button class="textarea-modal-btn mt-0 mb-2" type="button" data-toggle="modal" data-target="#addPostModal">
			<textarea class="form-control" rows="1" placeholder="Share Your Thoughts"></textarea>
		</button>
	</div>
</div>
<div class="row justify-content-center mt-3 border-top border-bottom" id="add-post-share-buttons">
	<div class="col-6 px-0">
		<a class="btn btn-secondary btn-block user-btns" href="<?php echo site_url('/Trade-Tracker/Search'); ?>"><i class="icon-chart mr-2"></i>Share Trade</a>
	</div>
	<div class="col-6 px-0">
		<a class="btn btn-secondary btn-block user-btns" type="button" data-toggle="modal" data-target="#addVideoModal"><i class="icon-camrecorder mr-2"></i>Share Video</a>
	</div>
</div>
<div class="modal show active" id="addPostModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content bg-white">
			<div class="modal-header">
				<h5 class="modal-title text-center" id="exampleModalLabel">Create Post</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body p-0">
				<div class="form-group row pt-3 pl-3 mb-0">
					<div class="col-2">
						<img src="<?php echo base_url('assets/images/Users/Profile_Pictures/' . $cuProfilePic); ?>" class="rounded-circle full-width" style="float-left;max-width:50px;">
					</div>
					<div class="col-4 pt-3">
						<strong style="float-left"><?php echo $cuDisplayName; ?></strong>
					</div>
				</div>  				
				<input type="hidden" name="redirectURL" id="redirectURL" value="<?php echo set_value('redirectURL', isset($user) ? $user->redirectURL : $redirectURL); ?>">	
				<input type="hidden" class="form-control" name="submitted_date" id="submitted_date" placeholder="Enter Alert Date" value="<?php echo set_value('submitted_date', isset($user) ? $user->submitted_date : $date); ?>">						
				<input type="hidden" name="time" id="time" value="<?php echo set_value('time', isset($user) ? $user->time : $hostTime); ?>">						
				<input type="hidden" name="group" id="group" value="<?php echo set_value('group', isset($user) ? $user->group : $groupID); ?>">				
				<input type="hidden" name="user_id" id="user_id" value="<?php echo set_value('user_id', isset($user) ? $user->user_id : $cuID); ?>">
				<div class="<?php echo $formGroup; ?> mb-2">
					<div class="col-12">
						<textarea class="form-control px-0 pl-3" style="background-color: transparent !important;border:none;" name="details" id="details" rows="15" placeholder="Share Your Thoughts" value="<?php echo set_value('details', isset($user) ? $user->details : ''); ?>"></textarea>
					</div>
				</div>
				<div class="<?php echo $formGroup; ?> mb-2">
					<label for="url_link" class="col-4 form-label pl-5">Link</label>
					<div class="col-7">       						
						<input type="text" class="<?php echo $formControl; ?> mb-2" name="url_link" id="url_link" placeholder="Enter Website URL Link" value="<?php echo set_value('url_link', isset($user) ? $user->url_link : ''); ?>">						
					</div>
				</div> 
				<?php
				if ($cuRole === 1) {
				?>
				<div class="<?php echo $formGroup; ?> mb-2">
					<label for="announcement" class="col-4 form-label pl-5">Announcement?</label>
					<div class="col-7">
						<?php 
							echo '
							<select name="announcement" class="' . $formControl . '" id="announcement" required="required">
								<option>Select-An-Option</option>
								';  							
										
								$msg_type_values = array(
									1			=> 'Yes',
									0			=> 'No',
								);
								foreach($msg_type_values as $value => $display_text)
								{
									$selected = ($value == $this->input->post('announcement')) ? ' selected="selected"' : "";

									echo '<option value="'.$value.'" '.$selected.'>'.$display_text.'</option>';
								} ;
							echo '</select>';
						?>						
					</div>
				</div> 
				<div class="<?php echo $formGroup; ?> mb-2">
					<label for="member_type" class="col-4 form-label pl-5">Member Type?</label>
					<div class="col-7">
						<?php 
							echo '
							<select name="member_type" class="' . $formControl . '" id="member_type" required="required">
								<option>Select-An-Option</option>
								';  								
													
								$msg_type_values = array(
									'Beta'			=> 'Beta Members',
									'Free'			=> 'Free Members',
									'Premium'		=> 'Premium Members',
								);
								foreach($msg_type_values as $value => $display_text)
								{
									$selected = ($value == $this->input->post('member_type')) ? ' selected="selected"' : "";

									echo '<option value="'.$value.'" '.$selected.'>'.$display_text.'</option>';
								} ;
							echo '</select>';
						?>						
					</div>
				</div> 
				<?php	
				}
				?>
			</div>
			<div class="modal-footer">
				<input class="btn btn-primary btn-block" type="submit" name="register" id="submit" value="Post" />
			</div>
		</div>
	</div>
</div>
