<script>
	function close_evaluasi(){
		$("#popup_evaluasi").jqxWindow('close');
	}

	function edit_evaluasi(id){
		var offset = $("#jqxgrid").offset();
		$("#popup_evaluasi").jqxWindow({
			theme: theme, resizable: false,
			width: 550,
			height: 350,
			isModal: true, autoOpen: false, modalOpacity: 0.2
		});
		$("#popup_evaluasi").jqxWindow('open');
	}

</script>
<div id="popup_evaluasi" style="display:none">
	<div id="popup_title">Program / Evaluasi</div>
	<div id="popup_content">
			<table width='100%' cellpadding='4' cellspacing='2' border='0' style="border: 1px solid rgb(204,209,205);background: rgb(244,244,244);font-size:12px">
			<tr>
				<td colspan="3" style="font-size:16px;font-weight:bold">Add / Edit Evaluasi</td>
			</tr>
			<tr>
				<td width='25%'>Type</td>
				<td width='1%'>:</td>
				<td class="white">
					<select size="1" class="input" name="Status" id="Type" style="width:300px;margin: 0;">
						<option>Evaluasi Process</option>
						<option>Evaluasi Output</option>
					</select>
				</td>
			</tr>
			<tr>
				<td width='25%'>Deskripsi</td>
				<td width='1%'>:</td>
				<td class="white">
					<textarea name="Deskripsi" placeholder="Deskripsi" style="margin: 0;height:120px;width:360px"/> </textarea>
				</td>
			</tr>
			<tr>
				<td width='25%'>File Upload</td>
				<td width='1%'>:</td>
				<td class="white"><input type="file"/></td>
			</tr>
			<tr id="td_proses" height="30">
				<td colspan="3" align="right">
					<button style='width:120px' id='btn_add_act' onClick='close_evaluasi()' type='button'>ADD</button>
					<button style='width:120px' id='btn_cancel_act' onClick='close_evaluasi()' type='button'>CANCEL</button>
				</td>
			</tr>
		</table>
	</div>
</div>
<div>
	<div style="width:99%;background-color:#FFF;-moz-border-radius:5px;border-radius:5px;padding:2px;border:3px solid #ebebeb;">
		<div class="row-fluid" style="width:85%">
			<div class="widget-body">
				<div class="alert alert-info" style="position:relative;">
					<button data-dismiss="alert" class="close">x</button>
					<div style="float:left;width:90%;position:relative"><strong>AJI WIDODO</strong> </div>
					<div style="float:left;width:16%;position:relative;text-align:left"> 12 Mei 2014 14:55</div>
					<div style="float:left;width:90%;position:relative;font-weight:bold">Assesment Implementasi Web Conference</div>
					<div style="float:left;width:90%;position:relative">Evaluasi Process</div>
					<div style="float:left;width:90%;position:relative"> Performance management telah menambahkan review stream mingguan.</div>
					<div style="clear:both">&nbsp;</div>
				</div>
				<div class="alert alert-success" style="height: 90px;">
					<button data-dismiss="alert" class="close">x</button>
					<div style="float:left;width:90%;position:relative"><strong>ANNA LUMUMBA</strong> </div>
					<div style="float:left;width:16%;position:relative;text-align:left"> 13 June 2014 18:00</div>
					<div style="float:left;width:90%;position:relative;font-weight:bold">Assesment Implementasi Web Conference</div>
					<div style="float:left;width:90%;position:relative">Evaluasi Process</div>
					<div style="float:left;width:90%;position:relative">Project Riset Web Security Assessment  untuk Peningkatan Efektifitas Pengelolaan Aplikasi dan Situs WEB TELKOM telah ditambahkan, segera perbaharui aktifitas untuk project ini<br></div>
					<div style="clear:both">&nbsp;</div>
				</div>
				<div class="alert alert-success" style="height: 90px;">
					<button data-dismiss="alert" class="close">x</button>
					<div style="float:left;width:90%;position:relative"><strong>AJI WIDODO</strong> </div>
					<div style="float:left;width:16%;position:relative;text-align:left"> 13 June 2014 17:00</div>
					<div style="float:left;width:90%;position:relative;font-weight:bold">Assesment Implementasi UC Video Conference</div>
					<div style="float:left;width:90%;position:relative">Evaluasi Output</div>
					<div style="float:left;width:90%;position:relative">Project Kajian Broadband Satelite pada Frekuensi Ka Band baru telah ditambahkan, segera perbaharui aktifitas untuk project ini<br></div>
					<div style="clear:both">&nbsp;</div>
				</div>
			</div>
		</div>
	</div>
</div>