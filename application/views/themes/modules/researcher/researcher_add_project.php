<script type="text/javascript">
    $(document).ready(function(){
		$("#btn_simpan,#btn_ulang").jqxInput({ theme: 'fresh', height: '30px', width: '100px' }); 
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
				<table border="0" cellpadding="3" cellspacing="2">
					<tr>
						<td>Researcher</td>
						<td>:</td>
						<td>690604 - AJI WIDODO</td>
					</tr>
					<tr>
						<td>Unit</td>
						<td>:</td>
						<td>
							<select size="1" class="input" name="Unit" id="Unit" style="width: 300px;margin: 0;">
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
						<td>Position</td>
						<td>:</td>
						<td><select name="status" style="height:30px;padding:2px;">
							<option>PM</option>
							<option>Dedicated</option>
							<option>Shared</option>
						</select>
						</td>
					</tr>
				</table>
			</td>
		</tr>
	</table>
</form>
</div>