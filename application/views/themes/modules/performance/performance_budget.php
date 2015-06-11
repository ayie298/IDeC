
<script type="text/javascript">
    $(document).ready(function(){
		$("#btn_simpan,#btn_ulang").jqxInput({ theme: 'fresh', height: '30px', width: '100px' }); 
	});
</script>
<div style="padding:5px;text-align:center">
<?php echo form_open() ?>
	<input type="submit" id="btn_simpan" name="btn_simpan" value=" Simpan " />
	<button type="reset" id="btn_ulang"> Ulang </button>
	<input type="hidden" name="id" value="<?php echo $id ?>" />
	<br />
	<br />
	<table border="0" cellpadding="0" cellspacing="8" align="center">
		<tr>
			<td>

				<table border="0" cellpadding="2" cellspacing="2">
					<?php
					switch ($data->period) {
				case '1':
					$period = 'TW I';
				break;
				case '2':
					$period = 'TW II';
				break;
				case '3':
					$period = 'TW III';
				break;
				case '4':
					$period = 'TW IV';
				break;
				default :
					$period = 'TW I';
				break;
				}
				?>
					<tr>
						<td>Realisasi Anggaran <?php echo $period ?></td>
						<td>:</td>
						<td>Rp. <input type="text" name="budget" value="<?php echo $data->budget_realization ?>" placeholder="Rp. 100.000.000" style="width:250px;height:30px"></td>
					</tr>
				</table>
			</td>
		</tr>
	</table>
</form>
</div>