<?php
$sophtronUserID                             = $this->config->item('sophtron_user_id'); 
$sophtronIntKey                             = $this->config->item('sophtron_integration_key'); 
?>
<div class="card card-bordered pricing">
    <div class="pricing-head">
        <div class="pricing-title">
            <h4 class="card-title title">Sophtron API Setup</h4>
        </div>
    </div>
    <div class="pricing-body">

        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/3.1.9-1/crypto-js.min.js"></script>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/3.1.9-1/hmac-sha256.min.js"></script>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/3.1.9-1/enc-base64.min.js"></script>
        <!-- <script type="text/javascript" src="https://cdn.sophtron.com/sophtron-widget-loader-0.0.0.5.min.js" ></script> -->
        <script type="text/javascript" src="<?php echo base_url('assets/js/Sophtron_Widget/script.js'); ?>" ></script>
        <script>

            function createAccessKeyAuthCode(userId, accessKey, url, httpMethod) {
                var authPath                = url.substring(url.lastIndexOf('/')).toLowerCase();
 
                var decodedSecret           = atob(accessKey);
                var plainKey                = httpMethod.toUpperCase() + '\n' + authPath;
                var hash                    = CryptoJS.HmacSHA256(plainKey, decodedSecret); 
                var b64Sig                  = CryptoJS.enc.Base64.stringify(hash); 
                var authString              = 'FIApiAUTH:' + userId + ':' + b64Sig + ':' + authPath;
                console.log(authString);
                return authString;
            }
            sophtron.init('Add', {
                env: 'preview',
                partner: 'default',
                integration_key: createAccessKeyAuthCode(userId, accessKey, url, httpMethod),
                request_id: authCode, // Pass the authCode variable here
                institution_id: '',
                routing_number: '',
                userInstitution_id: ''
            }, true);
            sophtron.show();        
        </script>
    </div>
</div>