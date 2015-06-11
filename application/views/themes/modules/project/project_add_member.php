<script type="text/javascript">
    $(document).ready(function(){
		$("#btnSearch").click(function () {
			$.ajax({
				url : '<?php echo current_url() ?>',
				type : 'POST',
				data : $('form').serialize(),
				success : function() {
					showGrid();
					$("#divResearcher").show();
				}
			});

			return false;
		});
	});

	function showGrid() {
		$("#btnSearch").jqxInput({ theme: 'fresh', height: '28px', width: '120px' }); 
		$("input[type='text']").jqxInput({ theme: 'fresh', height: '28px'}); 

	   var source = {
			datatype: "json",
			type	: "POST",
			datafields: [
			{ name: 'urut'},
			{ name: 'id', type: 'number' },
			{ name: 'id_project', type: 'number' },
			{ name: 'nik', type: 'string' },
			{ name: 'nama', type: 'string' },
			{ name: 'posisi', type: 'string' },
			{ name: 'project', type: 'number' },
			{ name: 'loads', type: 'number' },
			{ name: 'close', type: 'number' },
			{ name: 'activity', type: 'string' },
			{ name: 'status', type: 'string' },
			{ name: 'unit', type: 'string' },
			{ name: 'color', type: 'string' }
        ],
		url: "<?php echo site_url('researcher/project_member/researcher_json/' . $id_project); ?>",
		cache: false,
		updaterow: function (rowid, rowdata, commit) {
			},
		filter: function(){
			$("#jqxgrid_researcher").jqxGrid('updatebounddata', 'filter');
		},
		sort: function(){
			$("#jqxgrid_researcher").jqxGrid('updatebounddata', 'sort');
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
     
		$("#jqxgrid_researcher").jqxGrid(
		{		
			width: '100%',
			selectionmode: 'singlerow',
			source: dataadapter, theme: theme,columnsresize: true,showtoolbar: false, pagesizeoptions: ['10', '25', '50', '100', '200'],
			showfilterrow: false, sortable: true, autoheight: true, pageable: true, virtualmode: true, editable: false,
			rendergridrows: function(obj)
			{
				return obj.data;    
			},
			columns: [
				<?php if($this->session->userdata('level')!="researcher"){?>{ text: 'Select', align: 'center', filtertype: 'none', sortable: false, width: '10%', cellsrenderer: function (row) {
				    var dataRecord = $("#jqxgrid_researcher").jqxGrid('getrowdata', row);
					return "<div style='width:100%;padding-top:2px;text-align:center'><a href='javascript:void(0);'><img border=0 src='<?php echo base_url(); ?>media/images/16_add.gif' onclick='selectmember("+dataRecord.id+","+dataRecord.id_project+");'></a></div>";
                 }
                },<?php }?>
				{ text: 'NIK', datafield: 'nik', columntype: 'textbox', filtertype: 'textbox', width: '10%' },
				{ text: 'Name', width: '33%', cellsrenderer: function (row) {
				    var dataRecord = $("#jqxgrid_researcher").jqxGrid('getrowdata', row);
					return "<div style='width:100%;padding-top:2px;text-align:center'><a href='<?php echo base_url();?>idec_rms/researcher_detail/"+dataRecord.id+"' target='_blank'>"+dataRecord.nama+"</a></div>";
                 }
                },
				{ text: 'Unit', datafield: 'unit', columntype: 'textbox', filtertype: 'textbox', width: '9%' },
				{ text: 'Loads', width: '20%' , cellsrenderer: function (row) {
				    var dataRecord = $("#jqxgrid_researcher").jqxGrid('getrowdata', row);
					if(dataRecord.loads > 0){
						return "<div style='width:100%;padding-top:2px;text-align:center'><div style='position:relative;float:left;width:" + dataRecord.loads  + "%;height:100%;background:"+dataRecord.color+";'>&nbsp;</div><div style='position:absolute;float:left;width:80px;height:20px;text-align:center;color:#111;'>" + dataRecord.project  + "</div></div>";
					}else{
						return "<div style='width:100%;padding-top:2px;text-align:center'><a href='javascript:void(0);' onclick='projectlist("+dataRecord.id+");'>"+dataRecord.loads+" </a></div>";
					}
                 }
                },
				{ text: 'OnGoing', width: '9%' , cellsrenderer: function (row) {
				    var dataRecord = $("#jqxgrid_researcher").jqxGrid('getrowdata', row);
					return "<div style='width:100%;padding-top:2px;text-align:center'><a href='javascript:void(0);' onclick='projectlist("+dataRecord.id+", \"1\");'>"+dataRecord.project+" <img border=0 src='<?php echo base_url(); ?>media/images/16_view.gif' ></a></div>";
                 }
                },
				{ text: 'Close', width: '9%' , cellsrenderer: function (row) {
				    var dataRecord = $("#jqxgrid_researcher").jqxGrid('getrowdata', row);
					return "<div style='width:100%;padding-top:2px;text-align:center'><a href='javascript:void(0);' onclick='projectlist("+dataRecord.id+", \"2\");'>"+dataRecord.close+" <img border=0 src='<?php echo base_url(); ?>media/images/16_view.gif' ></a></div>";
                 }
                }
            ]
		});
	}
</script>
<div style="padding:5px;background:#FEFEFE;border:4px solid #EFEFEF">
	<?php echo form_open() ?>
	<div style="font-weight:bold">Filter:</div>
	<div style="float:left;position:relative;width:750px;">
		<div style="float:left;position:relative;width:730px;padding:10px">
			<div style="height:55px;float:left;position:relative;width:310px;">
				Unit : 
				<select size="1" class="input" name="unit" id="Category" style="width: 300px;margin: 0;">
					<option value="">Choose Unit</option>
					<?php foreach($organization as $org) : ?>
					<option value="<?php echo $org->id_organization_item ?>"><?php echo $org->org_name ?></option>
				<?php endforeach; ?>
				</select>
			</div>
			<div style="height:55px;float:left;position:relative;width:130px;">
				NIK : <input type="text" name="nik" placeholder="NIK" style="width:120px">
			</div>
			<div style="height:55px;float:left;position:relative;width:230px;">
				Nama : <input type="text" name="name" placeholder="Nama" style="width:220px">
			</div>
			<div style="height:55px;float:left;position:relative;width:180px;">
				Competence : <br />
				<?php foreach($competence as $comp) : ?>
					<input type="checkbox" name="competence[]" value="<?php echo $comp->id_mas_competence ?>" /><?php echo substr($comp->name, 0, 1); ?>
				<?php endforeach ?>
			</div>
			<div style="height:55px;float:left;position:relative;width:180px;">
				Certificate : <input type="text" name="Certificate" placeholder="Sun Certified Developer" style="width:170px">
			</div>
			<div style="height:55px;float:left;position:relative;width:180px;" style="width:170px">
				Training : <input type="text" name="Certificate" placeholder="Oracle">
			</div>
			<div style="float:right;text-align:right;position:relative;width:180px;">
				<br>
				<input value=" Search " name="submit" id="btnSearch" type="submit" />
			</div>
		</div>
	</div>
	<div style="clear:both"></div>
	</form>
</div>
<div style="padding:5px;background:#FEFEFE;border:4px solid #EFEFEF;display:none" id="divResearcher">
	<div id="jqxgrid_researcher"></div>
</div>