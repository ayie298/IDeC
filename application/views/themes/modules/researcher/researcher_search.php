<script>
	$(function(){
       $("#bar_rms").click();
	   $("#submitbutton,#clearfilteringbutton, #refreshdatabutton,#btn_report,#btn_print,#btn_excel").jqxButton({ height: 28, theme: theme });
	   $("input[type='text']").jqxInput({ height: 28, theme: theme });

	   var source = {
			datatype: "json",
			type	: "POST",
			datafields: [
			{ name: 'urut'},
			{ name: 'id', type: 'string' },
			{ name: 'id_real', type: 'number' },
			{ name: 'nik', type: 'string' },
			{ name: 'name', type: 'string' },
			{ name: 'position', type: 'string' },
			{ name: 'project', type: 'number' },
			{ name: 'activity', type: 'string' },
			{ name: 'close', type: 'string' },
			{ name: 'org_name', type: 'string' }
        ],
		url: "<?php echo base_url('researcher/search/json_output'); ?>",
		cache: false,
		updaterow: function (rowid, rowdata, commit) {
			},
		filter: function(){
			$("#jqxgrid").jqxGrid('updatebounddata', 'filter');
		},
		sort: function(){
			$("#jqxgrid").jqxGrid('updatebounddata', 'sort');
		},
		root: 'Rows',
        pagesize: 10,
        beforeprocessing: function(data){		
			if (data != null){
				source.totalrecords = data[0].TotalRows;					
			}
		}
		};		
		var dataadapter = new $.jqx.dataAdapter(source, {
			loadError: function(xhr, status, error){
				alert(error);
			}
		});
     
		$("#jqxgrid").jqxGrid(
		{		
			width: '100%',
			selectionmode: 'singlerow',
			source: dataadapter, theme: theme,columnsresize: true,showtoolbar: false, pagesizeoptions: ['10', '25', '50', '100', '200'],
			showfilterrow: true, filterable: true, sortable: true, autoheight: true, pageable: true, virtualmode: true, editable: false,
			rendergridrows: function(obj)
			{
				return obj.data;    
			},
			columns: [
				{ text: '#', align: 'center', filtertype: 'none', sortable: false, width: '5%', cellsrenderer: function (row) {
				    var dataRecord = $("#jqxgrid").jqxGrid('getrowdata', row);
					return "<div style='width:100%;padding-top:2px;text-align:center'><a href='<?php echo site_url('researcher/detail/view/') ?>/"+dataRecord.id_real+"'><img border=0 src='<?php echo base_url(); ?>public/images/edt.gif'></a></div>";
                 }
                },
				{ text: 'NIK', datafield: 'nik', columntype: 'textbox', filtertype: 'textbox', width: '6%' },
				{ text: 'Name', datafield: 'name', columntype: 'textbox', filtertype: 'textbox', width: '23%' },
				{ text: 'Title', datafield: 'position', columntype: 'textbox', filtertype: 'textbox', width: '25%' },
				{ text: 'Unit', datafield: 'org_name', columntype: 'textbox', filtertype: 'textbox', width: '24%' },
				{ text: 'Ongoing', datafield: 'project', columntype: 'textbox', filtertype: 'textbox', width: '8%' },
				{ text: 'Close', datafield: 'close', columntype: 'textbox', filtertype: 'textbox', width: '8%' }
            ]
		});
        
		$('#clearfilteringbutton').click(function () {
			$("#jqxgrid").jqxGrid('clearfilters');
			$("#listresearcher").show();
		});
        
 		$('#refreshdatabutton').click(function () {
			$("#jqxgrid").jqxGrid('updatebounddata', 'cells');
			$("#listresearcher").show();
		});

 		$('#submitbutton').click(function () {
			document.location.href="<?php echo base_url();?>idec_rms/researcher_search";
		});

		$('#btn_report').click(function () {
			var offset = $("#jqxgrid").offset();
			$("#popup").jqxWindow({
				theme: theme, resizable: false,
				width: 600,
				height: 350,
				isModal: true, autoOpen: false, modalOpacity: 0.2
			});
			$("#popup").jqxWindow('open');
		});
        
	});

	function edit(id){
		document.location.href="<?php echo base_url();?>idec_rms/researcher_detail";
	}

</script>
<div class="row-fluid">
   <div class="span12">
	   <h3 class="page-title">
		 Researcher Data
	   </h3>
   </div>
</div>
<div id="popup" style="display:none">
	<div id="popup_title">Generate Report</div>
	<div id="popup_content">
		<div style="padding:4px;height:30px;margin-top:10px">
			Researcher Unit : <select size="1" class="input" name="unit" id="Category" style="width: 300px;margin: 0;">
				<option>Choose Unit</option>
				<option>INNOVATION MANAGEMENT</option>
				<option>INFRASTRUCTURE RESEARCH & DEVELOPMENT</option>
				<option>PRODUCT INFRASTRUCTURE ASSURANCE</option>
				<option>DIGITAL LIFESTYLE ECOSYSTEM</option>
				<option>DIGITAL SOLUTION ECOSYSTEM</option>
				<option>GENERAL AFFAIRS</option>
				<option>MOBILE ECOSYSTEM</option>
				<option>M2M DIGITAL ECOSYSTEM</option>
			</select>

		</div>
		<div style="padding:4px;height:40px;margin-top:10px">
			<input style="padding: 5px;width:100px" value=" PRINT" id="btn_print" type="button" />
			<input style="padding: 5px;width:100px" value=" EXCEL " id="btn_excel" type="button" />
		</div>
	</div>
</div>
<div>
	<div style="width:99%;background-color:#EEEEEE;color:black;-moz-border-radius:5px;border-radius:5px;padding:2px;border:3px solid #ebebeb;">
		<?php echo form_open() ?>
		<div style="font-weight:bold">Cari Researcher :</div>
		<div style="float:left;position:relative;width:690px">
			<div style="height:55px;float:left;position:relative;width:200px;padding-left:40px">
				Unit : 
				<select size="1" class="input" name="unit" id="Category" style="width:220px;margin: 0;">
					<option value="">Choose Unit</option>
					<?php foreach($organization as $org) : ?>
						<?php $select = !empty($post) && $org->id_organization_item == $post['unit'] ? 'selected' : '' ?>
						<option value="<?php echo $org->id_organization_item ?>" <?php echo $select ?>><?php echo $org->org_name ?></option>
					<?php endforeach; ?>
				</select>
			</div>
			<div style="height:55px;float:left;position:relative;width:150px;padding-left:40px">
				Competence :  <br />
				<?php foreach($competence as $comp) : ?>
					<?php $checked = !empty($post) && !empty($post['competence']) && in_array($comp->name, $post['competence']) ? 'checked' : '' ?>
					<input type="checkbox" name="competence[]" value="<?php echo $comp->name ?>" <?php echo $checked ?>>&nbsp;<?php echo substr($comp->name, 0, 1) ?>
				<?php endforeach; ?>
			</div>
			<div style="height:55px;float:left;position:relative;width:150px;padding-left:40px">
				Certificate : <input type="text" value="<?php echo !empty($post) && !empty($post['certificate']) ? $post['certificate'] : '' ?>" name="certificate" placeholder="Sun Certified Developer" style="width:180px">
			</div>
			<div style="height:55px;float:left;position:relative;width:200px;padding-left:40px">
				Training : <input type="text" value="<?php echo !empty($post) && !empty($post['training']) ? $post['training'] : '' ?>" name="training" placeholder="Oracle" style="width:220px">
			</div>
			<div style="height:55px;float:left;position:relative;width:75px;padding-left:40px">
				NIK : <input type="text" value="<?php echo !empty($post) && !empty($post['nik']) ? $post['nik'] : '' ?>" name="nik" placeholder="NIK" style="width:100px">
			</div>
			<div style="height:55px;float:left;position:relative;width:180px;padding-left:40px">
				Nama : <input type="text" value="<?php echo !empty($post) && !empty($post['name']) ? $post['name'] : '' ?>" name="name" placeholder="Nama">
			</div>
		</div>
		<div style="float:left;position:relative;width:300px;padding-left:40px">
			<br>
			<input style="padding: 5px;" value=" Search " id="submitbutton" type="submit" />
			<input style="padding: 5px;" value=" Clear Filter " id="clearfilteringbutton" type="button" />
			<input style="padding: 5px;" value=" Refresh Data " id="refreshdatabutton" type="button" />
		</div>
		<div style="float:right;position:relative;width:140px;padding-right:10px">
			<br>
			<!--<input style="padding: 5px;width:140px" value=" Generate Report" id="btn_report" type="button" />-->
		</div>
		<div style="clear:both"></div>
	</div>
	<div style="width:99%;background-color:#DDDDDD;-moz-border-radius:5px;border-radius:5px;padding:2px;border:3px solid #ebebeb;" id="listresearcher">
        <div id="jqxgrid"></div>
	</div>
	</form>
	<br>
	<br>
	<br>
</div>