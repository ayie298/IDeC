<script type="text/javascript">
    $(document).ready(function(){
        $("#tanggal2").jqxDateTimeInput({ width: '140px', height: '30px', formatString: 'yyyy-MM-dd', theme: theme});
	});
</script>
<script type="text/javascript">
    $(function(){
        $('#form-ss form').submit(function(){
            var data = new FormData();

            $.each($('#file')[0].files, function(i, file){
                data.append('file-'+i, file);
            });

            $.ajax({
                cache : false,
                contentType : false,
                processData : false,
                type : 'POST',
                url : '<?php echo current_url() ?>',
                data : data+'&'+$('#form-s form').serialize(),
                success : function(data){
                var obj = $.parseJSON(data);
                
                if(obj.error == 1) {
                    $('.notice').html('<div class="alert">' + obj.notice + '</div>');
                } else {
                    $("#popup_certificate").jqxWindow('close');
                    alert(obj.notice);
                    $("#jqxgrid_certificate").jqxGrid('updatebounddata', 'cells');
                }
            }
            });

            return false;
        });
    });
</script>
<div id="form-s" style="width:99%;background-color:#DDDDDD;-moz-border-radius:5px;border-radius:5px;padding:2px;border:3px solid #ebebeb;">
    <div class="row-fluid notice">
    <?php //$notice = $this->session->flashdata('notice') ?>
    </div>
    <?php echo form_open_multipart() ?>
    <input type="hidden" name="id" value="<?php echo $id_employee ?>" />
    <input type="hidden" name="id_cer" value="<?php echo !empty($sertifikat) ? $sertifikat->id_certificate_employee : '' ?>" />
    <table width='100%' cellpadding='4' cellspacing='2' border='0' style="border: 1px solid rgb(204,209,205);background: rgb(244,244,244);">
    <tr>
        <td colspan="3" style="font-size:20px"><?php echo $title ?></td>
    </tr>
    <tr id="td_proses" height="30">
        <td colspan="3" align="right">
			<input class='btn' id='btn_save' type='submit' name="save" value="SAVE" />
		</td>
    </tr>
    <tr>
        <td width='18%'>Name</td>
        <td width='1%'>:</td>
        <td class="white"><input type="text" size="20" value="<?php echo !empty($sertifikat) ? $sertifikat->cer_name : '' ?>" name="name" id="Name" placeholder="Name" style="margin: 0;height: 30px;"/></td>
    </tr>
    <tr>
        <td width='18%'>File</td>
        <td width='1%'>:</td>
        <td class="white"><input type="file" size="20" id="file" name="userfile" id="Name" placeholder="Name" style="margin: 0;height: 30px;"/><br /><font size="1">JPG, JPEG or PDF</font></td>
    </tr>
    <tr>
        <td width='18%'>Category</td>
        <td width='1%'>:</td>
        <td class="white">
			<select size="1" class="input" name="category" id="Category" style="width: 300px;margin: 0;">
                <?php foreach($certificate as $cer) : ?>
				    <option value="<?php echo $cer->id_certificate ?>" <?php echo !empty($sertifikat) && $cer->id_certificate == $sertifikat->id_certificate ? 'selected' : '' ?>><?php echo $cer->name ?></option>
                <?php endforeach ?>
			</select>
		</td>
    </tr>
    <tr>
        <td width='18%'>Expired Date</td>
        <td width='1%'>:</td>
        <td class="white"><div id='tanggal2' name="tanggal2" value="<?php echo !empty($sertifikat) ? $sertifikat->expired_date : '' ?>"></div></td>
    </tr>
    </table>
    </form>
</div>
