<?php
$symbol = $this->uri->segment(3);
?>
<section class="cid-s0KKUOB7cY py-0" id="header01-m">
    <div class="container-fluid px-0">
		<div class="row">
			<div class="col-sm-12 col-md-12 col-lg-12 grid-margin stretch-card mb-0">
				<div class="card">
					<div class="card-body p-0">
						<div class="row justify-content-center pt-3 mb-0">
							<div class="col-sm-12 col-md-12 col-lg-12 pt-4 pr-0">
								<?php
                                //~ $this->load->view('Stocks/includes/Symbol_Info');
                                $this->load->view('Stock/includes/Mobile/Advanced_Real_Time_Chart', $data);
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
							<div class="col-12">
								<?php $this->load->view('includes/Mobile/Stock_Overview', $data); ?>
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
							<div class="col-12 col-sm-12 col-md-2 col-lg-3">
								<?php
                                $this->load->view('includes/Mobile/Company_Profile', $data);
                                ?>
							</div>
							<div class="col-12 col-sm-12 col-md-8 col-lg-9">
								<?php
                                $this->load->view('includes/Mobile/Fundamental_Data', $data);
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
							<div class="col-12">
							<?php
                                if (! empty($cuID)) {
                                    ?>
									<div class="col-12 col-sm-12 col-md-12">
										<?php $this->load->view('includes/Mobile/Stock_Research', $data); ?>
									</div>
									<div class="col-12 col-sm-12 col-md-12">
										<?php $this->load->view('Forms/Post/Add_Research', $data); ?>
									</div>
								<?php
                                } else {
                                    echo '
									<div class="col-12">
										<h4 class="card-title text-center">Due Diligence Database</h4>
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
<?php
/*
<section class="cid-s0KKUOB7cY bg-white p-0">
    <div class="container-fluid px-0">
        <div class="row justify-content-center">
            <div class="col-12 col-sm-12 col-md-12 col-lg-10 grid-margin stretch-card">
            <?php
                if (! empty($cuID)) {
                    $this->load->view('includes/Discussions');
                } else {
                    echo '
                    <div class="col-12 col-sm-12 col-md-12">
                        <h4 class="card-title text-center">Due Diligence/Research</h4>
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
* */
?>
