<?php
$pageURIA                                   = $this->uri->segment(1);
$pageURIB                                   = $this->uri->segment(2);
$pageURIC                                   = $this->uri->segment(3);
$pageURID                                   = $this->uri->segment(4);
$pageURIE                                   = $this->uri->segment(5);
$userID                                     = $pageURID; 
$redirect_url                               = current_url();
$dashboardTitle                             = 'Assets /';
$dashboardSubtitle                          = 'Asset Creator'; 
$userAccount                                = $_SESSION['allSessionData']['userAccount'];
$viewData                                   = array(
    'userAccount'                           => $userAccount,
); 
?>
<div class="nk-block">
    <div class="row gy-gs">
        <div class="col-lg-12 col-xl-12">
            <div class="nk-block">
                <div class="nk-block-head-xs">
                    <div class="nk-block-head-content">
                        <h1 class="nk-block-title title"><?php echo $dashboardTitle; ?></h1>
                        <h2 class="nk-block-title subtitle"><?php echo $dashboardSubtitle; ?></h2>
                        <p id="private_key"></p>
                        <p id="address"></p>
                        <a href="<?php echo site_url('/Management'); ?>">Back to Dashboard</a>							
                    </div>
                </div>
            </div>
            <div class="nk-block">
                <div class="row">
                    <div class="col-sm-6 col-lg-8 col-xxl-9">
                        <div class="card card-bordered">
                            <div class="card-inner">
                                <form class="form-horizontal" id="#coin_listing_request'>
                                    <fieldset>
                                        <?php
                                        Template::block('Exchange/Coin_Listing_Asset_Information/create_fields', 'Exchange/Coin_Listing_Asset_Information/create_fields', $viewData);
                                        ?>
                                    </fieldset>
                                </form>
                            </div>
                        </div><!-- .card --> 
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
const coinApplicationForm		= document.querySelector("#coin_listing_request");
const coinApplicationSubmit		= {};
if (coinApplicationForm) {
    coinApplicationForm.addEventListener("submit", async (e) => {
        //Do no refresh
        e.preventDefault();
		const formData 		= new FormData(); 
        //Get Form data in object OR
		coinApplicationForm.querySelectorAll(".form-control").forEach((inputField) => {
            formData.append(inputField.name,inputField.value);
            coinApplicationSubmit[inputField.name] = inputField.value;
        });
        //Get form data in array of objects OPTION 2
        // form.querySelectorAll("input").forEach((inputField) => {
        //     submit.push({ name: inputField.name, value: inputField.value });
        // });
        //Console log to show you how it looks
        // console.log(coinApplicationSubmit);
        // console.log(JSON.stringify(coinApplicationSubmit));
        // console.log(...formData);
        //Fetch
        try {
            const result = await fetch("<?= site_url('Exchange/Application-Manager/' . $cuID); ?>", {
			
			method: "POST",
			body: JSON.stringify(coinApplicationSubmit),
            headers: { "Content-Type": "application/json" },
			credentials: "same-origin",
			redirect: "manual",
            });
           const data = await result;
		   location.href = <?php echo '\'' . site_url('/Exchange/Coin-Listing/Asset-Information') . '\'';?>;
           console.log(data);
        } catch (err) {
            //If fetch doesn't work, maker 
            console.log(err);
        }
    });
}
</script> 	