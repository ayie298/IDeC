
		<div style="padding:5px;border:2px solid white;width:98%;position:relative;float:left">
			<table cellpadding="4" cellspacing="2" width="100%" style="font-size:12px;border:1px solid #CCC;color:#000">
				<tr style="background:#DDD;height:50px">
					<td colspan="3" align="center"><?php echo $bidang->org_name ?></td>
				</tr>
				<tr style="background:#EEE;" align="center">
					<th>NIK</th>
					<th>NAMA</th>
					<th>TITLE</th>
				</tr>
				<?php foreach($employee as $emp) : ?>
				<tr>
					<td><?php echo $emp->nik ?></td>
					<td><?php echo $emp->name ?></td>
					<td><?php echo $emp->title ?></td>
				</tr>
				<?php endforeach ?>
			</table>
		</div>