<script>
	$(function(){
       $("#bar_rms").click();
	   $("#clearfilteringbutton, #refreshdatabutton,#btn_add").jqxButton({ height: 25, theme: theme });

	   var source = {
			datatype: "json",
			type	: "POST",
			datafields: [
			{ name: 'urut'},
			{ name: 'id', type: 'number'},
			{ name: 'title', type: 'string'},
			{ name: 'user', type: 'string'},
			{ name: 'status', type: 'string'},
			{ name: 'org_name', type: 'string'}
        ],
		url: "<?php echo site_url('bantek/bantek_list/json'); ?>",
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
				{ text: 'Show', align: 'center', filtertype: 'none', sortable: false, width: '4%', cellsrenderer: function (row) {
				    var dataRecord = $("#jqxgrid").jqxGrid('getrowdata', row);
					return "<div style='width:100%;padding-top:2px;text-align:center'><a href='javascript:void(0);'><img border=0 src='<?php echo base_url(); ?>media/images/16_view.gif' onclick='detail("+dataRecord.id+");'></a></div>";
                 }
                },
				<?php if($this->session->userdata('level')!="researcher"){?>{ text: 'Edit', align: 'center', filtertype: 'none', sortable: false, width: '4%', cellsrenderer: function (row) {
				    var dataRecord = $("#jqxgrid").jqxGrid('getrowdata', row);
					return "<div style='width:100%;padding-top:2px;text-align:center'><a href='javascript:void(0);'><img border=0 src='<?php echo base_url(); ?>public/images/edt.gif' onclick='edit("+dataRecord.id+");'></a></div>";
                 }
                },
				{ text: 'Del', align: 'center', filtertype: 'none', sortable: false, width: '4%', cellsrenderer: function (row) {
				    var dataRecord = $("#jqxgrid").jqxGrid('getrowdata', row);
					return "<div style='width:100%;padding-top:2px;text-align:center'><a href='javascript:void(0);'><a href='javascript:void(0);'><img border=0 src='<?php echo base_url(); ?>public/images/del.gif' onclick='edit("+dataRecord.id+");'></a></div>";
                 }
                },<?php }?>
				{ text: 'Title', datafield: 'title', columntype: 'textbox', filtertype: 'textbox', width: '20%' },
				{ text: 'Partner Usaha', datafield: 'user', columntype: 'textbox', filtertype: 'textbox', width: '15%' },
				{ text: 'Status', datafield: 'status', columntype: 'textbox', filtertype: 'textbox', width: '8%' },
				{ text: 'Eksekutor', datafield: 'org_name', columntype: 'textbox', filtertype: 'textbox', width: '18%' }
            ]
		});
        
		$('#clearfilteringbutton').click(function () {
			$("#jqxgrid").jqxGrid('clearfilters');
		});
        
 		$('#refreshdatabutton').click(function () {
			var value = $('.unit').val();
			var year = $('.year').val();

			$.post("<?php echo site_url('bantek/bantek_list');?>", 'unit='+value+'&year='+year, function(response) {
				$("#jqxgrid").jqxGrid('updatebounddata', 'cells');
			});
		});

 		$('#btn_add').click(function () {
		document.location.href="<?php echo site_url('bantek/bantek_action/add');?>";
		});

	});

	function detail(id){
		document.location.href="<?php echo base_url();?>idec_rms/bantek_detail";
	}

	function edit(id){
		document.location.href="<?php echo base_url();?>idec_rms/bantek_edit";
	}

</script>
<div class="row-fluid">
   <div class="span12">
	   <h3 class="page-title">
		 BANTEK 
	   </h3>
   </div>
</div>
<div id="popup" style="display:none"><div id="popup_title">BANTEK</div><div id="popup_content">{popup}</div></div>
<div>
	<div style="width:99%;background-color:#EEEEEE;-moz-border-radius:5px;border-radius:5px;padding:2px;border:3px solid #ebebeb;">
		<div>Filter:</div>
		<div style="float:left;position:relative;width:190px;padding-left:40px">
			Initiator : <select size="1" class="input unit" name="unit">
				<option value="">All</option>
				<?php foreach($organization as $org) : ?>
					<option value="<?php echo $org->id_organization_item ?>"><?php echo $org->org_name ?></option>
				<?php endforeach ?>
			</select>
		</div>
		<div style="float:left;position:relative;width:190px;padding-left:40px">
			Year : <select size="1" class="input year" name="year">
				<option value="">All</option>
				<option value="2015">2015</option>
				<option value="2014">2014</option>
				<option value="2013">2013</option>
			</select>
		</div>
		<div style="float:left;position:relative;width:250px;padding-left:40px">
			<br>
			<input style="padding: 5px;" value=" Search " id="refreshdatabutton" type="button" />
			<input style="padding: 5px;" value=" Clear Filter " id="clearfilteringbutton" type="button" />
			<input style="padding: 5px;" value=" Refresh Data " id="refreshdatabutton" type="button" />
		</div>
		<div style="float:right;position:relative;width:220px;text-align:right">
			<br>
			<?php if($this->session->userdata('level')!="researcher"){?><input style="padding: 5px;width:150px;" value=" Add New " id="btn_add" type="button" /><?php }?>
			<!--<input style="padding: 5px;" value=" Manage Code " id="refreshdatabutton" type="button" />
			<input style="padding: 5px;" value=" Manage Group" id="refreshdatabutton" type="button" />-->
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