
<!-- Flinks Connect -->
<?php 
$test                               = 1; 
$closeEnableTog                     = 1;
$consentEnableTog                   = 1;
$accountSelectorEnableTog           = 1;
$showAllEnableTog                   = 1;
$multiAccountSelectorTog            = 1;
$termsCondURL                       = site_url('/Terms-And-Conditions');
$pbURL                              = ''; 
$sbURL                              = 'https://mymiwallet7808.connect.flinks.dev/v2/?'; 
$redirectURL                        = urlencode('https://www.mymiwallet.com/dev/public/index.php/Link-Account/F-Links/1');
if ($test === 0) {
    $mainURL                        = $pbURL;
} elseif ($test === 1) {
    $mainURL                        = $sbURL;
}
// echo 'Main URL: ' . $mainURL . '<br>';
if ($closeEnableTog === 0) {
    $closeEnable                    = 'closeEnable=false';
} elseif ($closeEnableTog === 1) {
    $closeEnable                    = 'closeEnable=true';
}
if ($consentEnableTog === 0) {
    $consentEnable                  = 'consentEnable=false';
} elseif ($consentEnableTog === 1) {
    $consentEnable                  = 'consentEnable=true';
}
if ($accountSelectorEnableTog === 0) {
    $accountSelectorEnable          = 'accountSelectorEnable=false';
} elseif ($accountSelectorEnableTog === 1) {
    $accountSelectorEnable          = 'accountSelectorEnable=true';
}
if ($showAllEnableTog === 0) {
    $showAllEnable                  = 'showAllAccounts=false';
} elseif ($showAllEnableTog === 1) {
    $showAllEnable                  = 'showAllAccounts=true';
}
if ($multiAccountSelectorTog === 0) {
    $multiAccountSelector           = 'accountSelectorMultiple=false';
} elseif ($multiAccountSelectorTog === 1) {
    $multiAccountSelector           = 'accountSelectorMultiple=true';
}
$url                                = $mainURL . $closeEnable . '&termsUrl=' . $termsCondURL . '&customerName=MyMI+Wallet&' . $consentEnable . '&features=TransactionHistory%2CAccountNumber&' . $accountSelectorEnable . '&' . $showAllEnable . '&' . $multiAccountSelector; 
// echo $url; 
// echo '<br>';
$demoURL                            = 'https://mymiwallet7808.connect.flinks.dev/v2/?closeEnable=true&termsUrl=https%3A%2F%2Fwww.mymiwallet.com%2FTerms-And-Conditions&customerName=MyMI+Wallet&redirectUrl=https%3A%2F%2Fwww.mymiwallet.com%2FLink-Account%2FF-Link%2F1&accountSelectorEnable=true&showAllAccounts=true&accountSelectorMultiple=true';
// echo $demoURL;
$activeURL                          = $demoURL;
// echo $activeURL . '<br>'; 
?>
<!-- <iframe class="flinksconnect border rounded" height="760"
        src="<?php //echo $url; ?>">
</iframe> -->

<div class="row justify-content-center">
    <div class="col-12 col-md-4">        
        <!-- Flinks Connect -->
        <iframe class="flinksconnect border rounded" height="760"
                src="https://mymiwallet7808.connect.flinks.dev/v2/?closeEnable=true&termsUrl=https%3A%2F%2Fwww.mymiwallet.com%2FTerms-And-Conditions&customerName=MyMI+Wallet&redirectUrl=https%3A%2F%2Fwww.mymiwallet.com%2Fdev%2Fpublic%2Findex.php%2FLink-Account%2FF-Links%2F1&accountSelectorEnable=true&showAllAccounts=true&accountSelectorMultiple=true">
        </iframe>
    </div>
    <div class="col-12 col-md-8">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title title">Connect Your Financial Banking Account!</h3>
            </div>
        </div>
    </div>
</div>
<!-- Event Listener -->
<script>
  window.addEventListener('message', 
    function(e) {
        console.log(e.data);
    }
  );
</script>