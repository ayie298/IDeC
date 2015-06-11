<script>
	$(function(){
		$("#btn_add7").jqxButton({ height: 28, theme: theme });
        showGrid();

		$('#btn_add7').click(function () {
			$("#jqxgrid_activity2").jqxGrid('updatebounddata', 'cells');
		});

		$('#Week').change(function(){
			$.ajax({
				url : '<?php echo current_url(); ?>',
				type : 'POST',
				data : $('#activity form').serialize(),
				success : function() {
					$("#jqxgrid_activity2").jqxGrid('updatebounddata', 'cells');
				}
			});

			return false;
		});

	});

	function showGrid()
	{
		var source = {
			datatype: "json",
			type	: "POST",
			datafields: [
			{ name: 'urut'},
			{ name: 'id', type: 'number' },
			{ name: 'step_name', type: 'string' },
			{ name: 'pr.name', type: 'string' },
			{ name: 'activity_detail', type: 'string' },
			{ name: 'step.weight', type: 'number' },
			{ name: 'pr.percent_progress', type: 'string' },
			{ name: 'position', type: 'string' },
			{ name: 'status', type: 'string' },
			{ name: 'activity_start_date', type: 'date' },
			{ name: 'activity_end_date', type: 'date' }
        ],
		url: "<?php echo site_url('researcher/project_member/ongoing_json/' . $id_employee) ?>",
		cache: false,
		updaterow: function (rowid, rowdata, commit) {
			},
		filter: function(){
			$("#jqxgrid_activity2").jqxGrid('updatebounddata', 'filter');
		},
		sort: function(){
			$("#jqxgrid_activity2").jqxGrid('updatebounddata', 'sort');
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
     
		$("#jqxgrid_activity2").jqxGrid(
		{		
			width: '100%',
			selectionmode: 'singlerow',
			source: dataadapter, theme: theme,columnsresize: true,showtoolbar: false, pagesizeoptions: ['10', '25', '50', '100', '200'],
			showfilterrow: false, filterable: true, sortable: true, autoheight: true, pageable: true, virtualmode: true, editable: false,
			rendergridrows: function(obj)
			{
				return obj.data;    
			},
			columns: [
				{ text: 'Project', datafield: 'pr.name', columntype: 'textbox', filtertype: 'textbox', width: '24%' },
				{ text: 'Step', datafield: 'step_name', columntype: 'textbox', filtertype: 'textbox', width: '18%' },
				{ text: 'Date Start', datafield: 'activity_start_date', columntype: 'date', filtertype: 'date', cellsformat: 'yyyy/MM/dd', width: '12%' },
				{ text: 'Date End', datafield: 'activity_end_date', columntype: 'date', filtertype: 'date', cellsformat: 'yyyy/MM/dd', width: '12%' },
				{ text: 'Position', datafield: 'position', columntype: 'textbox', filtertype: 'textbox', width: '11%' },
				{ text: 'Bobot', datafield: 'step.weight', columntype: 'textbox', filtertype: 'textbox', width: '6%' },
				{ text: 'Progress', datafield: 'pr.percent_progress', columntype: 'textbox', filtertype: 'textbox', width: '8%' },
				{ text: 'Status', datafield: 'status', columntype: 'textbox', filtertype: 'textbox', width: '9%' }
            ]
		});
	}

	function editactivity(id){
		var offset = $("#jqxgrid").offset();
		$.get("<?php echo base_url();?>idec_rms/researcher_add_activity/", function(response) {
			$("#popupactivity_content").html(response);
		});
		$("#popupactivity").jqxWindow({
			theme: theme, resizable: false,
			width: 600,
			height: 420,
			isModal: true, autoOpen: false, modalOpacity: 0.2
		});
		$("#popupactivity").jqxWindow('open');
	}

	function delactivity(id){
		confirm("Delete Activity");
	}

</script>
<div id="popupactivity" style="display:none">
	<div id="popupactivity_title">Researcher Activity</div>
	<div id="popupactivity_content"></div>
</div>
<div>
	<div id="activity" style="width:99%;background-color:#DDDDDD;-moz-border-radius:5px;border-radius:5px;padding:2px;border:3px solid #ebebeb;">
		<div style="float:left;padding:2px;position:relative;width:40%">
			<?php echo form_open() ?>
			<select size="1" class="input" name="month" id="Month" style="width: 150px;margin: 0;">
				<option value="01">Januari</option>
				<option value="02">Februari</option>
				<option value="03">Maret</option>
				<option value="04">April</option>
				<option value="05">Mei</option>
				<option value="06">Juni</option>
				<option value="07">Juli</option>
				<option value="08">Agustus</option>
				<option value="09">September</option>
				<option value="10">Oktober</option>
				<option value="11">November</option>
				<option value="12">Desember</option>
			</select>
			<select size="1" class="input" name="week" id="Week" style="width: 150px;margin: 0;">
				<option value="1">Week 1</option>
				<option value="2">Week 2</option>
				<option value="3">Week 3</option>
				<option value="4">Week 4</option>
			</select>
			</form>
		</div>
		<div style="float:right;text-align:right;padding:2px;position:relative;width:40%">
			<button id='btn_add7' type='button'>Refresh</button>
		</div>
        <div id="jqxgrid_activity2"></div>
	</div>
</div>