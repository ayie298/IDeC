<script type="text/javascript">
    $(document).ready(function(){
		$('#btn_back').click(function () {
			document.location.href="<?php echo base_url();?>idec_pms/program_detail";
		});

	});
</script>
<style type="text/css">
.white {
    background: white;
	font-size:14px;
}

</style>
<div id="popup" style="display:none">
	<div id="popup_title">Program Data</div><div id="popup_content">{popup}</div>
</div>
<div class="row-fluid">
   <div class="span12">
	   <h3 class="page-title">
		 Program Data
	   </h3>
   </div>
</div>
<div style="width:99%;background-color:#DDDDDD;-moz-border-radius:5px;border-radius:5px;padding:2px;border:3px solid #ebebeb;">
    <table width='100%' cellpadding='4' cellspacing='2' border='0' style="border: 1px solid rgb(204,209,205);background:#FFFFFF;">
    <tr id="td_loading" style="display:none" height="30">
        <td colspan="2" align="right">Processing data ....</td>
    </tr>
    <tr>
        <td colspan="2" style="font-size:20px">Indigo Incubator</td>
    </tr>
    <tr>
        <td colspan="2" style="font-size:16px">Formula F1  R2</td>
    </tr>
    <tr id="td_proses" height="30">
        <td colspan="2" align="right">
				<button class='btn' id='btn_save' type='button'>SIMPAN</button>
				<button class='btn' id='btn_back' type='button'>KEMBALI</button>
		</td>
    </tr>
    <tr valign="top">
        <td width='50%'>
		    <table width='100%' cellpadding='4' cellspacing='2' border='0' style="border: 1px solid rgb(204,209,205);background: rgb(244,244,244);">
				<tr>
					<td>Name</td><td>Value</td>
				</tr>
				<tr>
					<td>Weight</td><td>10%</td>
				</tr>
				<tr>
					<td>Target</td><td>100%</td>
				</tr>
				<tr>
					<td>Realization</td><td>106%</td>
				</tr>
				<tr>
					<td>Achievement Raw</td><td>106%</td>
				</tr>
				<tr>
					<td>Achievement </td><td>105 %</td>
				</tr>
				<tr>
					<td>Deviation</td><td>5%</td>
				</tr>
				<tr>
					<td>Analysis</td><td>Target tercapai dengan baik</td>
				</tr>
				<tr>
					<td>Evaluation</td><td>Isi evaluasi performansi</td>
				</tr>
				<tr>
					<td>Recomendation</td><td>Isi evaluasi performansi</td>
				</tr>
				<tr>
					<td>Accomplishment</td><td>10.5%</td>
				</tr>
			</table>
		</td>
        <td width='50%'>
		    <table width='100%' cellpadding='4' cellspacing='2' border='0' style="border: 1px solid rgb(204,209,205);background: rgb(244,244,244);">
				<tr>
					<td>Target: Quantity</td>
				</tr>
				<tr>
					<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;50&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Jumlah proposal diterima</td>
				</tr>
				<tr>
					<td>Realisasi</td>
				</tr>
				<tr>
					<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" value="40" style="width:50px;height:30px">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Jumlah proposal diterima</td>
				</tr>
			</table>
		</td>
    </tr>
   <tr>
        <td colspan="2">&nbsp;</td>
    </tr>
    </table>
</div>
