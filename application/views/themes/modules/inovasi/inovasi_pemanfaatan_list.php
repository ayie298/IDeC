<script>
	$(function(){
 	   $("#btn_add_pemanfaatan,#btn_save_pemanfaatan,#btn_close_pemanfaatan").jqxButton({ height: 28, theme: theme });

 		$("#btn_add_pemanfaatan").click(function () {
			edit_pemanfaatan(1);
		});
	});

	function close_pemanfaatan(){
		$("#popup_pemanfaatan").jqxWindow('close');
	}
	function edit_pemanfaatan(id){
		var offset = $("#jqxgrid").offset();
		$("#popup_pemanfaatan").jqxWindow({
			theme: theme, resizable: false,
			width: 600,
			height: 300,
			isModal: true, autoOpen: false, modalOpacity: 0.2
		});
		$("#popup_pemanfaatan").jqxWindow('open');
	}

</script>
<div id="popup_pemanfaatan" style="display:none">
	<div id="popup_title">Document</div>
	<div id="popup_content">
    	<table class='tbl-form'>
			<tr>
				<td style="font-size:16px;font-weight:bold">Tambah Pemanfaatan</td>
			</tr>
			<tr>
				<td class="white">
					<textarea name="Deskripsi" id="Deskripsi" placeholder="Deskripsi" cols="500" rows="12" style="width:99%"></textarea>
				</td>
			</tr>
			<tr height="30">
				<td align="right">
					<button style='width:120px' id='btn_save_pemanfaatan' onClick='close_pemanfaatan()' type='button'><i class='icon-save'></i> ADD</button>
					<button style='width:120px' id='btn_close_pemanfaatan' onClick='close_pemanfaatan()' type='button'><i class='icon-ban-circle'></i> CANCEL</button>
				</td>
			</tr>
		</table>
	</div>
</div>
<div>
	<div class="row-fluid" style="width:100%">
		<div class="widget-body">
			<button style='width:200px;float:right' id='btn_add_pemanfaatan' type='button'><i class='icon-external-link-sign'></i> Tambah Pemanfaatan</button>
		</div>
		<div class="widget-body">
			<div class="alert alert-info" style="position:relative;">
				<button data-dismiss="alert" class="close">Delete <i class='icon-remove-circle'></i></button>
				<div style="float:left;width:99%;position:relative"><strong>Kurnia</strong> </div>
				<div style="float:left;width:99%;position:relative;"> 12 Mei 2014 14:55</div>
				<div style="float:left;width:99%;position:relative">Hasil inovasi telah di install dan digunakan di bidang General Affair.</div>
				<div style="clear:both">&nbsp;</div>
			</div>
			<div class="alert alert-info" style="position:relative;">
				<button data-dismiss="alert" class="close">Delete <i class='icon-remove-circle'></i></button>
				<div style="float:left;width:99%;position:relative"><strong>Kurnia</strong> </div>
				<div style="float:left;width:99%;position:relative;"> 12 Juni 2014 14:55</div>
				<div style="float:left;width:99%;position:relative">Hasil inovasi telah di install dan digunakan di bidang General Affair.</div>
				<div style="clear:both">&nbsp;</div>
			</div>
		</div>
	</div>
</div>