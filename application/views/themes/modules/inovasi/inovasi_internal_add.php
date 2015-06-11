<script type="text/javascript">
    $(document).ready(function(){
       $("button,input[type='button'],input[type='submit']").jqxButton({ height: 28, theme: theme });
       $("input[type='text']").jqxInput({ height: 28, width:'99%', theme: theme });
 	   $("textarea").jqxInput({ height: 110, width:'99%', theme: theme });
       $('#jqxTabs').jqxTabs({ width: '97%', height: '350', position: 'top', theme: theme });
		$('#btn_back').click(function () {
			document.location.href="<?php echo base_url();?>inovasi/inovasi_internal";
		});

        $("#tanggal,#tanggal2").jqxDateTimeInput({ width: '140px', height: '30px', formatString: 'yyyy-MM-dd', theme: theme});

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
	<div id="popup_title">Innovation and Research</div><div id="popup_content">{popup}</div>
</div>
<div class="row-fluid">
   <div class="span12">
	   <h3 class="page-title">
		 <i class='icon-tasks'></i> Add Hasil Inovasi Internal 
	   </h3>
   </div>
</div>
<div style="width:99%;background-color:#DDDDDD;-moz-border-radius:5px;border-radius:5px;padding:2px;border:3px solid #ebebeb;">
    <table class='tbl-form'>
    <tr id="td_proses" height="30">
        <td colspan="6" align="right">
            <button style='width:120px' id='btn_save' type='button'><i class='icon-save'></i> SIMPAN</button>
            <button style='width:120px' id='btn_back' type='button'><i class='icon-chevron-sign-left'></i> KEMBALI</button>
		</td>
    </tr>
     <tr>
        <td width='15%'>Judul Inovasi</td>
        <td width='1%'>:</td>
        <td width='33%' class="white"><input type="text" size="50" name="Judul Inovasi" id="Judul Inovasi" placeholder="Judul Inovasi" style="margin: 0;height: 30px;"/></td>
        <td width='18%'>Tipe Produk</td>
        <td width='1%'>:</td>
        <td class="white">
            <select size="1" class="input" name="Category" id="Category" style="width:95%;margin: 0;">
                <option>-</option>
                <option>Cloud - IaaS (Public)</option>
                <option>Cloud - Consumer SaaS </option>
                <option>Cloud - Business SaaS</option>
                <option>Cloud - SaaS Marketplace (Include PaaS)</option>
                <option>Financial Service - DOB</option>
                <option>Financial Service - Non DOB Payments</option>
                <option>Financial Service - Insurance</option>
                <option>Financial Service - Credit</option>
                <option>Financial Service - Savings</option>
                <option>Advertising - Agency</option>
                <option>Advertising - Incentive Marketing</option>
                <option>Media - Portal / Static Content</option>
                <option>Media - Streaming & Games</option>
                <option>Media - Social / UGC</option>
                <option>Media - Others</option>
                <option>Others</option>
            </select>
        </td>
   </tr>   
    <tr>
        <td>Lab</td>
        <td width='1%'>:</td>
        <td class="white">
            <select size="1" class="input" name="Category" id="Category" style="width:95%;margin: 0;">
                <option>-</option>
                <option>Lab</option>
            </select>
        </td>
        <td rowspan='2'>Deskripsi</td>
        <td rowspan='2' width='1%'>:</td>
        <td rowspan='2' class="white"><textarea name="Description" id="Description" placeholder="Description" style="width:450px;margin: 0;height: 100px;"/></textarea></td>
    </tr>
    <tr>
        <td rowspan='2'>Tim Inovator</td>
        <td rowspan='2' width='1%'>:</td>
        <td rowspan='2' class="white"><textarea name="Lab" id="Lab" placeholder="Tim Inovator" style="width:450px;margin: 0;height: 100px;"/></textarea></td>
    </tr>
    <tr>
        <td>Tanggal Mulai Proses</td>
        <td width='1%'>:</td>
        <td class="white"><div id='tanggal'></div></td>
    </tr>
    <tr>
        <td rowspan='3'>Tim Inkubator</td>
        <td rowspan='3' width='1%'>:</td>
        <td rowspan='3' class="white"><textarea name="Inkubator" id="Inkubator" placeholder="Tim Inkubator" style="width:450px;margin: 0;height: 100px;"/></textarea></td>
        <td>Tanggal Selesai</td>
        <td width='1%'>:</td>
        <td class="white"><div id='tanggal2'></div></td>
    </tr>
    <tr>
        <td>Total Realisasi Anggaran (Rp)</td>
        <td width='1%'>:</td>
        <td class="white"><input type="text" size="100" name="Realisasi" id="Realisasi" placeholder="000" style="margin: 0;height: 30px;"/></td>
    </tr>
    <tr>
        <td rowspan='3'>Keterangan</td>
        <td rowspan='3'>:</td>
        <td rowspan='3' class="white"><textarea name="Keterangan" id="Keterangan" placeholder="Keterangan" style="width:450px;margin: 0;height: 100px;"/></textarea></td>
    </tr>
    <tr>
        <td>Tahap Akhir</td>
        <td width='1%'>:</td>
        <td class="white">
            <select size="1" class="input" name="Category" id="Category" style="width:95%;margin: 0;">
                <option>Customer Validation</option>
                <option>Product Validation</option>
                <option>Business Model Validation</option>
                <option>Handover to DDB</option>
            </select>
        </td>
    </tr>
    <tr>
        <td colspan='3'><br></td>
    </tr>
    <tr>
        <td colspan="6">
			<div id="jqxTabs">
				<ul>
					<li>File / Document</li>
					<li>Pemanfaatan Lebih Luas</li>
				</ul>
                <div style="padding: 10px;">
                <?php echo $document?>
                </div>
                <div>
                <?php echo $pemanfaatan?>
                </div>
			</div>		
		</td>
    </tr>
    </table>
</div>
