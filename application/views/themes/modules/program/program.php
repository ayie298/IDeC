<script type="text/javascript" src="<?php echo base_url();?>plugins/js/jquery/jquery-1.7.2.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>plugins/js/jquery/jquery.sparkline.min.js"></script>
<script>
	$(function(){
		$("#bar_pms").click();
		<?php if($this->session->userdata('level')!="researcher"){?>$("#btn_new").jqxButton({ height: 28, theme: theme });

		$('#btn_new').click(function () {
			document.location.href="<?php echo site_url('program/update');?>";
		});<?php }?>
        
	   showGrid();

	   $('#btn_filter').click(function() {
	   		$.ajax({
	   			url : "<?php echo site_url('program');?>",
	   			type : "POST",
	   			data : $('form').serialize(),
	   			success : function() {
	   				showGrid();
	   			}
	   		})

	   		return false;
	   })

	});

	function detail(id){
		document.location.href="<?php echo site_url('program/detail/');?>/" + id;
	}

	function edit(id){
		document.location.href="<?php echo site_url('program/update/');?>/" + id;
	}

	function showGrid()
	{
		var source = {
			datatype: "json",
			type	: "POST",
			datafields: [
			{ name: 'urut'},
			{ name: 'id', type: 'number'},
			{ name: 'id_encrypt', type: 'string'},
			{ name: 'org_name', type: 'string'},
			{ name: 'bagian_org', type: 'string'},
			{ name: 'output', type: 'string'},
			{ name: 'program.name', type: 'string'}
        ],
		url: "<?php echo site_url('program/home/json');?>",
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
					return "<div style='width:100%;padding-top:2px;text-align:center'><a href='javascript:void(0);'><img border=0 src='<?php echo base_url(); ?>media/images/16_view.gif' onclick='detail(\""+dataRecord.id_encrypt+"\");'></a></div>";
                 }
                },
				<?php if($this->session->userdata('level')!="researcher"){?>{ text: 'Edit', align: 'center', filtertype: 'none', sortable: false, width: '4%', cellsrenderer: function (row) {
				    var dataRecord = $("#jqxgrid").jqxGrid('getrowdata', row);
					return "<div style='width:100%;padding-top:2px;text-align:center'><a href='javascript:void(0);'><img border=0 src='<?php echo base_url(); ?>public/images/edt.gif' onclick='edit(\""+dataRecord.id_encrypt+"\");'></a></div>";
                 }
                },
				{ text: 'Del', align: 'center', filtertype: 'none', sortable: false, width: '4%', cellsrenderer: function (row) {
				    var dataRecord = $("#jqxgrid").jqxGrid('getrowdata', row);
					return "<div style='width:100%;padding-top:2px;text-align:center'><a href='<?php echo site_url('program/home/delete/') ?>/"+dataRecord.id_encrypt+"'><img border=0 src='<?php echo base_url(); ?>public/images/del.gif' onclick='return confirm(\"Delete program ?\")'></a></div>";
                 }
                },<?php }?>
				{ text: 'Unit', datafield: 'org_name', columntype: 'textbox', filtertype: 'textbox', width: '20%' },
				{ text: 'Bagian / Lab', datafield: 'bagian_org', columntype: 'textbox', filtertype: 'textbox', width: '18%' },
				{ text: 'Program Name', datafield: 'program.name', columntype: 'textbox', filtertype: 'textbox', width: '30%' },
				{ text: 'Output', datafield: 'output', columntype: 'textbox', filtertype: 'textbox', width: '20%' }
            ]
		});
        
		$('#clearfilteringbutton').click(function () {
			$("#jqxgrid").jqxGrid('clearfilters');
		});
        
 		$('#refreshdatabutton').click(function () {
			$("#jqxgrid").jqxGrid('updatebounddata', 'cells');
		});
	}

</script>
<div class="row-fluid">
   <div class="span12">
	   <h3 class="page-title">
		 Program
	   </h3>
   </div>
</div>
<div class="row-fluid">
	<?php $notice = $this->session->flashdata('notice') ?>
	<?php echo !empty($notice) ? '<div class="alert">'.$this->session->flashdata('notice') : '' ?>
</div>
<div id="popup" style="display:none"><div id="popup_title">Program</div><div id="popup_content">{popup}</div></div>
<div>
	<div style="width:99%;background-color:#EEEEEE;-moz-border-radius:5px;border-radius:5px;padding:2px;border:3px solid #ebebeb;">
		<?php echo form_open() ?>
		<div style="float:right;position:relative;width:600px;padding-right:10px;height:60px;text-align:right">
		<?php echo form_open() ?>
			<input type="checkbox" class="input" name="prime" value="1" style="margin-top:-4px;">
			Show Primary Program Only
			<input type="text" class="input" name="name" placeholder="Filter" style="height:30px;width:200px;margin-top:8px;">
			<select size="1" class="input" name="year" style="width:120px">
			<option value="<?php echo date('Y') ?>">Choose year</option>
				<?php for($i=date('Y');$i>=date('Y')-10;$i--) : ?>
					<option value="<?php echo $i ?>"><?php echo $i ?></option>
				<?php endfor; ?>
			</select>
			<input type="submit" name="submit" id="btn_filter" value=" Search " />
		</form>
			<?php if($this->session->userdata('level')!="researcher"){?><input value=" Add New Program " id="btn_new" type="button" /><?php }?>
		</div>
		<div style="float:left;position:relative;width:550px;padding:5px;height:70px">
			<div style="font-size:20px">Program dan Performansi IDeC Tahun <?php echo date('Y') ?></div>
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
<br>
