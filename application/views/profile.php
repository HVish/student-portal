<!--main content start-->
<section id="main-content">
	<section class="wrapper">
		<!-- page start-->
		<div class="row">
			<div class="col-md-12">
				<section class="panel">
					<div class="panel-body profile-information">
						<div class="col-md-3">
							<div class="profile-pic text-center">
								<img src="<?php echo base_url('assets/images/lock_thumb.jpg'); ?>" alt="">
							</div>
						</div>
						<div class="col-md-9">
							<div class="profile-summary" style="border: 0px;">
								<h1>Vishnu Singh</h1>
								<span class="text-muted">Computer Science Engineering</span>
								<p>
									<br> Date of Birth: 16 July 1995
									<br> Gender: Male
									<br> Contact: 7790812187
									<br> Email: vishnusingh.cse17@jecrc.ac.in
								</p>
							</div>
						</div>

					</div>
				</section>
			</div>
			<div class="col-md-12">
				<section class="panel">
					<div class="panel-body">
						<div class="position-center">
							<form role="form" class="form-horizontal">
								<div class="prf-contacts sttng">
									<h2>Update Information</h2>
								</div>
								<div class="form-group">
									<label class="col-lg-2 control-label">Image</label>
									<div class="col-lg-6">
										<!-- <input type="file" id="exampleInputFile" class="file-pos"> -->
										<div class="fileupload fileupload-new" data-provides="fileupload">
											<div class="fileupload-new thumbnail" style="width: 200px; height: 150px;">
												<img src="<?php echo base_url('assets/images/no-image.png') ?>" alt="No Image" />
											</div>
											<div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 200px; max-height: 150px; line-height: 20px;"></div>
											<div>
												<span class="btn btn-white btn-file">
                                                   <span class="fileupload-new"><i class="fa fa-paper-clip"></i> Select image</span>
												<span class="fileupload-exists"><i class="fa fa-undo"></i> Change</span>
												<input type="file" class="default" />
												</span>
												<a href="#" class="btn btn-danger fileupload-exists" data-dismiss="fileupload"><i class="fa fa-trash"></i> Remove</a>
											</div>
										</div>
									</div>
								</div>
								<div class="form-group">
									<label class="col-lg-2 control-label">Semester</label>
									<div class="col-lg-6">
										<select class="form-control input-sm m-bot15">
			                                <option value="1">1</option>
			                                <option value="2">2</option>
			                                <option value="3">3</option>
			                                <option value="4">4</option>
			                                <option value="5">5</option>
			                                <option value="6">6</option>
			                                <option value="7">7</option>
			                                <option value="8">8</option>
			                            </select>
									</div>
								</div>
								<div class="form-group">
									<label class="col-lg-2 control-label">Address</label>
									<div class="col-lg-6">
										<textarea rows="4" cols="20" class="form-control" id="" name=""></textarea>
									</div>
								</div>
								<div class="form-group">
									<label class="col-lg-2 control-label">Phone</label>
									<div class="col-lg-6">
										<input type="text" placeholder=" " id="phone" class="form-control">
									</div>
								</div>
								<div class="form-group">
									<label class="col-lg-2 control-label">Mobile</label>
									<div class="col-lg-6">
										<input type="text" placeholder=" " id="mobile" class="form-control">
									</div>
								</div>
								<div class="form-group">
									<label class="col-lg-2 control-label">Alt-Mobile</label>
									<div class="col-lg-6">
										<input type="text" placeholder=" " id="altmobile" class="form-control">
									</div>
								</div>
								<div class="form-group">
									<label class="col-lg-2 control-label">Email</label>
									<div class="col-lg-6">
										<input type="text" placeholder=" " id="email" class="form-control">
									</div>
								</div>
								<div class="form-group">
									<label class="col-lg-2 control-label">Alt-Email</label>
									<div class="col-lg-6">
										<input type="text" placeholder=" " id="altemail" class="form-control">
									</div>
								</div>
								<div class="form-group">
									<div class="col-lg-offset-2 col-lg-10">
										<button class="btn btn-primary" type="submit">Save</button>
										<button class="btn btn-default" type="button">Cancel</button>
									</div>
								</div>
							</form>
						</div>
					</div>
				</section>
			</div>
		</div>
		<!-- page end-->
	</section>
</section>
<!--main content end-->
