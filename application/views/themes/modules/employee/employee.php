<script>
	$(function(){
       $("#bar_general").click();
	   $("#clearfilteringbutton, #refreshdatabutton,#btn_add").jqxButton({ height: 28, theme: theme });

	   showGrid();
        
        $('#btn_filter').click(function() {
	   		$.ajax({
	   			url : "<?php echo site_url('idec/employee');?>",
	   			type : "POST",
	   			data : $('form').serialize(),
	   			success : function() {
	   				$("#jqxgrid").jqxGrid('updatebounddata', 'cells');
	   			}
	   		})

	   		return false;
	   })

		$('#clearfilteringbutton').click(function () {
			$("#jqxgrid").jqxGrid('clearfilters');
		});
        
 		$('#refreshdatabutton').click(function () {
			$("#jqxgrid").jqxGrid('updatebounddata', 'cells');
		});

 		$('#btn_add').click(function () {
			document.location.href="<?php echo site_url('idec/employee/edit') ?>";
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
			{ name: 'id_encrypt', type: 'string' },
			{ name: 'nik', type: 'string' },
			{ name: 'name', type: 'string' },
			{ name: 'position', type: 'string' },
			{ name: 'bp', type: 'string' },
			{ name: 'org_name', type: 'string' }
        ],
		url: "<?php echo base_url(); ?>idec/employee/json",
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
				{ text: 'Detail', align: 'center', filtertype: 'none', sortable: false, width: '4%', cellsrenderer: function (row) {
				    var dataRecord = $("#jqxgrid").jqxGrid('getrowdata', row);
					return "<div style='width:100%;padding-top:2px;text-align:center'><a href='<?php echo site_url('idec/employee/detail/') ?>/"+dataRecord.id_encrypt+"'><img border=0 src='<?php echo base_url(); ?>media/images/16_view.gif'></a></div>";
                 }
                },
				{ text: 'Edit', align: 'center', filtertype: 'none', sortable: false, width: '4%', cellsrenderer: function (row) {
				    var dataRecord = $("#jqxgrid").jqxGrid('getrowdata', row);
					return "<div style='width:100%;padding-top:2px;text-align:center'><a href='<?php echo site_url('idec/employee/edit/') ?>/"+dataRecord.id_encrypt+"'><img border=0 src='<?php echo base_url(); ?>public/images/edt.gif'></a></div>";
                 }
                },
				{ text: 'Del', align: 'center', filtertype: 'none', sortable: false, width: '4%', cellsrenderer: function (row) {
				    var dataRecord = $("#jqxgrid").jqxGrid('getrowdata', row);
					return "<div style='width:100%;padding-top:2px;text-align:center'><a href='<?php echo site_url('idec/employee/delete/') ?>/"+dataRecord.id_encrypt+"'><img border=0 src='<?php echo base_url(); ?>public/images/del.gif' onclick='return confirm(\"Are you sure delete this data ?\")'></a></div>";
                 }
                },
				{ text: 'NIK', datafield: 'nik', columntype: 'textbox', filtertype: 'textbox', width: '6%' },
				{ text: 'Name', datafield: 'name', columntype: 'textbox', filtertype: 'textbox', width: '22%' },
				{ text: 'Posistion', datafield: 'position', columntype: 'textbox', filtertype: 'textbox', width: '36%' },
				{ text: 'BP', datafield: 'bp', columntype: 'textbox', filtertype: 'textbox', width: '4%' },
				{ text: 'Unit', datafield: 'org_name', columntype: 'textbox', filtertype: 'textbox', width: '20%' }
            ]
		});
	}

	function detail(id){
		document.location.href="<?php echo base_url();?>idec_general/employee_detail";
	}

	function edit(id){
		document.location.href="<?php echo base_url();?>idec_general/employee_edit";
	}

	function del(id){
		confirm("Delete data?");
	}

	function close_dialog(s){
		$("#popup").jqxWindow('close');
		if(s==1){
			$("#jqxgrid").jqxGrid('updatebounddata', 'cells');
		}
	}
</script>
<div class="row-fluid">
   <div class="span12">
	   <h3 class="page-title">
		 Employee
	   </h3>
   </div>
</div>
<div id="popup" style="display:none"><div id="popup_title">Employee</div><div id="popup_content">{popup}</div></div>
<div>
	<div style="width:99%;background-color:#EEEEEE;-moz-border-radius:5px;border-radius:5px;padding:2px;border:3px solid #ebebeb;">
		<div>Filter:</div>
		<?php echo form_open() ?>
		<div style="float:left;position:relative;width:300px;padding-left:40px">
			Unit : <select class="input" name="org" style="width:300px">
				<option value="">-</option>
				<?php foreach($organization as $org) : ?>
					<option value="<?php echo $org->id_organization_item ?>"><?php echo strtoupper($org->org_name) ?></option>
				<?php endforeach ?>
			</select>
		</div>
		<div style="float:left;position:relative;width:90px;padding-left:40px">
			Jenis Kelamin : <select class="input" name="gender" style="width:100px">
				<option value="">-</option>
				<option value="male">L</option>
				<option value="female">P</option>
			</select>
		</div>
		<div style="float:left;position:relative;width:90px;padding-left:40px">
			Usia : <select class="input" name="old" style="width:100px">
				<option value="">-</option>
				<option value=">50">>50</option>
				<option value="40">40-50</option>
				<option value="30">30-40</option>
				<option value="<30"><30</option>
			</select>
		</div>
		<div style="float:left;position:relative;width:250px;padding-left:40px">
			<br>
			<input style="padding: 5px;" value=" Search " id="btn_filter" type="button" />
			<input style="padding: 5px;" value=" Clear Filter " id="clearfilteringbutton" type="button" />
			<input style="padding: 5px;" value=" Refresh Data " id="refreshdatabutton" type="button" />
		</div>
	</form>
		<div style="float:right;text-align:right;position:relative;width:100px;padding-right:10px">
			<br>
			<input style="padding: 5px;" value=" Add Employee " id="btn_add" type="button" />
		</div>
		<div style="clear:both"></div>
	</div>
	<div style="width:99%;background-color:#DDDDDD;-moz-border-radius:5px;border-radius:5px;padding:2px;border:3px solid #ebebeb;">
        <div id="jqxgrid"></div>
	</div>
	<br>
	<br>
	<br>
</div>