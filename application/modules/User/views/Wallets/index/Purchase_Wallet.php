<?php
echo '
<div class="col-xxl-3 col-lg-4 col-sm-6 mt-3">
	<div class="card card-bordered dashed h-100">
		<div class="nk-wgw-add">
            <div class="nk-wgw-inner">     
                <h6 class="title pt-4">' . $elementTitle . '</h6>
                <span class="sub-text">
                    ' . $elementText . '
                </span>

            </div>
            <div class="nk-wgw-actions">
                <ul class="vertical-divider">';
                    if ($this->config->item('integrationOperations') === 1) {
                        echo '
                    <li class="' . $btnSizing . '">
                        <a href="#" id="link-button"><i class="icon ni ni-search mr-1"></i> <span>Search</span></a>
                    </li>
                        ';
                    }; 
                echo '
                    <li class="' . $btnSizing . '">
                        <a  class="' . $btnID . '" data-toggle="modal" data-target="#transactionModal"><i class="icon ni ni-note-add mr-1"></i> <span>Manually Add</span></a>
                    </li>
                </ul>
            </div>
		</div>
	</div>
</div>
';
?>


