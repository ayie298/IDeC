<script type="text/javascript">
    $(document).ready(function(){
		$("#bar_rms").click();
 		$("#btn_save,#btn_back").jqxButton({ height: 28, theme: theme });
		$('#jqxTabs').jqxTabs({ width: '1200px', height: '700', position: 'top', theme: theme });
		$('#btn_back').click(function () {
			document.location.href="<?php echo base_url();?>idec_rms/partnership";
		});
	});
</script>
<style type="text/css">
.white {
    background: white;
}

</style>
<div id="popup" style="display:none">
	<div id="popup_title">Partnership Edit</div><div id="popup_content">{popup}</div>
</div>
<div class="row-fluid">
   <div class="span12">
	   <h3 class="page-title">
		 Edit Partnership
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
				<td width='18%'>Mitra</td>
				<td width='1%'>:</td>
				<td class="white">
					<input type="text" size="20" name="Partner" id="Partner" placeholder="Mitra" style="margin: 0;height: 30px;"/> 
				</td>
    </tr>
	<tr valign='top'>
        <td width='10%'>Kategori</td>
        <td width='1%'>:</td>
        <td class="white">
			<select size="1" class="input" name="Status" id="Status" style="width:300px;margin: 0;">
				<option>Kerjasama Pengembangan</option>
				<option>Kerjasama Riset</option>
				<option>Kerjasama Inisiatif Bisnins</option>
			</select> 
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
        <td width='10%' rowspan='2'>Judul</td>
        <td width='1%' rowspan='2'>:</td>
        <td class="white" rowspan='2'><textarea placeholder="Judul" rows='4' style='width:400px'></textarea></td>
        <td width='10%'>Unit Kerja Initiator</td>
        <td width='1%'>:</td>
        <td class="white">
			<select size="1" class="input" name="Program" id="Program" style="width: 300px;margin: 0;">
				<option>INNOVATION MANAGEMENT</option>
				<option>INFRASTRUCTURE RESEARCH & DEVELOPMENT</option>
				<option>PRODUCT INFRASTRUCTURE ASSURANCE</option>
				<option>DIGITAL LIFESTYLE ECOSYSTEM</option>
				<option>DIGITAL SOLUTION ECOSYSTEM</option>
				<option>GENERAL AFFAIRS</option>
				<option>MOBILE ECOSYSTEM</option>
				<option>M2M DIGITAL ECOSYSTEM</option>
			</select>
		</td>
    </tr>
	<tr valign='top'>
        <td width='10%'>Program</td>
        <td width='1%'>:</td>
        <td class="white">
			<select size="1" class="input" name="Program" id="Program" style="width: 300px;margin: 0;">
				<option>Update dan rolling Strategic Plan RDC</option>
				<option>Penyusunan RKA 2014</option>
				<option>Penyusunan & Rolling Training Plan</option>
				<option>TBS</option>
				<option>Pengembangan Management System</option>
				<option>Fora Internasional</option>
				<option>Membership Fora Internasional</option>
				<option>Operasional Research & Program Sinergy</option>
			</select>
		</td>
    </tr>
    <tr>
        <td colspan="6">
			<div id="jqxTabs">
				<ul>
					<li>Detail</li>
					<li>Activity</li>
					<li>Keterangan</li>
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
			</div>		
		</td>
    </tr>
    </table>
</div>
