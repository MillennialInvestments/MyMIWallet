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
<input type="hidden" name="group" id="group" value="<?php echo set_value('group', isset($user) ? $user->group : $groupID); ?>">				
<input type="hidden" name="user_id" id="user_id" value="<?php echo set_value('user_id', isset($user) ? $user->user_id : $cuID); ?>">		
<div class="modal-body p-0">
	<div class="form-group row pt-3 pl-3 mb-0">
		<div class="col-2">
			<img src="<?php echo base_url('assets/images/Users/Profile_Pictures/' . $profile_pic); ?>" class="rounded-circle full-width" style="float-left;max-width:50px;">
		</div>
		<div class="col-4 pt-3">
			<strong style="float-left"><?php echo $displayName; ?></strong>
		</div>
	</div>
	<div class="form-group row">
		<div class="col-12">
			<textarea class="form-control px-0 pl-3" style="background-color: transparent !important;border:none;" name="video_link" id="video_link" rows="15" placeholder="Share Your Thoughts" value="<?php echo set_value('video_link', isset($user) ? $user->video_link : ''); ?>"></textarea>
		</div>
	</div>
	<?php
	if ($cuRole === 1) {
	?>
	<div class="form-group row justify-content-center">
		<label for="announcement" class="col-3 col-form-label">Announcement?</label>
		<div class="col-7">
			<?php 
				echo '
				<select name="announcement" class="form-control" id="announcement">
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
	<div class="form-group row justify-content-center">
		<label for="member_type" class="col-3 col-form-label">Member Type?</label>
		<div class="col-7">
			<?php 
				echo '
				<select name="member_type" class="form-control" id="member_type">
					<option>Select-An-Option</option>
					';  								
										
					$msg_type_values = array(
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
				

