<script type="text/javascript">
    $(document).ready(function(){
		$("#btn_simpan,#btn_ulang").jqxInput({ theme: 'fresh', height: '30px', width: '100px' }); 
	});
</script>
<div style="padding:5px;text-align:center">
<?php echo form_open() ?>
	<input type="hidden" name="id" value="<?php echo $id ?>" />
	<input type="submit" id="btn_simpan" name="btn_simpan" value=" Simpan " />
	<button type="reset" id="btn_ulang"> Ulang </button>
	<br />
	<br />
	<table border="0" cellpadding="0" cellspacing="8" align="center">
		<tr>
			<td>

				<table border="0" cellpadding="2" cellspacing="2">
					<tr>
						<td>Analysis</td>
						<td>:</td>
						<td><textarea name="analysis" placeholder="Analysis" rows="3" cols="70" style="width:300px"><?php echo $data->analysis ?></textarea></td>
					</tr>
					<tr>
						<td>Evaluasi</td>
						<td>:</td>
						<td><textarea name="evaluasi" placeholder="Evaluasi" rows="3" cols="70" style="width:300px"><?php echo $data->evaluation ?></textarea></td>
					</tr>
					<tr>
						<td>Recomendation</td>
						<td>:</td>
						<td><textarea name="rec" placeholder="Recomendation" rows="3" cols="70" style="width:300px"><?php echo $data->recommendation ?></textarea></td>
					</tr>
				</table>
			</td>
		</tr>
	</table>
</form>
</div>