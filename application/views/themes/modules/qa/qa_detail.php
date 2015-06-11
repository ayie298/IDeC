<script type="text/javascript">
    $(document).ready(function(){
       $("#bar_rms").click();
 	   $("#btn_number,#btn_save,#btn_back").jqxButton({ height: 28, theme: theme });
       $('#jqxTabs').jqxTabs({ width: '1000px', height: '350', position: 'top', theme: theme });
		$('#btn_back').click(function () {
			document.location.href="<?php echo base_url();?>idec_rms/qa";
		});

		function edit(id){
			$("#popup_content").html("<div style='text-align:center'><br><br><br><br><img src='<?php echo base_url();?>media/images/indicator.gif' alt='loading content.. '><br>loading</div>");
			var offset = $("#jqxgrid").offset();
			$("#popup").jqxWindow({
				theme: theme, resizable: false,
				width: 600,
				height: 350,
				isModal: true, autoOpen: false, modalOpacity: 0.2
			});
			$("#popup").jqxWindow('open');
		}

	});
</script>
<style type="text/css">
.white {
    background: white;
}

</style>
<div id="popup" style="display:none">
	<div id="popup_title">Quality Assurance</div><div id="popup_content">{popup}</div>
</div>
<div class="row-fluid">
   <div class="span12">
	   <h3 class="page-title">
		 Detail QA
	   </h3>
   </div>
</div>
<div style="width:99%;background-color:#DDDDDD;-moz-border-radius:5px;border-radius:5px;padding:2px;border:3px solid #ebebeb;">
    <table width='100%' cellpadding='4' cellspacing='2' border='0' style="border: 1px solid rgb(204,209,205);background: rgb(244,244,244);">
    <tr id="td_proses" height="30">
        <td colspan="6" align="right">
				<button style='width:120px' id='btn_save' type='button'>SIMPAN</button>
				<button style='width:120px' id='btn_back' type='button'>KEMBALI</button>
		</td>
    </tr>
    <tr>
        <td width='15%'>Nama Produk</td>
        <td width='1%'>:</td>
        <td class="white"><input type="text" size="50" name="Judul Inovasi" id="Judul Inovasi" placeholder="Judul Inovasi" style="margin: 0;height: 30px;"/></td>
        <td rowspan='3' width='10%'>Executive Summary</td>
        <td rowspan='3' width='1%'>:</td>
        <td rowspan='3' class="white"><textarea name="Executive Summary" id="Executive Summary" placeholder="Executive Summary" style="width:450px;margin: 0;height: 100px;"/></textarea></td>
    </tr>
    <tr>
        <td width='15%'>Dasar Pelaksanaan</td>
        <td width='1%'>:</td>
        <td class="white"><input type="text" size="20" name="Dasar Pelaksanaan" id="Dasar Pelaksanaan" placeholder="Dasar Pelaksanaan" style="margin: 0;height: 30px;"/></td>
    </tr>
    <tr>
        <td width='15%'>Kesimpulan Akhir</td>
        <td width='1%'>:</td>
        <td class="white"><input type="text" size="20" name="Kesimpulan Akhir" id="Kesimpulan Akhir" placeholder="Kesimpulan Akhir" style="margin: 0;height: 30px;"/></td>
    </tr>
    <tr>
        <td colspan="6">
			<div id="jqxTabs">
				<ul>
					<li>File / Document</li>
				</ul>
				<div style="padding: 10px;">
				{document}
				</div>
			</div>		
		</td>
    </tr>
    </table>
</div>
