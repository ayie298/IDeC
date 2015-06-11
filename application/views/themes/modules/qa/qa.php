<script>
	$(function(){
       $("#bar_rms").click();
	   $("#clearfilteringbutton, #refreshdatabutton,#btn_add").jqxButton({ height: 28, theme: theme });
	   var source = {
				datatype: "json",
				type	: "POST",
				datafields: [
				{ name: 'urut', type: 'number'},
				{ name: 'id', type: 'number'},
				{ name: 'deskripsi', type: 'string'},
				{ name: 'file', type: 'string'},
				{ name: 'nama', type: 'string'},
				{ name: 'summary', type: 'string'},
				{ name: 'hasil', type: 'string'}
			],
			url: "<?php echo site_url('qa/qa_list/json' ); ?>",
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
					return "<div style='width:100%;padding-top:2px;text-align:center'><a href='javascript:void(0);'><a href='javascript:void(0);'><img border=0 src='<?php echo base_url(); ?>public/images/del.gif' onclick='del("+dataRecord.id+");'></a></div>";
                 }
                },<?php }?>
				{ text: 'Nama Produk', datafield: 'nama', columntype: 'textbox', filtertype: 'textbox', width: '25%' },
				{ text: 'Dasar Pelaksanaan', datafield: 'deskripsi', columntype: 'textbox', filtertype: 'textbox', width: '22%' },
				{ text: 'Executive Summary', datafield: 'summary', columntype: 'textbox', filtertype: 'textbox', width: '20%' },
				{ text: 'Kesimpulan Hasil', datafield: 'hasil', columntype: 'textbox', filtertype: 'textbox', width: '15%' },
				{ text: 'File', datafield: 'file', columntype: 'textbox', filtertype: 'textbox', width: '6%' }
            ]
		});
        
		$('#clearfilteringbutton').click(function () {
			$("#jqxgrid").jqxGrid('clearfilters');
		});
        
 		$('#refreshdatabutton').click(function () {
			$("#jqxgrid").jqxGrid('updatebounddata', 'cells');
		});

 		$('#btn_add').click(function () {
		document.location.href="<?php echo base_url();?>qa/qa_add";
		});

	});

	function detail(id){
		document.location.href="<?php echo base_url('qa/qa_edit/');?>?id="+id;
	}

	function edit(id){
		document.location.href="<?php echo base_url('qa/qa_edit/');?>?id="+id;
	}
	
	function del(id){
		document.location.href="<?php echo base_url('qa/qa_delete/');?>?id="+id;
	}

</script>
<div class="row-fluid">
   <div class="span12">
	   <h3 class="page-title">
		 Quality Assurance
	   </h3>
   </div>
</div>
<div id="popup" style="display:none"><div id="popup_title">QA</div><div id="popup_content">{popup}</div></div>
<div>
	<div style="width:99%;background-color:#EEEEEE;-moz-border-radius:5px;border-radius:5px;padding:2px;border:3px solid #ebebeb;color:black">
		<div>Filter Data:</div>
		<div style="float:left;position:relative;width:80px;padding-left:40px">
			Year : <select size="1" class="input" name="year" style="width:110px">
				<option>2014</option>
				<option>2013</option>
			</select>
		</div>
		<div style="float:left;position:relative;width:190px;padding-left:40px">
			Nama Produk : <input type="text" name="Judul" placeholder="Judul" style="width:180px;height:28px">
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