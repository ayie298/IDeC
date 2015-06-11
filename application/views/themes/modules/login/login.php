<div class="widget black">
	 <div class="widget-title">
		<h4><i class=" icon-key"></i>Login Form</h4>
	 </div>
	 <div class="widget-body form">
        <?php $notif = $this->session->flashdata('notification'); ?>
        <?php echo !empty($notif) ? '<div class="alert">'.$this->session->flashdata('notification').'</div>' : ''; ?>

		 <!-- BEGIN FORM-->
		 <form action="<?php echo site_url('idec/login') ?>" method="post" class="form-horizontal">
			 <div class="control-group">
				 <label class="control-label" for="inputSuccess">Username </label>
				 
				 <div class="controls">
					<div class="input-prepend input-append">
						<input type="text" class="span10" name="username" id="login_email" placeholder="username"><span class="add-on"><i class="icon-user"></i></span>
					</div>
				 </div>
			 </div>

			 <div class="control-group">
				 <label class="control-label" for="inputSuccess">Password</label>
				 
				 <div class="controls">
					<div class="input-prepend input-append">
						<input type="password" class="span10" name="password" id="login_password" placeholder="password"><span class="add-on"><i class="icon-lock"></i></span>
					</div>
				</div>
				 
			 </div>

			 <div class="form-actions">
				 <button type="submit" style="width:120px"><i class='icon-signin'></i> LOGIN</button>
				 <!--<button type="button" class="btn">Forgot Password</button>-->
			 </div>
		 </form>
		 <!-- END FORM-->
	 </div>
 </div>