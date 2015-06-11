<div class="container-fluid">
            <script type="text/javascript">
    $(document).ready(function(){
       $("#bar_rms").click();
       $("#btn_number,#btn_save,#btn_back").jqxButton({ height: 28, theme: theme });
       //$('#jqxTabs').jqxTabs({ width: '1000px', height: '350', position: 'top', theme: theme });
        $('#btn_back').click(function () {
            document.location.href="<?php echo base_url() ?>qa/qa_list";
        });

        function edit(id){
            $("#popup_content").html("<div style='text-align:center'><br><br><br><br><img src='<?php echo base_url() ?>media/images/indicator.gif' alt='loading content.. '><br>loading</div>");
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
         QA Update
       </h3>
   </div>
</div>
<div style="width:99%;background-color:#DDDDDD;-moz-border-radius:5px;border-radius:5px;padding:2px;border:3px solid #ebebeb;">
    <table width='100%' cellpadding='4' cellspacing='2' border='0' style="border: 1px solid rgb(204,209,205);background: rgb(244,244,244);">
	<form action="<?=base_url('qa/qa_add')?>" method="post" >
    <tr id="td_proses" height="30">
        <td colspan="6" align="right">
                <button style='width:120px' id='btn_save' type='submit'>SIMPAN</button>
                <button style='width:120px' id='btn_back' type='button'>KEMBALI</button>
        </td>
    </tr>
    <tr>
        <td width='20%'>Nama Produk</td>
        <td width='1%'>:</td>
        <td class="white" colspan="4"><input type="text" size="50" name="name_produk" id="Nama Produk" value="<?=$name_produk; ?>" placeholder="Nama Produk" style="margin: 0;height: 30px;"/></td>
    </tr>
    <tr>
        <td width='20%'>Bulan Mulai</td>
        <td width='1%'>:</td>
        <td class="white">
            <select size="1" class="input" name="thn_1" id="Program" style="width: 100px;margin: 0;">
                <option>2015</option>
                <option>2014</option>
            </select>
			<?=form_dropdown('bln_1',month(),$bln_1,'style="width: 200px;margin: 0;"');?>
        </td>
        <td width='20%'>Bulan Selesai</td>
        <td width='1%'>:</td>
        <td class="white">
            <select size="1" class="input" name="thn_2" id="Program" style="width: 100px;margin: 0;">
                <option>2015</option>
                <option>2014</option>
            </select>
			<?=form_dropdown('bln_2',month(),$bln_2,'style="width: 200px;margin: 0;"');?>

        </td>
    </tr>   
    <tr>
        <td width='20%'>Executive Summary</td>
        <td width='1%'>:</td>
        <td class="white" colspan="4"><textarea name="summary" id="Executive Summary" placeholder="Executive Summary" style="width:100%;margin: 0;height: 100px;"/><?=$summary?></textarea></td>
    </tr>
    <tr>
        <td width='20%'>Kesimpulan Pengujian</td>
        <td width='1%'>:</td>
        <td class="white" colspan="4"><textarea name="kesimpulan" id="Kesimpulan Pengujian" placeholder="Kesimpulan Pengujian" style="width:100%;margin: 0;height: 100px;"/><?=$kesimpulan; ?></textarea></td>
    </tr> 
    <tr>
        <td width='20%'>Rekomendasi Pengujian</td>
        <td width='1%'>:</td>
        <td class="white" colspan="4"><textarea name="rekomendasi" id="Rekomendasi Pengujian" placeholder="Rekomendasi Pengujian" style="width:100%;margin: 0;height: 100px;"/><?=$rekomendasi;?></textarea></td>
    </tr>
    <tr>
        <td width='20%'>Nama Penguji</td>
        <td width='1%'>:</td>
        <td class="white" colspan="4"><textarea name="nama_penguji" id="Nama Penguji" placeholder="Nama Penguji" style="width:100%;margin: 0;height: 60px;"/><?=$nama_penguji;?></textarea></td>
    </tr>
    <tr>
        <td width='20%'>Keterangan</td>
        <td width='1%'>:</td>
        <td class="white" colspan="4"><textarea name="keterangan" id="Keterangan" placeholder="Keterangan / Dasar Pelaksanaan" style="width:100%;margin: 0;height: 60px;"/><?=$keterangan;?></textarea></td>
    </tr>
	</form>


        </td>
    </tr>
    </table>
</div>
</div>
