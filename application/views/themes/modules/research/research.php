<script>
	$(function(){
       $("#bar_rms").click();
	   $("#clearfilteringbutton, #refreshdatabutton,#btn_add").jqxButton({ height: 28, theme: theme });

	   var source = {
			datatype: "json",
			type	: "POST",
			datafields: [
			{ name: 'urut'},
			{ name: 'id', type: 'number'},
			{ name: 'executive_summary', type: 'string'},
			{ name: 'document_upload', type: 'string'},
			{ name: 'title', type: 'string'},
			{ name: 'number', type: 'string'},
			{ name: 'org_name', type: 'string'},
			{ name: 'research_team', type: 'string'}
        ],
		url: "<?php echo site_url('research/home/json'); ?>",
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
				{ text: 'Judul Dokumen', datafield: 'title', columntype: 'textbox', filtertype: 'textbox', width: '23%' },
				{ text: 'Summary', datafield: 'executive_summary', columntype: 'textbox', filtertype: 'textbox', width: '23%' },
				{ text: 'Nomor Dokumen', datafield: 'number', columntype: 'textbox', filtertype: 'textbox', width: '13%' },
				{ text: 'Lab / Unit', datafield: 'org_name', columntype: 'textbox', filtertype: 'textbox', width: '10%' },
				{ text: 'Penyusun', datafield: 'research_team', columntype: 'textbox', filtertype: 'textbox', width: '13%' },
				{ text: 'File', datafield: 'document_upload', columntype: 'textbox', filtertype: 'textbox', width: '6%' }
            ]
		});
        
		$('#clearfilteringbutton').click(function () {
			$("#jqxgrid").jqxGrid('clearfilters');
		});
        
 		$('#refreshdatabutton').click(function () {
			$("#jqxgrid").jqxGrid('updatebounddata', 'cells');
		});

 		$('#btn_add').click(function () {
		document.location.href="<?php echo site_url('research/add');?>";
		});

	});

	function detail(id){
		document.location.href="<?php echo base_url();?>idec_rms/research_detail";
	}

	function edit(id){
		document.location.href="<?php echo base_url();?>idec_rms/research_edit";
	}

</script>
<div class="row-fluid">
   <div class="span12">
	   <h3 class="page-title">
		 Innovation and Research
	   </h3>
   </div>
</div>
<div id="popup" style="display:none"><div id="popup_title">Innovation</div><div id="popup_content">{popup}</div></div>
<div>
	<div style="width:99%;background-color:#EEEEEE;-moz-border-radius:5px;border-radius:5px;padding:2px;border:3px solid #ebebeb;">
		<div>Filter:</div>
		<div style="float:left;position:relative;width:100px;padding-left:40px">
			Document : <select size="1" class="input" name="document" style="width:130px">
				<option>All</option>
				<option>Dokumen Teknik</option>
				<option>Dokumen Bisnis</option>
			</select>
		</div>
		<div style="float:left;position:relative;width:80px;padding-left:40px">
			Year : <select size="1" class="input" name="year" style="width:110px">
				<option>2014</option>
				<option>2013</option>
			</select>
		</div>
		<div style="float:left;position:relative;width:190px;padding-left:40px">
			Unit : <select size="1" class="input" name="unit">
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
		<div style="float:left;position:relative;width:250px;padding-left:40px">
			<br>
			<input style="padding: 5px;" value=" Search " id="refreshdatabutton" type="button" />
			<input style="padding: 5px;" value=" Clear Filter " id="clearfilteringbutton" type="button" />
			<input style="padding: 5px;" value=" Refresh Data " id="refreshdatabutton" type="button" />
		</div>
		<?php if($this->session->userdata('level')!="researcher"){?><div style="float:right;position:relative;width:220px;text-align:right">
			<br>
			<input style="padding: 5px;width:150px;" value=" Add New " id="btn_add" type="button" />
			<!--<input style="padding: 5px;" value=" Manage Code " id="refreshdatabutton" type="button" />
			<input style="padding: 5px;" value=" Manage Group" id="refreshdatabutton" type="button" />-->
		</div><?php }?>
		<div style="clear:both"></div>
	</div>
	<div style="width:99%;background-color:#DDDDDD;-moz-border-radius:5px;border-radius:5px;padding:2px;border:3px solid #ebebeb;">
        <div id="jqxgrid"></div>
	</div>
	<br>
	<br>
	<br>
</div>