<?php 
$userData               = array(
    'redirectURL'       => $redirectURL,
    'date'              => $date,
    'hostTime'          => $hostTime, 
    'exchange'          => $exchange,
    'symbol'            => $symbol,
    'cuID'              => $cuID,
    'cuRole'            => $cuRole,
);
?>
<div class="nk-block">
	<div class="row gy-gs">
		<div class="col-lg-12 col-xl-12">
            <div class="nk-block">
                <div class="card">
                    <div class="card-inner">
                        <ul class="nav nav-pills">
                            <li class="nav-item"> 
                                <a class="nav-link active" data-bs-toggle="tab" href="#fundamentals">Fundmentals</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-bs-toggle="tab" href="#discussions">Discussions</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-bs-toggle="tab" href="#research">Trade Research</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>    
		</div>
	</div>
</div>
<div class="tab-content">
	<div class="tab-pane active" id="fundamentals">
        <!-- <?php
        // $getStockInfo       = $this->stock_model->get_trade_alert($symbol);
        // if (!empty($getStockInfo)) {
            ?>
        <section class="cid-s0KKUOB7cY bg-white p-0">
			<div class="container-fluid px-0">
				<div class="row justify-content-center">
					<div class="col-12 col-sm-12 col-md-12 col-lg-10 grid-margin stretch-card">
						<div class="card">
							<div class="card-body">
								<div class="row">
									<div class="col-12">
                                        <?php // $this->load->view('includes/Stock_Overview', $userData); ?>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
        <?php
        //}
        ?> -->
        <div class="nk-block">
            <div class="row gy-gs">
                <div class="col-lg-12 col-xl-12">
                    <div class="nk-block">
                        <div class="card">
                            <div class="card-inner">
								<div class="row">
									<div class="col-sm-12 col-md-9 col-lg-9 col-xxl-8">
										<?php
                                        $this->load->view('includes/Fundamental_Data', $userData);
                                        ?>
									</div>
									<div class="col-sm-12 col-md-3 col-lg-3 col-xxl-4">
										<?php
                                        $this->load->view('includes/Company_Profile', $userData);
                                        ?>
									</div>
								</div>
                            </div>
                        </div>
                    </div>    
                </div>
            </div>
        </div>
	</div>
	<div class="tab-pane" id="research">
        <div class="nk-block">
            <div class="row gy-gs">
                <div class="col-lg-12 col-xl-12">
                    <div class="nk-block">
                        <div class="card">
                            <div class="card-inner">
								<div class="row">
									<div class="col-12">
									<?php
                                        if (!empty($cuID)) {
                                            ?>
											<div class="col-10">
												<?php $this->load->view('includes/Stock_Research', $userData); ?>
											</div>
											<div class="col-10 border-bottom">
												<?php $this->load->view('User/Post/Add_Research', $userData);?>
											</div>
										<?php
                                        } else {
                                            echo '
											<div class="col-12">
												<h1 class="card-title">' . $symbol . ' Daily Trade Discussions</h1>
												<p class="card-text text-center display-4 border-top border-bottom py-5">
													<a href="">Log In</a> or <a href="">Register Free</a> To Access Our Conducted Due Diligence &amp; Stock Research!
												</p>
											</div>
											';
                                        }
                                    ?>
									</div>
								</div>
                            </div>
                        </div>
                    </div>    
                </div>
            </div>
        </div>
	</div>
	<div class="tab-pane" id="discussions">
        <div class="nk-block">
            <div class="row gy-gs">
                <div class="col-lg-12 col-xl-12">
                    <div class="nk-block">
                        <div class="card">
                            <div class="card-inner">
								<div class="row">
									<div class="col-12">
                                        <?php
                                            if (!empty($cuID)) {
                                                $this->load->view('includes/Discussions');
                                            } else {
                                                echo '
                                                <div class="col-12">
                                                    <h1 class="card-title">' . $symbol . ' Compiled Due Diligence &amp; Research</h1>
                                                    <p class="card-text text-center display-4 border-top border-bottom py-5">
                                                        <a href="">Log In</a> or <a href="">Register Free</a> To Access Our Conducted Due Diligence &amp; Stock Research!
                                                    </p>
                                                </div>
                                                ';
                                            }
                                        ?>
									</div>
								</div>
                            </div>
                        </div>
                    </div>    
                </div>
            </div>
        </div>
	</div>
</div>
