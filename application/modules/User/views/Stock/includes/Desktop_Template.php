<section class="cid-s0KKUOB7cY bg-white p-0">
    <div class="container-fluid px-0 pt-3">
		<div class="row justify-content-center">
			<div class="col-12 col-md-12 col-lg-10 grid-margin stretch-card">
				<div class="card">
					<div class="card-body">
						<div class="row justify-content-center">
							<div class="col-12 text-center">
								<ul class="nav nav-pills">
									<li class="nav-item"> 
										<a class="nav-link active" data-toggle="pill" href="#fundamentals">Fundmentals</a>
									</li>
									<li class="nav-item">
										<a class="nav-link" data-toggle="pill" href="#discussions">Discussions</a>
									</li>
									<li class="nav-item">
										<a class="nav-link" data-toggle="pill" href="#research">Trade Research</a>
									</li>
								</ul>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<div class="tab-content">
	<div class="tab-pane container-fluid active" id="fundamentals">
		<section class="cid-s0KKUOB7cY bg-white p-0">
			<div class="container-fluid px-0">
				<div class="row justify-content-center">
					<div class="col-12 col-sm-12 col-md-12 col-lg-10 grid-margin stretch-card">
						<div class="card">
							<div class="card-body">
								<div class="row">
									<div class="col-12">
										<?php
                                        if (!empty($getStockInfo = $this->stock_model->get_trade_alert($symbol))) {
                                            $this->load->view('includes/Stock_Overview', $data);
                                        }
                                        ?>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
		<section class="cid-s0KKUOB7cY bg-white p-0">
			<div class="container-fluid px-0">
				<div class="row justify-content-center">
					<div class="col-12 col-sm-12 col-md-12 col-lg-10 grid-margin stretch-card">
						<div class="card">
							<div class="card-body">
								<div class="row">
									<div class="col-sm-12 col-md-8 col-lg-9">
										<?php
                                        $this->load->view('includes/Fundamental_Data', $data);
                                        ?>
									</div>
									<div class="col-sm-12 col-md-2 col-lg-3">
										<?php
                                        $this->load->view('includes/Company_Profile', $data);
                                        ?>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
	</div>
	<div class="tab-pane container-fluid fade" id="research">
		<section class="cid-s0KKUOB7cY bg-white p-0">
			<div class="container-fluid px-0">
				<div class="row justify-content-center">
					<div class="col-12 col-sm-12 col-md-12 col-lg-10 grid-margin stretch-card">
						<div class="card">
							<div class="card-body">
								<div class="row">
									<div class="col-12">
									<?php
                                        if (! empty($cuID)) {
                                            ?>
											<div class="col-10">
												<?php $this->load->view('includes/Stock_Research', $data); ?>
											</div>
											<div class="col-10 border-bottom">
												<?php //$this->load->view('Forms/Post/Add_Research', $data);?>
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
		</section>
	</div>
	<div class="tab-pane container-fluid fade" id="discussions">
		<section class="cid-s0KKUOB7cY bg-white p-0">
			<div class="container-fluid px-0">
				<div class="row justify-content-center">
					<div class="col-12 col-sm-12 col-md-12 col-lg-10 grid-margin stretch-card">
					<?php
                        if (! empty($cuID)) {
                            //$this->load->view('includes/Discussions');
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
		</section>
	</div>
</div>
