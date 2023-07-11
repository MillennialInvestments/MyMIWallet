<<<<<<< HEAD
<div class="nk-content nk-content-fluid pt-0">
    <div class="nk-content-inner">
        <div class="nk-content-body pt-0">
            <div class="content-page">
                <?php $this->load->view('User/Knowledgebase/includes/navigation'); ?>
                <hr class="py-3">
                <div class="row g-gs">
                    <div class="col-12 col-md-5 col-xxl-4">
                        <?php $this->load->view('User/Support/Request'); ?>
                    </div>
                    <div class="col-12 col-md-7 col-xxl-8">
=======
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
                    <div class="col-xl-4">
                        <?php $this->load->view('User/Support/Request'); ?>
                    </div>
                    <div class="col-xl-8">
>>>>>>> 76bba32f875dbfd8e00d213db849802fb5378283
                        <?php $this->load->view('User/Support/FAQs'); ?>
                    </div>
                </div>
                <hr>
                <div class="row g-gs pt-5">
                    <div class="col-xl-12">
                        <div class="nk-block-head nk-block-head-lg wide-md">
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
            </div><!-- .content-page -->
        </div>
    </div>
</div>