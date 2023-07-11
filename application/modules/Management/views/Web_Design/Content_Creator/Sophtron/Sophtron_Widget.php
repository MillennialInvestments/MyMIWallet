<script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/4.1.1/crypto-js.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/4.1.1/hmac-sha256.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/4.1.1/enc-base64.min.js"></script>
<!-- <script type="text/javascript" src="<?php // echo base_url('assets/js/sophtron_widget_loader.js'); ?>"></script> -->
<!-- <script type="text/javascript" src="<?php //echo base_url('assets/js/Sophtron_Widget/server.js'); ?>"></script> -->
<script type="text/javascript">
    function createAccessKeyAuthCode(userId, accessKey, url, httpMethod) {
        var authPath    = url.substring(url.lastIndexOf('/')).toLowerCase();
        var decodedSecret = atob(accessKey); 
        var plainKey    = httpMethod.toUpperCase() + '\n' + authPath;
        var hash = CryptoJS.HmacSHA256(plainKey, decodedSecret); 
        var b64Sig = CryptoJS.enc.Base64.stringify(hash);
        var authString = 'FIApiAUTH:' + userId + ':' + b64Sig + ':' + authPath; 
        return authString;
    }
</script>
  