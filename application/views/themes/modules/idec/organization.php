<script>
	$(function(){
       $("#bar_profile").click();
       
    }); 
	
	function poping(unit, id){
		var theme = "arctic";
		$("#popup_content").html("<div style='text-align:center'><br><br><br><br><img src='<?php echo base_url();?>media/images/indicator.gif' alt='loading content.. '><br>loading</div>");
		$.post("<?php echo site_url('idec/organization/detail');?>","id=" + id + "&level=" + unit, function(response) {
				$("#popup_content").html(response);
			});
		$("#popup").jqxWindow({
			theme: theme, resizable: false,
			width: 700,
			height: 450,
			isModal: true, autoOpen: false, modalOpacity: 0.2
		});
		$("#popup").jqxWindow('open');

	}
</script>
<div id="popup" style="display:none">
	<div id="popup_title">Organization Structure</div>
	<div id="popup_content">
		
	</div>
</div>
<div class="row-fluid">
   <div class="span12">
	   <h3 class="page-title">
		 Organization Structure 
	   </h3>
   </div>
</div>
<iframe id="preview-frame" src="<?php echo base_url();?>idec/organization/tree" name="preview-frame" frameborder="0" noresize="noresize" height="450" width="100%" scrolling="no"></iframe>