<div class="widget red">
	 <div class="widget-title">
		<h4><i class=" icon-key"></i>Profile</h4>
	 </div>
	 <div class="widget-body form">
        <?php $notif = $this->session->flashdata('notification'); ?>
        <?php echo !empty($notif) ? '<div class="alert">'.$this->session->flashdata('notification').'</div>' : ''; ?>
		<div style="float:left;position:relative;font-weight:bold;padding-top:2px;padding-left:5px;width:170px"><i class='icon-user' style='font-size:18px;padding-right:5px'></i> <?php echo $user->username ?></div>
		<div style="float:left;position:relative;padding-left:5px;"><?php echo ucfirst($user->level_name)?></div>
		<div id="clear">&nbsp;</div>
		<div id="clear">&nbsp;</div>
		<div id="clear">&nbsp;</div>
		<div style="float:left;position:relative;font-weight:bold"><?php echo anchor(base_url()."profile","<i class='icon-info-sign' style='font-size:16px;'></i>  My Profile ","class=link2")?></div>
		<div id="clear">&nbsp;</div>
		<div style="float:left;position:relative;font-weight:bold;"><?php echo anchor(base_url()."idec/logout","<i class='icon-signout' style='font-size:16px;'></i>  Logout ","class=link2")?></div>
		<div id="clear">&nbsp;</div>
	 </div>
 </div>