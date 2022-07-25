<div class="row" id="asset-marketplace"></div>
<div class="row g-gs">
    <div class="col-xl-12">
        <div class="nk-block-head nk-block-head-lg wide-md pb-0">
            <div class="nk-block-head-content">
                <div class="card">
                    <div class="card-inner text-left">
                        <h3 class="nk-block-title fw-normal">MyMI Asset Marketplace</h3>
                        <div class="nk-block-des">
                            <p class="lead">
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <hr>
    </div>
</div>
<?php 
if ($this->uri->segment(1) === 'Knowledge-Base' && $this->uri->segment(2) === 'MyMI-Partnerships') {
    $this->load->view('User/Knowledgebase/includes/Assets/what_are_mymi_assets');
    $this->load->view('User/Knowledgebase/includes/Assets/asset_creator');
}
?>
<div class="row" id="listing-assets-marketplace"></div>
<div class="row g-gs">
    <div class="col-xl-12">
        <div class="nk-block-head nk-block-head-lg wide-md pb-0">
            <div class="nk-block-head-content">
                <div class="card">
                    <div class="card-inner text-left">
                        <h5 class="nk-block-title fw-normal pb-3">Purchasing MyMI Assets</h5>
                        <div class="nk-block-des">
                            <p class="lead fs-14px">                         
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row" id="listing-assets-marketplace"></div>
<div class="row g-gs">
    <div class="col-xl-12">
        <div class="nk-block-head nk-block-head-lg wide-md pb-0">
            <div class="nk-block-head-content">
                <div class="card">
                    <div class="card-inner text-left">
                        <h5 class="nk-block-title fw-normal pb-3">Listing MyMI Assets</h5>
                        <div class="nk-block-des">
                            <p class="lead fs-14px">    
                                Once you have created your MyMI Assets, you have the ability to create a Private or Public Listing of your Asset on the MyM Asset Marketplace. 
                                By release your asset, you will have the option to identify the <strong>Percentage of Limitation (POI)</strong> of the asset you wish to list. 
                                The percentage of limitation is the total percentage of available coins that you wish to allocate to the Private/Public Marketplace.                       
                            </p>
                            <p class="lead fs-14px">    
                                <strong>For Example:</strong> If you create 1,000,000 coins for an asset, and you wish to release 50% of those assets to the Private/Public Marketplace, only 500,000 will be available for purchase. 
                                This defines your <strong>Percentage of Limitation</strong>. This means that once the Percentage of Limitation is reached, the coins allocated to that MyMI Assets will only be available for purchase on the MyMI Exchange.                 
                            </p>
                            <p class="lead fs-14px">   
                                <strong>Please Note:</strong> Once the Percentage of Limitation has been reached, the creator has the ability to conduct a <strong>Coin Redistribution</strong>. 
                                Learn more about Coin Redistribution by clicking <a href="#asset-distribution">here</a>  
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row" id="how-are-mymi-assets-valued"></div>
<div class="row g-gs">
    <div class="col-xl-12">
        <div class="nk-block-head nk-block-head-lg wide-md pb-0">
            <div class="nk-block-head-content">
                <div class="card">
                    <div class="card-inner text-left">
                        <h5 class="nk-block-title fw-normal pb-3">How Are MyMI Assets Valued?</h5>
                        <div class="nk-block-des">
                            <p class="lead fs-14px">    
                                When a Asset Creator is preparing to list their MyMI Asset on the MyMI Marketplace, 
                                an evaluation of the asset valuation most be conducted to secure it's Initial Coin Value before being offered to the Marketplace. 
                                After the very first initial purchase of that MyMI Asset is completed, that locks in the Initial Price Oferring. 
                            </p>
                            <p class="lead fs-14px">   
                                As investors continue to purchase the asset, the Coin Value is determined by the Total Evaluation divided by what is left in the Percentage of Limitation to be purchased from the Marketplace.
                            </p>
                            <p class="lead fs-14px">   
                                <strong>For Example:</strong> 
                                <br>
                                <br>
                                <strong>Purchase #1:</strong>
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Coins Available</th>
                                            <th>Evaluation</th>
                                            <th>Coin Price</th>
                                            <th>Purchase Quantity</th>
                                            <th>Remaining Coins</th>
                                            <th>New Evaluation</th>
                                            <th>New Coin Price</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>100,000</td>
                                            <td>$1,000,000</td>
                                            <td>$10.00000000/Coin</td>
                                            <td>1000 Coins</td>
                                            <td>99,000</td>                                                            
                                            <td>$1,010,000.00</td>                                                            
                                            <td>$10.20202020/Coin</td>                                                            
                                        </tr>
                                    </tbody>
                                </table>
                                <br>
                                <br>
                                <strong>Purchase #2:</strong>
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Coins Available</th>
                                            <th>Evaluation</th>
                                            <th>Coin Price</th>
                                            <th>Purchase Quantity</th>
                                            <th>Remaining Coins</th>
                                            <th>New Evaluation</th>
                                            <th>New Coin Price</th>  
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>99,000</td>                                                            
                                            <td>$1,010,000</td>                                                            
                                            <td>$10.20202020/Coin</td>  
                                            <td>1000 Coins</td>  
                                            <td>98,000</td>                                                         
                                            <td>$1,020,202.02</td>                                                        
                                            <td>$10.41022469/Coin</td>                                                        
                                        </tr>
                                    </tbody>
                                </table>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $this->load->view('User/Knowledgebase/includes/Assets/asset_distribution'); ?>
<div class="row" id="coin-redistribution"></div>
<div class="row g-gs">
    <div class="col-xl-12">
        <div class="nk-block-head nk-block-head-lg wide-md pb-0">
            <div class="nk-block-head-content">
                <div class="card">
                    <div class="card-inner text-left">
                        <h5 class="nk-block-title fw-normal pb-3">Coin Redistribution</h5>
                        <div class="nk-block-des">
                            <p class="lead fs-14px">   
                                Once the Percentage of Limitation has been reached, the creator has the ability to conduct a <strong>Coin Redistribution</strong>. 
                                With this tool, the Creator would virtually duplicate the amount of coins available in the Percentage of Limitations. 
                                When conducting a Coin Redistribution, the Creator has to considered three rules:                                                
                                <dl class="row">
                                    <dt class="col-sm-3">Existing Investor Compensation</dt>
                                    <dd class="col-sm-9">{Definition Here}</dd>
                                </dl>
                                <dl class="row">
                                    <dt class="col-sm-3">Target Percentage of Limitation Totals</dt>
                                    <dd class="col-sm-9">{Definition Here}</dd>
                                </dl> 
                                <dl class="row">
                                    <dt class="col-sm-3">Market Re-Evaluation Verification</dt>
                                    <dd class="col-sm-9">{Definition Here}</dd>
                                </dl>                        
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row" id="asset-to-fiat-transfers"></div>
<div class="row g-gs">
    <div class="col-xl-12">
        <div class="nk-block-head nk-block-head-lg wide-md pb-0">
            <div class="nk-block-head-content">
                <div class="card">
                    <div class="card-inner text-left">
                        <h5 class="nk-block-title fw-normal pb-3">Asset to Fiat Transfers</h5>
                        <div class="nk-block-des">
                            <p class="lead fs-14px">   
                                                      
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row" id="mymi-marketplace-requirements"></div>
<div class="row g-gs">
    <div class="col-xl-12">
        <div class="nk-block-head nk-block-head-lg wide-md pb-0">
            <div class="nk-block-head-content">
                <div class="card">
                    <div class="card-inner text-left">
                        <h5 class="nk-block-title fw-normal pb-3">MyMI Marketplace Requirements</h5>
                        <div class="nk-block-des">
                            <p class="lead fs-14px">   
                                The following procedures are required to participate in our MyMI Exchange. Please review the following for more information:
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item"><a href="<?php echo site_url('Knowledge-Base/MyMI-Partnerships'); ?>">Partnership Accounts</a></li>
                                    <li class="list-group-item"><a href="<?php echo site_url('Knowledge-Base/KYC-Verification'); ?>">KYC Verification</a></li>
                                    <li class="list-group-item"><a href="#<?php // echo site_url('Knowledge-Base/KYC-Verification'); ?>">Additional MyMI Exchange Requirements</a></li>
                                </ul>                                 
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>