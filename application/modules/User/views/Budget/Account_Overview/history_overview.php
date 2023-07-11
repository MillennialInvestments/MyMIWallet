<div class="card card-bordered h-100">
    <div class="card-inner mb-n2">
        <div class="card-title-group">
            <div class="card-title card-title-sm">
                <h6 class="title">Last 5 Transactions</h6>
            </div>
            <div class="card-tools">
                <div class="drodown">
                    <a href="#" class="dropdown-toggle dropdown-indicator btn btn-sm btn-outline-light btn-white" data-bs-toggle="dropdown">30 Days</a>
                    <div class="dropdown-menu dropdown-menu-end dropdown-menu-xs">
                        <ul class="link-list-opt no-bdr">
                            <li><a href="#"><span>7 Days</span></a></li>
                            <li><a href="#"><span>15 Days</span></a></li>
                            <li><a href="#"><span>30 Days</span></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="nk-tb-list is-loose">
            <div class="nk-tb-item nk-tb-head">
                <div class="nk-tb-col">
                    <span>Source Type</span>
                </div>
                <div class="nk-tb-col text-end">
                    <span>Name</span>
                </div>
                <div class="nk-tb-col">
                    <span>Net Amount</span>
                </div>
                <div class="nk-tb-col tb-col-sm text-end">
                    <span>YTD Summary</span>
                </div>
                <div class="nk-tb-col tb-col-sm text-end">
                    <span>% of Total <?php echo $accountType; ?></span>
                </div>
            </div>

            <?php
            $this->db->select('source_type, name, net_amount, submitted_on');
            $this->db->from('bf_users_budgeting');
            $this->db->where('account_type', 'Income');
            $this->db->where('paid', 1);
            $this->db->order_by('submitted_on', 'DESC');
            $this->db->limit(5);
            $sourceRecords = $this->db->get()->result_array();

            foreach ($sourceRecords as $sourceRecord) {
                $sourceType = $sourceRecord['source_type'];
                $sourceName = $sourceRecord['name'];
                $netAmount = $sourceRecord['net_amount'];
                $submittedOn = $sourceRecord['submitted_on'];
                $yearToDateSummary = $this->db->select_sum('net_amount')->from('bf_users_budgeting')->where('account_type', 'Income')->where('paid', 1)->where('submitted_on <=', $submittedOn)->get()->row()->net_amount;
                $percentage = ($netAmount / $yearToDateSummary) * 100;

                echo '<div class="nk-tb-item">
                        <div class="nk-tb-col">
                            <div class="icon-text">
                                <em class="text-primary icon ni ni-money"></em>
                                <span class="tb-lead">' . $sourceType . '</span>
                            </div>
                        </div>
                        <div class="nk-tb-col text-end">
                            <span class="tb-sub tb-amount"><span>' . $sourceName . '</span></span>
                        </div>
                        <div class="nk-tb-col text-end">
                            <span class="tb-sub tb-amount"><span>$' . $netAmount . '</span></span>
                        </div>
                        <div class="nk-tb-col tb-col-sm text-end">
                            <span class="tb-sub">$' . number_format($yearToDateSummary, 2) . '</span>
                        </div>
                        <div class="nk-tb-col">
                            <div class="progress progress-md progress-alt bg-transparent">
                                <div class="progress-bar" data-progress="' . $percentage . '" style="width: ' . $percentage . '%;"></div>
                                <div class="progress-amount">' . number_format($percentage, 2) . '%</div>
                            </div>
                        </div>
                    </div>';
            }
            ?>

        </div>
    </div>
</div>
