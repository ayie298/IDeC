<script type="text/javascript">
    $(document).ready(function(){
		$("#bar_rms").click();
 		<?php if($this->session->userdata('level')!="researcher"){?>
			$("#btn_edit").jqxButton({ height: 28, theme: theme });
			$('#btn_edit').click(function () {
				document.location.href="<?php echo base_url();?>idec_rms/bantek_edit";
			});
		<?php } ?>
		$("#btn_back").jqxButton({ height: 28, theme: theme });
		$('#btn_back').click(function () {
			document.location.href="<?php echo base_url();?>idec_rms/bantek";
		});
		$('#jqxTabs').jqxTabs({ width: '1200px', height: '700', position: 'top', theme: theme });
	});
</script>
<style type="text/css">
.white {
    background: white;
}

</style>
<div id="popup" style="display:none">
	<div id="popup_title">BANTEK </div><div id="popup_content">{popup}</div>
</div>
<div class="row-fluid">
   <div class="span12">
	   <h3 class="page-title">
		 BANTEK Detail
	   </h3>
   </div>
</div>
<div style="width:99%;background-color:#DDDDDD;-moz-border-radius:5px;border-radius:5px;padding:2px;border:3px solid #ebebeb;">
    <table width='100%' cellpadding='4' cellspacing='2' border='0' style="border: 1px solid rgb(204,209,205);background: rgb(244,244,244);font-size:14px">
    <tr>
        <td colspan="6" align="right">
			<?php if($this->session->userdata('level')!="researcher"){?>
			<button style='width:180px' id='btn_edit' type='button'>EDIT PARTNERSHIP</button>
			<?php } ?>
			<button style='width:180px' id='btn_back' type='button'>KEMBALI</button>
		</td>
    </tr>
    <tr valign='top'>
        <td width='10%'>Type, Dok.Legal</td>
        <td width='1%'>:</td>
        <td width='40%' class="white">BANTEK, TEL 35 / HK 810/DC-00/2014</td>
        <td width='10%'>Kategori</td>
        <td width='1%'>:</td>
        <td class="white">Kerjasama Pengembangan</td>
    </tr>
    <tr valign='top' height='25'>
        <td width='10%' rowspan='2'>Judul</td>
        <td width='1%' rowspan='2'>:</td>
        <td width='10%' class="white" rowspan='2'>Perjanjian Kerjasama Antara PT. Telekomunikasi Indonesia , Tbk, Innovation & Design Center dengan PT. Pojok Celebes Mandiri Tentang Pelaksanaan Enchancement Produk Travel Exchange dan HI Indonesia </td>
        <td width='10%'>Status</td>
        <td width='1%'>:</td>
        <td class="white">ongoing</td>
    </tr>
    <tr valign='top'>
        <td width='10%'>Program</td>
        <td width='1%'>:</td>
        <td class="white">-</td>
    </tr>
    <tr>
        <td colspan="6">
			<div id="jqxTabs">
				<ul>
					<li>Detail</li>
					<li>Activity</li>
					<li>Evaluasi</li>
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
