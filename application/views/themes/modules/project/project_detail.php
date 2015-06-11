<script type="text/javascript">
    $(document).ready(function(){
        $("#bar_rms").click();

		$('#jqxTabs').jqxTabs({ width: '1000', height: '450', position: 'top', theme: theme });
	    $("#btn_edit,#btn_back,#btn_showhide").jqxButton({ height: 28, theme: theme });
		
		$('#btn_edit').click(function () {
			document.location.href="<?php echo site_url('researcher/project/update/' . md5($project->id_project));?>";
		});

		$('#btn_back').click(function () {
			document.location.href="<?php echo site_url('researcher/project');?>";
		});

		$('#btn_showhide').click(function () {
			$("#tbldetail").toggle("fade");
		});

	});
</script>
<style type="text/css">
.white {
    background: white;
}

</style>
<div id="popup" style="display:none">
	<div id="popup_title">Project Data</div><div id="popup_content">{popup}</div>
</div>
<div class="row-fluid">
   <div class="span12">
	   <h3 class="page-title">
		 Project Detail
	   </h3>
   </div>
</div>
<div class="row-fluid">
   <div class="span12">
		 <?php echo $this->session->flashdata('notice') == "" ? "" : '<div class="alert">' . $this->session->flashdata('notice') . '</div>'; ?>
   </div>
</div>
<div style="width:99%;background-color:#DDDDDD;-moz-border-radius:5px;border-radius:5px;padding:2px;border:3px solid #ebebeb;">
    <table width='100%' cellpadding='4' cellspacing='2' border='0' style="border: 1px solid rgb(204,209,205);background: rgb(244,244,244);font-size:14px">
    <tr id="td_proses" height="30">
        <td colspan="3" align="right">
			<button id='btn_showhide' style='width:150px' type='button'>SHOW/HIDE DETAIL</button>
			<?php if($this->session->userdata('level')!="researcher"){?><button id='btn_edit' style='width: 150px;' type='button'>EDIT PROJECT</button><?php }?>
			<button id='btn_back' style='width: 100px;' type='button'>KEMBALI</button>
		</td>
    </tr>
	<tr>
		<td colspan="3">
			<table width="100%">
				<tr valign="top">
					<td width="50%">
						<table width='100%' cellpadding='4' cellspacing='2' border='0' style="border: 1px solid #CCC;background: #EFEFEF;font-size:14px">
						<tr>
							<td width='18%'>Name</td>
							<td width='1%'>:</td>
							<td class="white" style="font-size:20px;font-weight:bold"> <?php echo $project->name ?></td>
						</tr>
						<tr>
							<td width='18%'>Unit</td>
							<td width='1%'>:</td>
							<td class="white"><?php echo $project->org_name ?></td>
						</tr>
						<tr>
							<td width='18%'>Bidang</td>
							<td width='1%'>:</td>
							<td class="white">Innovation & Entrepreneurship</td>
						</tr>
						</table>
					</td>
					<td width="50%">
						<table width='100%' cellpadding='4' cellspacing='2' border='0' style="border: 1px solid #CCC;background: #EFEFEF;font-size:14px;display:none" id="tbldetail">
						 <tr>
							<td width='18%'>Description</td>
							<td width='1%'>:</td>
							<td class="white"> <?php echo $project->description ?></td>
						</tr>
						<tr>
							<td width='18%'>Date</td>
							<td width='1%'>:</td>
							<td class="white"><?php echo $project->start_date ?> - <?php echo $project->end_date ?></div></td>
						</tr>
						<tr>
							<td width='18%'>Status</td>
							<td width='1%'>:</td>
							<td class="white"><?php echo $project->status ?></td>
						</tr>
						<tr>
							<td width='18%'>Stream</td>
							<td width='1%'>:</td>
							<td class="white">
								<?php 
									$times = unserialize($project->id_mas_times_category);
									$t = '';
									for($i=0;$i<sizeof($times);$i++) {
										$time_name = $this->db->where('id_mas_times_category', $times[$i])->get('mas_times_category')->row();
										$t .= $time_name->category.'-';
									}

									echo substr($t, 0, strlen($t)-1);
								?>
							</td>
						</tr>
						<tr>
							<td width='18%'>Weight</td>
							<td width='1%'>:</td>
							<td class="white"><?php echo $project->weight ?></td>
						</tr>
 						</table>
					</td>
				</tr>
			</table>
		</td>
	</tr>
   <tr>
        <td colspan="3">
			<div id="jqxTabs">
				<ul>
					<li>Activity</li>
					<li>Project Step</li>
					<li>Researcher / Team Member</li>
				</ul>
				<div style="padding: 5px;">
				<?php echo $activity ?>
				</div>
				<div style="padding: 5px;">
				<?php echo $step ?>
				</div>
				<div style="padding: 5px;">
				<?php echo $member ?>
				</div>
			</div>		
		</td>
    </tr>
    </table>
</div>
