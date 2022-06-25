<div class="card-head">
	<div class="card-title mb-0 py-3"><h5 class="title">Asset Requests</h5></div>
	<div class="card-tools">
		<ul class="card-tools-nav">
		</ul>
	</div>
</div>
<div class="tranx-list card card-bordered">
    <?php
    if(!empty($assetListingRequest->result_array())) {
        foreach ($assetListingRequest->result_array() as $userRequests) {
            if (!empty($userRequests['symbol'])) {
                if ($userRequests['status'] === 'Pending') {
                    echo '
                    <div class="tranx-item">
                        <div class="tranx-col">
                            <div class="tranx-info">
                                <div class="tranx-data">
                                    <div class="tranx-label"><a href=""><strong>' . $userRequests['symbol'] . '</strong> - ' . $userRequests['coin_name'] . '</a></div>
                                    <div class="tranx-date"><strong>Status: </strong>' . $userRequests['status'] . '</div>
                                </div>
                            </div>
                        </div>
                        <div class="tranx-col">
                            <div class="tranx-amount">
                                <div class="number"><a class="btn btn-primary btn-sm" href="">Details</a></div>
                                <div class="number-sm"></div>
                            </div>
                        </div>
                    </div>
                    ';
                } elseif ($userRequests['status'] === 'Started') {
                    echo '
                    <div class="tranx-item">
                        <div class="tranx-col">
                            <div class="tranx-info">
                                <div class="tranx-data">
                                    <div class="tranx-label"><a href=""><strong>Asset Request Submitted</strong></a></div>
                                    <div class="tranx-date"><strong>Status:</strong> Not Completed</div>
                                </div>
                            </div>
                        </div>
                        <div class="tranx-col">
                            <div class="tranx-amount">
                                <div class="number"><a class="btn btn-primary btn-sm text-white createAssetRequest" data-toggle="modal" data-target="#transactionModal">Create Asset!</a></div>
                                <div class="number-sm"></div>
                            </div>
                        </div>
                    </div>
                    ';
                }
            }
        }
    } else {
        echo '
        <div class="tranx-item">
            <div class="tranx-col">
                <div class="tranx-info">
                    <div class="tranx-data">
                        <div class="tranx-label"><a href=""><strong>No Existing Asset Request</strong></a></div>
                        <div class="tranx-date"><strong>Status:</strong> Not Started</div>
                    </div>
                </div>
            </div>
            <div class="tranx-col">
                <div class="tranx-amount">
                    <div class="number"><a class="btn btn-primary btn-sm text-white createAssetRequest" data-toggle="modal" data-target="#transactionModal">Create Asset!</a></div>
                    <div class="number-sm"></div>
                </div>
            </div>
        </div>
        ';
    }
    ?>
</div>
