<script type="text/javascript" src="<?php echo base_url();?>plugins/js/jquery/jquery-1.7.2.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>plugins/js/jquery/jquery.sparkline.min.js"></script>
<script>
	$(function(){
       $("#bar_pms").click();
	   $("#clearfilteringbutton, #refreshdatabutton").jqxButton({ height: 28, theme: theme });
	   $("#btn_list, #btn_new, #btn_show,#btn_report,#btn_print,#btn_excel").jqxButton({ height: 28, theme: theme });
	   $(".btn_detail, .btn_edit").jqxButton({ height: 30, theme: theme });
        
		$('.btn_edit').click(function () {
			document.location.href="<?php echo site_url('performance/system/update');?>/" + $(this).attr('id');
		});
        
		$('#btn_new').click(function () {
			document.location.href="<?php echo site_url('performance/system/update');?>";
		});
        
		$('#btn_indicator').click(function () {
			document.location.href="<?php echo base_url();?>idec_pms/performance_indicator";
		});
        
		$('#btn_show_edit').click(function () {
			document.location.href="<?php echo base_url();?>idec_pms/performance_target";
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
        
	   var source = {
			datatype: "json",
			type	: "POST",
			datafields: [
			{ name: 'urut'},
			{ name: 'id', type: 'number'},
			{ name: 'id_encrypt', type: 'string'},
			{ name: 'perform_name', type: 'string'},
			{ name: 'date', type: 'date'}
        ],
		url: "<?php echo site_url('performance/home/json'); ?>",
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
			width: '60%',
			selectionmode: 'singlerow',
			source: dataadapter, theme: theme,columnsresize: true,showtoolbar: false,
			showfilterrow: true, filterable: true, sortable: true, autoheight: true, pageable: true, virtualmode: true, editable: false,
			rendergridrows: function(obj)
			{
				return obj.data;    
			},
			columns: [
				<?php if($this->session->userdata('level')!="researcher"){ ?>{ text: 'Edit', align: 'center', filtertype: 'none', sortable: false, width: '6%', cellsrenderer: function (row) {
				    var dataRecord = $("#jqxgrid").jqxGrid('getrowdata', row);
					return "<div style='width:100%;padding-top:2px;text-align:center'><a href='javascript:void(0);'><img border=0 src='<?php echo base_url(); ?>public/images/edt.gif' onclick='edit("+dataRecord.id+");'></a> </div>";
                 }
                },<?php }?>
				{ text: 'Detail', align: 'center', filtertype: 'none', sortable: false, width: '6%', cellsrenderer: function (row) {
				    var dataRecord = $("#jqxgrid").jqxGrid('getrowdata', row);
					return "<div style='width:100%;padding-top:2px;text-align:center'><a href='javascript:void(0);'><img border=0 src='<?php echo base_url(); ?>media/images/16_view.gif' onclick='detail(\""+dataRecord.id_encrypt+"\");'></a></div>";
                 }
                },
				<?php if($this->session->userdata('level')!="researcher"){ ?>{ text: 'Del', align: 'center', filtertype: 'none', sortable: false, width: '6%', cellsrenderer: function (row) {
				    var dataRecord = $("#jqxgrid").jqxGrid('getrowdata', row);
					return "<div style='width:100%;padding-top:2px;text-align:center'><a href='javascript:void(0);'><img border=0 src='<?php echo base_url(); ?>public/images/del.gif' onclick='del_performance("+dataRecord.id+")'></a></div>";
                 }
                },<?php }?>
				{ text: 'Performance For', datafield: 'perform_name', columntype: 'textbox', filtertype: 'textbox', width: '60%' },
				{ text: 'Date Added', datafield: 'date', columntype: 'date', filtertype: 'date', cellsformat: 'yyyy-MM-dd', width: '22%' }
            ]
		});
        
		$('#clearfilteringbutton').click(function () {
			$("#jqxgrid").jqxGrid('clearfilters');
		});
        
 		$('#refreshdatabutton').click(function () {
			$("#jqxgrid").jqxGrid('updatebounddata', 'cells');
		});

		$('.percentage_yellow').easyPieChart({
			animate: 1000,
			size: 75,
			barColor:'#ffff00'
		});

		$('.percentage_green').easyPieChart({
			animate: 1000,
			size: 75,
			barColor:'#00cc00'
		});

		$('.percentage_red').easyPieChart({
			animate: 1000,
			size: 75,
			barColor:'#ff0000'
		});

		$('.percentage_orange').easyPieChart({
			animate: 1000,
			size: 75,
			barColor:'#ff9900'
		});
	});

	function detail(id){
		document.location.href="<?php echo site_url('performance/detail/');?>/" + id;
	}

	function edit(id){
		document.location.href="<?php echo site_url('performance/system/update/');?>/" + id;
	}

	function del_performance(id)
	{
		var confirms = confirm("Delete Performance?");
		if(confirms == true){
			$.post('<?php echo site_url("performance/system/delete/") ?>', 'id='+id, function(){
				alert('data deleted');

				$("#jqxgrid").jqxGrid('updatebounddata', 'cells');
			});
		}
	}

	var myvalues = [10,8,5,7,4,4,1];
	$('.dynamicsparkline').sparkline(myvalues);

</script>
<div class="row-fluid">
   <div class="span12">
	   <h3 class="page-title">
		 Performance
	   </h3>
   </div>
</div>
<div class="row-fluid">
	<?php $notice = $this->session->flashdata('notice') ?>
	<?php echo !empty($notice) ? '<div class="alert">'.$this->session->flashdata('notice') : '' ?>
</div>
<div id="popup" style="display:none">
	<div id="popup_title">Performance Report</div>
	<div id="popup_content">
		<div style="padding:2px;border:3px solid #FFF;height:40px;margin-top:10px">
			Triwulan : <select size="1" class="input" name="gendre" style="margin-top:8px;width:150px">
				<option>TW I - Maret</option>
				<option>TW II - Juni</option>
				<option>TW III - Sepetember</option>
				<option>TW IV - Desember</option>
			</select>
		</div>
		<div style="padding:2px;border:3px solid #FFF;height:40px;margin-top:10px">
			<input style="padding: 5px;width:100px" value=" PRINT" id="btn_print" type="button" />
			<input style="padding: 5px;width:100px" value=" EXCEL " id="btn_excel" type="button" />
		</div>
	</div>
</div>
<div>
	<div style="width:99%;background-color:#FFF;-moz-border-radius:5px;border-radius:5px;padding:2px;border:3px solid #FFF;">
		<div style="float:right;position:relative;width:600px;padding-right:1px;height:60px;text-align:right">
			<?php echo form_open() ?>
			<select size="1" class="input" name="year" style="width:150px;margin-top:10px;height:32px">
				<?php for($i=date('Y');$i>=(date('Y')-10);$i--) : ?>
					<option value="<?php echo $i ?>"><?php echo $i ?></option>
				<?php endfor ?>
			</select>
			<input style="width:80px;" value=" Go " id="refreshdatabutton" type="submit" name="submit" />
			</form>
		</div>
		<div style="float:left;position:relative;width:550px;top:20px;height:30px">
			<div style="font-size:20px"><a>Performansi Innovation & Design Center Tahun <?php echo $date ?></a></div>
		</div>
	</div>
	<div style="clear:both"></div>
	<div style="width:50%;float:left;background-color:#FFF;padding:2px;border:3px solid #FFF;height:30px;">
		<span style="font-size:14px">Latest Update (3 update terbaru)</span>
	</div>
	<div style="width:40%;float:right;text-align:right;background-color:#FFF;padding-right:5px;border:3px solid #FFF;height:30px;">
		<!--<input style="padding: 5px;width:150px" value=" Generate Report" id="btn_report" type="button" />-->
		<?php if($this->session->userdata('level')!="researcher"){ ?><input style="padding: 5px;width:100px" value=" Add New " id="btn_new" type="button" /><?php }?>
	</div>
	<div style="clear:both"></div>
	<?php foreach($performance as $perform) : ?>
	<?php
		$tw1 = $this->performance_model->getSumPeriode($perform->id_performance_system, 1);
		$tw2 = $this->performance_model->getSumPeriode($perform->id_performance_system, 2);
		$tw3 = $this->performance_model->getSumPeriode($perform->id_performance_system, 3);
		$tw4 = $this->performance_model->getSumPeriode($perform->id_performance_system, 4);


		if($tw1->total_achieve > 0) :
		if($tw1->total_achieve > $batasAtas) {
			$tw1 = 105;
		} elseif ($tw1->total_achieve < $batasBawah) {
			$tw1 = 60;
		} else {
			$tw1 = $tw1->total_achieve;
		} else :
			$tw1 = 0;
		endif;

		if($tw2->total_achieve > 0) :
		if($tw2->total_achieve > $batasAtas) {
			$tw2 = 105;
		} elseif ($tw2->total_achieve < $batasBawah) {
			$tw2 = 60;
		} else {
			$tw2 = $tw2->total_achieve;
		}
		else :
			$tw2 = 0;
		endif;

		if($tw3->total_achieve > 0) :
		if($tw3->total_achieve > $batasAtas) {
			$tw3 = 105;
		} elseif ($tw3->total_achieve < $batasBawah) {
			$tw3 = 60;
		} else {
			$tw3 = $tw3->total_achieve;
		}
		else :
			$tw3 = 0;
		endif;

		if($tw4->total_achieve > 0) :
		if($tw4->total_achieve > $batasAtas) {
			$tw4 = 105;
		} elseif ($tw4->total_achieve < $batasBawah) {
			$tw4 = 60;
		} else {
			$tw4 = $tw4->total_achieve;
		}
		else :
			$tw4 = 0;
		endif;
	?>
	<div style="width:98%;background:#EEEEEE;-moz-border-radius:5px;border-radius:5px;padding:6px;border:3px solid #ebebeb;">
		<div style="font-size:20px"><a name="summary"><?php echo $perform->perform_name ?></a></div>
		<div style="width:40%;">
			<div style="padding:15px;position:relative;float:left;width:75px;text-align:center">
				<b>TW I</b>
				<div data-percent="<?php echo $tw1 ?>" class="percentage_red success easyPieChart"><span><?php echo $tw1 ?></span>%<canvas height="95" width="95"></canvas></div>
			</div>
			<div style="padding:15px;position:relative;float:left;width:75px;text-align:center">
				<b>TW II</b>
				<div data-percent="<?php echo $tw2 ?>" class="percentage_orange success easyPieChart"><span><?php echo $tw2 ?></span>%<canvas height="95" width="95"></canvas></div>
			</div>
			<div style="padding:15px;position:relative;float:left;width:75px;text-align:center">
				<b>TW III</b>
				<div data-percent="<?php echo $tw3 ?>" class="percentage_yellow success easyPieChart"><span><?php echo $tw3 ?></span>%<canvas height="95" width="95"></canvas></div>
			</div>
			<div style="padding:15px;position:relative;float:left;width:75px;text-align:center">
				<b>TW IV</b>
				<div data-percent="<?php echo $tw4 ?>" class="percentage_green success easyPieChart"><span><?php echo $tw4 ?></span>%<canvas height="95" width="95"></canvas></div>
			</div>
		</div>
		<div style="padding:15px;position:relative;float:right;width:45%;">
			<div style="float:left;position:relative;width:70%">
				<?php echo $perform->desc ?><br><br>
				Limit Max : <?php echo $perform->limit_max ?><br>
				Limit Min : <?php echo $perform->limit_min ?><br>
			</div>
			<div style="float:right;position:relative;width:20%">
				<?php if($this->session->userdata('level')!="researcher"){ ?>
				<input style="width:100px;float:right" value=" Edit " class="btn_edit" id="<?php echo $perform->id_performance_system ?>" type="button" />
				<br><br><?php } ?>
				<a href="<?php echo site_url('performance/detail/' . md5($perform->id_performance_system)) ?>"><input style="width:100px;float:right" value=" Show Detail " class="btn_detail" type="button" /></a>
			</div>
		</div>
		<div style="clear:both"></div>
	</div>
	<div style="height:2px;clear:both"></div>
	<?php endforeach ?>
	<div style="width:98%;background:#EEEEEE;-moz-border-radius:5px;border-radius:5px;padding:6px;border:3px solid #ebebeb;">
		<div style="font-size:20px;padding:5px"><a>All Performances</a></div>
        <div id="jqxgrid"></div>
	</div>
	<br>
	<br>
	<br>
</div>
<br>
