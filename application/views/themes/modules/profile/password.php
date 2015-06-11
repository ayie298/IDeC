<script type="text/javascript">
    $(document).ready(function(){
       $("button,submit,reset").jqxInput({ theme: 'fresh', height: '29px', width: '54px' });
       $("#btnSimpan").click(function(){
            $("#divFormPassword").hide();
            $("#divLoadPassword").css("display","block");
            $("#divLoadPassword").html("<div style='text-align:center;margin-top: 70px'><br><br><br><br><img src='<?php echo base_url();?>media/images/loaderB64.gif' alt='loading content.. '><br>loading</div>");
         //   alert($("#frmDataPassword").serialize());
            $.ajax({
                type: "POST",
                data: $("#frmDataPassword").serialize(),
                url: "<?php echo site_url('profile/update_password'); ?>",
                success: function(response){
                    if(response=="1"){
                        $.notific8('Notification', {
    					  life: 5000,
    					  message: 'Save data succesfully.',
    					  heading: 'Saving data',
    					  theme: 'lime'
    					});
                        
                        $("#divLoadPassword").css("display","none");
                        $.ajax({
                           type: "POST",
                           url: "<?php echo site_url('profile/form_password'); ?>",
                           success: function(response){
                             $("#divFormPassword").show();
                             $("#divFormPassword").html(response);
                           } 
                        });
                        
                    }else{
                        $.notific8('Notification', {
    					  life: 5000,
    					  message: response,
    					  heading: 'Saving data FAIL',
    					  theme: 'red'
    					});
                        
                        $("#divLoadPassword").css("display","none");
                        $.ajax({
                           type: "POST",
                           url: "<?php echo site_url('profile/form_password'); ?>",
                           success: function(response){
                             $("#divFormPassword").show();
                             $("#divFormPassword").html(response);
                           } 
                        });
                    }    
                }
             });
       });
    });
</script>
<div style="display: none;" id="divLoadPassword"></div>
<div style="padding:5px;text-align:center" id="divFormPassword">
<div class="notice"></div>
<?php echo form_open('', 'id="frmDataPassword"') ?>
    <div style="background: #F4F4F4;padding: 5px;text-align: right;">
        <span style="float: left;padding: 5px;display: block;color: black;" id="msg">Username : <?php echo $this->user->row()->username ?></span>
        <button type="button" id="btnSimpan">Simpan</button>
	    <button type="reset">Ulang</button>
    </div>
	<br />
	<br />
	<table border="0" cellpadding="0" cellspacing="8" class="panel" align="left">
		<tr>
			<td>
                <table border="0" cellpadding="3" cellspacing="2" style="font-size: 12px;color: black">
				    <tr>
                        <td>Password Lama</td>
                        <td>:</td>
                        <td>
                            <input type="hidden" name="id" value="<?php echo $this->user->row()->id_user ?>"/>
                            <input type="password" size="20" class="input" name="password_old" style="height: 25px;"/>
                        </td>
                    </tr>
				    <tr>
                        <td>Password Baru</td>
                        <td>:</td>
                        <td>
                            <input type="password" size="20" class="input" name="password" style="height: 25px;"/>
                        </td>
                    </tr>
                    <tr>
                        <td>Konfirmasi Password Baru</td>
                        <td>:</td>
                        <td>
                            <input type="password" size="20" class="input" name="password2" style="height: 25px;"/>
                        </td>
                    </tr>
                    <tr>
						<td colspan="3" height="30">&nbsp;</td>
					</tr>
				</table>
            </td>
		</tr>
	</table>
</form>
</div>