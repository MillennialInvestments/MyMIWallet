<div class="nk-content nk-content-fluid">
    <div class="nk-content-inner">
        <div class="nk-content-body">
            <div class="content-page">
                <div class="row g-gs">
                    <div class="col-xl-12"></div>
                </div>
                <?php $this->load->view('User/Knowledgebase/includes/navigation'); ?>
                <hr class="py-3">
                <div class="row g-gs">
                    <div class="col-xl-12">
                        <div class="nk-block-head nk-block-head-lg wide-md pb-0">
                            <div class="nk-block-head-content">
                                <div class="nk-block-head-sub"><span>Guides &amp; Tutorials</span></div>
                                <h2 class="nk-block-title fw-normal">Suggested Tutorials</h2>
                                <div class="nk-block-des">
                                    <p class="lead"></p>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-inner p-0">
                                <div class="nk-block-content">
                                    <?php $this->load->view('User/Knowledgebase/Tutorials'); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row g-gs">
                    <div class="col-xl-12">
                        <div class="nk-block-head nk-block-head-lg wide-md pb-0">
                            <div class="nk-block-head-content">
                                <h6 class="nk-block-title fw-normal">Promoted Articles</h6>
                                <div class="nk-block-des">
                                    <p class="lead"></p>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="card">
                            <div class="card-inner p-0">
                                <div class="nk-block-content">
                                    <?php $this->load->view('User/Knowledgebase/Promoted_Articles'); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!-- .content-page -->
        </div>
    </div>
</div>