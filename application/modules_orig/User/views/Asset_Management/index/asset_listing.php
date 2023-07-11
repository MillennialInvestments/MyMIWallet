<div class="card-head">
	<div class="card-title mb-0 py-3"><h5 class="title">Asset Listings</h5></div>
	<div class="card-tools">
		<ul class="card-tools-nav">
		</ul>
	</div>
</div>
<div class="tranx-list card card-bordered">
    <?php
    if (!empty($userAssetInfo)) {
        foreach ($userAssetInfo->result_array() as $userAssets) {
            $assetPercentChange                 = round(($userAssets['current_value'] / $userAssets['initial_value']) * 100, 2);
            if ($assetPercentChange > 0) {
                $assetPercentChange             = '<span class="statusGreen">' . $assetPercentChange . '%</span>';
            } elseif ($assetPercentChange < 0) {
                $assetPercentChange             = '<span class="statusRed">' . $assetPercentChange . '%</span>';
            } else {
                $assetPercentChange             = $assetPercentChange;
            }
            echo '
            <div class="tranx-item">
                <div class="tranx-col">
                    <div class="tranx-info">
                        <div class="tranx-data">
                            <div class="tranx-label"><a href=""><strong>' . $userAssets['market'] . '</strong> - ' . $userAssets['description'] . '</a></div>
                            <div class="tranx-date"><strong>Total Value:</strong> $' . $userAssets['current_value'] . '</div>
                        </div>
                    </div>
                </div>
                <div class="tranx-col">
                    <div class="tranx-amount">
                        <div class="number">$' . $userAssets['coin_value'] . '</div>
                        <div class="number-sm">' . $assetPercentChange . '</div>
                    </div>
                </div>
            </div>
            ';
        }
    } else {
        echo '
        <div class="tranx-item">
            <div class="tranx-col">
                <div class="tranx-info">
                    <div class="tranx-data">
                        <div class="tranx-label"><a href=""><strong>ASSET NOT AVAILABLE</strong></a></div>
                        <div class="tranx-date"><strong>Total Value:</strong> $0.00</div>
                    </div>
                </div>
            </div>
            <div class="tranx-col">
                <div class="tranx-amount">
                    <div class="number">$0.00</div>
                    <div class="number-sm">0%</div>
                </div>
            </div>
        </div>
        ';
    }
    ?>
</div>
