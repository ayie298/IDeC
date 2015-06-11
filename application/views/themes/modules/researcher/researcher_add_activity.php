<script type="text/javascript">
    $(document).ready(function(){
		$("#btn_simpan,#btn_ulang").jqxInput({ theme: 'fresh', height: '30px', width: '100px' }); 
        $("#tanggal,#tanggal_end").jqxDateTimeInput({ width: '140px', height: '30px', formatString: 'yyyy-MM-dd', theme: theme});
	});
</script>
<div style="padding:5px;text-align:center">
<form method="POST" id="frmData">
	<button type="button" id="btn_simpan" name="btn_simpan"> Simpan </button>
	<button type="reset" id="btn_ulang"> Ulang </button>
	<br />
	<br />
	<table border="0" cellpadding="0" cellspacing="8" align="center">
		<tr>
			<td>

				<table border="0" cellpadding="2" cellspacing="2">
					<tr>
						<td>Researcher</td>
						<td>:</td>
						<td>690604 - AJI WIDODO</td>
					</tr>
					<tr>
						<td>Project</td>
						<td>:</td>
						<td>
							<select size="1" class="input" name="Category" id="Category" style="width: 300px;margin: 0;">
								<option>Indigo Incubator</option>
								<option>Tourism Exchange</option>
								<option>Hi-Indonesia</option>
								<option>Hi-City</option>
								<option>Radio 2.0</option>
								<option>U-Point Phase 2</option>
								<option>Pengembangan Ekosistem OASIS</option>
								<option>Integrated Smart Home Box</option>
								<option>Smart Building</option>
								<option>SDP-IMS Integration</option>
							</select>
						</td>
					</tr>
					<tr>
						<td>Step</td>
						<td>:</td>
						<td>
						<select size="1" class="input" name="Category" id="Category" style="width:200px;margin: 0;">
							<option>Validated Products</option>
							<option>Validated Business Model</option>
							<option>Workshop</option>
							<option>Training</option>
						</select>
						</td>
					</tr>
					<tr>
						<td>Activity Name</td>
						<td>:</td>
						<td><input type="text" name="Name" placeholder="Name" style="height:30px;padding:2px;"/></td>
					</tr>
					<tr>
						<td>Activity Description</td>
						<td>:</td>
						<td><input type="text" name="Description" placeholder="Description" style="height:30px;padding:2px;width:300px"/></td>
					</tr>
					<tr>
						<td>Location</td>
						<td>:</td>
						<td><input type="text" name="Location" placeholder="Location" style="height:30px;padding:2px;width:300px"/></td>
					</tr>
					<tr>
						<td>Status</td>
						<td>:</td>
						<td>
						<select size="1" class="input" name="Category" id="Category" style="width: 150px;margin: 0;">
							<option>On Going</option>
							<option>Close</option>
						</select>
						</td>
					</tr>
					<tr>
						<td>Start</td>
						<td>:</td>
						<td><div id="tanggal"/></td>
					</tr>
					<tr>
						<td>End</td>
						<td>:</td>
						<td><div id="tanggal_end"/></td>
					</tr>
				</table>
			</td>
		</tr>
	</table>
</form>
</div>