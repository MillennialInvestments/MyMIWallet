<?php
$getCoinValue	= $this->investment_model->get_coin_value();
foreach ($getCoinValue->result_array() as $coinValue) {
    $initial_value				= number_format($coinValue['coin_value'], 8);
    $sec_initial_value			= $initial_value / 2;
    $available_coins			= $coinValue['available_coins'];
    $coin_value					= $coinValue['coin_value'];
}
$getInitialCoinValue			= $this->investment_model->get_initial_coin_value();
foreach ($getInitialCoinValue->result_array() as $coinValue) {
    $first_initial_value		= $coinValue['coin_value'];
}
$referral						= 69;
$sec_referral					= number_format($referral / 2, 2);
$referral_amount				= number_format($referral / $coin_value);
$sec_referral_amount			= number_format(($referral / $coin_value)/2);
$percent_change					= round((($initial_value - $first_initial_value) / $first_initial_value) * 100, 2) . '%';
if ($percent_change > 0) {
    $percentChange				= '<span class="text-green">' . $percent_change . '</span>';
} else {
    $percentChange				= '<span class="text-red">' . $percent_change . '</span>';
}
?>
<style>.text-green{color:green}.text-red{color:red}.list-style{list-style:auto!important}</style>
<div class="row">
    <div class="col px-3">
        <h4 class="card-title">Affiliate Program Policies</h4>
        <p class="card-description pb-1">Please review the following information</p>
        <p>All Millennial Investment Affiliates are required to adhere to the agreement below and remain in compliance with these terms. This list contains everything you need to know to be a Millennial Investment Affiliate, including resources, recommendations, and some fun legal stuff.</p>
        <h4 class="card-title py-3">Getting Started / Resources</h4>
        <p>We will be providing our Affiliate Members with the opportunity to collect <a href="<?php echo site_url('Knowledge-Base/Assets#what-are-digital-assets'); ?>">MyMI Coins</a> in return for referring new members to the Millennial Investments Community. So let's get into the details of how this works by continuing to read the information provided below!</p>
        <p>The goal of our Membership Referral Program was created to reward our members for contributing to the Millennial Investments Platform. In order to accomplish that goal, we have developed our first Crypto Token to distribute within our Internal Community of Investors: MyMI Coin!</p>
        <p><strong class="text-bold">Account:</strong> You can log into your membership account at anytime and track your clicks and referrals at <a href="<?php echo site_url('My-Referrals'); ?>"><?php echo site_url('My-Referrals'); ?></a> or simply clicking <a href="<?php echo site_url('My-Referrals'); ?>">here</a>.</p>
        <p><strong>Have questions?</strong> If you ever need anything else or have questions, feel free to reach out to the team at <a href="mailto:affiliates@mymiwallet.com">affiliates@mymiwallet.com</a>.</p>
    </div>
</div>
<?php $this->load->view('User/Referral_Program/Apply/Referral_Policy_Additional'); ?>