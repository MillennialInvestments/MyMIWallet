<?php
$currentUserID 					= isset($current_user->id) && ! empty($current_user->id) ? $current_user->id : '';
$currentUserProfile 					= isset($current_user->id) && ! empty($current_user->id) ? $current_user->id : '';
$currentUserRoleID 				= isset($current_user->role_id) && ! empty($current_user->role_id) ? $current_user->role_id : '';
$currentUserType				= isset($current_user->type) && ! empty($current_user->type) ? $current_user->type : '';
$currentUserUserName			= isset($current_user->username) && ! empty($current_user->username) ? $current_user->username : '';
?>
<script>
var chat_appid = '55617';
var chat_auth = '86013faaaad67c8dde3d6a7b4f3780e8';
</script>
<?php if ($currentUserID && $currentUserID > 0) {
    echo '
	<script>
	var chat_id = "' . $currentUserID . '";
	var chat_name = "' . $currentUserUserName . '"; 
	var chat_link = "' . $currentUserProfile . '"; //Similarly populate it from session for user\'s profile link if exists
	var chat_avatar = "' . $currentUserAvatar . '"; //Similarly populate it from session for user\'s avatar src if exists
	var chat_role = "' . $currentUserUserRoleID . '"; //Similarly populate it from session for user\'s role if exists
	var chat_friends = ' . $currentUserUserName . '; //Similarly populate it with user\'s friends\' site user id\'s eg: 14,16,20,31
	</script>
	';
} ?>
<script>
var chat_height = '600px';
var chat_width = '990px';

document.write('<div id="cometchat_embed_synergy_container" style="width:'+chat_width+';height:'+chat_height+';max-width:100%;border:1px solid #CCCCCC;border-radius:5px;overflow:hidden;"></div>');

var chat_js = document.createElement('script'); chat_js.type = 'text/javascript'; chat_js.src = 'https://fast.cometondemand.net/'+chat_appid+'x_xchatx_xcorex_xembedcode.js';

chat_js.onload = function() {
    var chat_iframe = {};chat_iframe.module="synergy";chat_iframe.style="min-height:"+chat_height+";min-width:"+chat_width+";";chat_iframe.width=chat_width.replace('px','');chat_iframe.height=chat_height.replace('px','');chat_iframe.src='https://'+chat_appid+'.cometondemand.net/cometchat_embedded.php'; if(typeof(addEmbedIframe)=="function"){addEmbedIframe(chat_iframe);}
}

var chat_script = document.getElementsByTagName('script')[0]; chat_script.parentNode.insertBefore(chat_js, chat_script);
</script>
