<script type="text/javascript">
    $(document).ready(function(){
	    $("#btn_save,#btn_close").jqxButton({ height: 28, theme: theme });
		$("#btn_save,#btn_close").click(function(){
			closepopup();
		});
	});	
</script>
<div style="padding:5px;border:2px solid white;width:96%;position:relative;float:left">
	<div style="font-size:16px;padding-bottom:20px"><a>Set Program View</a></div>
	<table cellpadding="4" cellspacing="2" width="100%" style="font-size:12px;border:1px solid #CCC;color:#000">
		<tr style="background:#DDD;">
			<td align="center" width="10%">Show</td>
			<td>Program Name</td>
		</tr>
		<tr>
			<td align="center"><input type="checkbox"></td>
			<td>Indigo Incubator</td>
		</tr>
		<tr>
			<td align="center"><input type="checkbox"></td>
			<td>Tourism Exchange</td>
		</tr>
		<tr>
			<td align="center"><input type="checkbox"></td>
			<td>Hi-Indonesia</td>
		</tr>
		<tr>
			<td align="center"><input type="checkbox"></td>
			<td>Hi-City</td>
		</tr>
		<tr>
			<td align="center"><input type="checkbox"></td>
			<td>Radio 2.0</td>
		</tr>
		<tr>
			<td align="center"><input type="checkbox"></td>
			<td>U-Point Phase 2</td>
		</tr>
		<tr>
			<td align="center"><input type="checkbox"></td>
			<td>Pengembangan Ekosistem OASIS</td>
		</tr>
		<tr>
			<td align="center"><input type="checkbox"></td>
			<td>Integrated Smart Home Box</td>
		</tr>
		<tr>
			<td align="center"><input type="checkbox"></td>
			<td>Smart Building</td>
		</tr>
		<tr>
			<td align="center"><input type="checkbox"></td>
			<td>SDP-IMS Integration</td>
		</tr>
		<tr>
			<td align="center" colspan="2">
				<button id='btn_save' style='width:120px' type='button'>SAVE</button>
				<button id='btn_close' style='width:100px' type='button'>CLOSE</button>
			</td>
		</tr>
	</table>
</div>
