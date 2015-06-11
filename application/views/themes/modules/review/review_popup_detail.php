<script type="text/javascript">
    $(document).ready(function(){
		$("#btn_simpan,#btn_ulang").jqxInput({ theme: 'fresh', height: '30px', width: '100px' }); 
		$("#btn_simpan").click(function(){
			closepopup();
		});
	});
</script>
<div style="padding:5px;text-align:center">
<?php echo form_open_multipart('review/detail/update') ?>
	<input type="hidden" name="id_program" value="<?php echo $program->id_program ?>" />
	<input type="submit" id="btn_simpan" name="btn_simpan" value=" Simpan " />
	<button type="reset" id="btn_ulang"> Ulang </button>
	<br />
	<br />
	<table border="0" cellpadding="0" cellspacing="8" align="center">
		<tr>
			<td>

				<table border="0" cellpadding="2" cellspacing="2" style="font-size:14px">
					<tr>
						<td>Program</td>
						<td>:</td>
						<td><?php echo $program->name ?></td>
					</tr>
					<tr>
						<td>Unit</td>
						<td>:</td>
						<td><?php echo !empty($unit) ? $unit->org_name : $program->org_name ?></td>
					<tr>
						<td>Bagian / Lab</td>
						<td>:</td>
						<td><?php echo !empty($lab) ? $lab->org_name : '' ?></td>
					</tr>
					<tr>
						<td>Type</td>
						<td>:</td>
						<td><?php echo $review->type ?></td>
					</tr>
					<tr>
						<td>File</td>
						<td>:</td>
						<td><?php echo $review->file ?></td>
					</tr>
					<tr>
						<td>Description</td>
						<td>:</td>
						<td><?php echo $review->description ?></td>
					</tr>
				</table>
			</td>
		</tr>
	</table>
</form>
</div>