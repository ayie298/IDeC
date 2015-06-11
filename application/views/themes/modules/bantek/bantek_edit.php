<script type="text/javascript">
    $(document).ready(function(){
		$("#bar_rms").click();
 		$("#btn_save,#btn_back").jqxButton({ height: 28, theme: theme });
		$('#jqxTabs').jqxTabs({ width: '1200px', height: '700', position: 'top', theme: theme });
		$('#btn_back').click(function () {
			document.location.href="<?php echo base_url();?>idec_rms/bantek";
		});
	});
</script>
<style type="text/css">
.white {
    background: white;
}

</style>
<div id="popup" style="display:none">
	<div id="popup_title">BANTEK Edit</div><div id="popup_content">{popup}</div>
</div>
<div class="row-fluid">
   <div class="span12">
	   <h3 class="page-title">
		 Edit BANTEK
	   </h3>
   </div>
</div>
<div style="width:99%;background-color:#DDDDDD;-moz-border-radius:5px;border-radius:5px;padding:2px;border:3px solid #ebebeb;">
    <table width='100%' cellpadding='4' cellspacing='2' border='0' style="border: 1px solid rgb(204,209,205);background: rgb(244,244,244);">
    <tr id="td_loading" style="display:none" height="30">
        <td colspan="6" align="right">Processing data ....</td>
    </tr>
    <tr id="td_proses" height="30">
        <td colspan="6" align="right">
			<button style='width:120px' id='btn_save' type='button'>SIMPAN</button>
			<button style='width:120px' id='btn_back' type='button'>KEMBALI</button>
		</td>
    </tr>
	<tr valign='top'>
		<td width='18%'>User</td>
		<td width='1%'>:</td>
		<td class="white">
			<input type="text" size="20" name="User" id="User" placeholder="User" style="margin: 0;height: 30px;"/> 
		</td>
        <td width='10%'>Status</td>
        <td width='1%'>:</td>
        <td class="white">
			<select size="1" class="input" name="Status" id="Status" style="width:100px;margin: 0;">
				<option>on going</option>
				<option>close</option>
			</select>
		</td>
    </tr>
	<tr valign='top' height='30'>
        <td width='10%'>Judul</td>
        <td width='1%'>:</td>
        <td class="white"><textarea placeholder="Judul" rows='4' style='width:400px'></textarea></td>
        <td width='10%'>Unit Kerja Eksekutor</td>
        <td width='1%'>:</td>
        <td class="white">
        	<input type="checkbox"> INNOVATION MANAGEMENT<br>
        	<input type="checkbox"> INFRASTRUCTURE RESEARCH & DEVELOPMENT<br>
        	<input type="checkbox"> PRODUCT INFRASTRUCTURE ASSURANCE<br>
        	<input type="checkbox"> DIGITAL LIFESTYLE ECOSYSTEM<br>
        	<input type="checkbox"> DIGITAL SOLUTION ECOSYSTEM<br>
        	<input type="checkbox"> GENERAL AFFAIRS<br>
        	<input type="checkbox"> MOBILE ECOSYSTEM<br>
        	<input type="checkbox"> M2M DIGITAL ECOSYSTEM<br>
		</td>
    </tr>
    <tr>
        <td colspan="6">
			<div id="jqxTabs">
				<ul>
					<li>Detail</li>
					<li>Program </li>
					<li>Keterangan</li>
					<li>Pemanfaatan Lebih Luas</li>
				</ul>
				<div style="padding: 10px;">
				{document}
				</div>
				<div style="padding: 10px;">
				{activity}
				</div>
				<div style="padding: 10px;">
				{evaluasi}
				</div>
				<div style="padding: 10px;">
				{pemanfaatan}
				</div>
			</div>		
		</td>
    </tr>
    </table>
</div>
