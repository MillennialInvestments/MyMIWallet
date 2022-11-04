<?php
$cuID                       = $_SESSION['allSessionData']['userAccount']['cuID']; 
if (!empty($cuID)) {
    $redirectURL            = '/Dashboard'; 
    $btnText                = 'Back to Dashboard';
} else {
    $redirectURL            = '/'; 
    $btnText                = 'Back to Home';
}
?>
<div class="nk-block nk-block-middle wide-xs mx-auto py-5">
    <div class="nk-block-content nk-error-ld text-center pt-5">
        <h1 class="nk-error-head mt-3">404</h1>
        <h3 class="nk-error-title">Oops! Why you’re here?</h3>
        <p class="nk-error-text">We are very sorry for inconvenience. It looks like you’re try to access a page that either has been deleted or never existed.</p>
        <a href="<?php echo site_url($redirectURL); ?>" class="btn btn-lg btn-primary mt-2"><?php echo $btnText; ?></a>
    </div>
</div><!-- .nk-block -->