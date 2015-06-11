<script>
    $(function(){
       $("#clearfilteringbutton, #refreshdatabutton,#btn_add").jqxButton({ height: 28, theme: theme });

       var source = {
            datatype: "json",
            type    : "POST",
            datafields: [
            { name: 'urut'},
            { name: 'id', type: 'number'},
            { name: 'lab', type: 'string'},
            { name: 'file', type: 'string'},
            { name: 'title', type: 'string'},
            { name: 'tim', type: 'string'},
            { name: 'tgl', type: 'date'},
            { name: 'hasil', type: 'string'}
        ],
        url: "<?php echo base_url(); ?>inovasi/inovasi_internal/json",
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
                { text: 'Judul Inovasi', datafield: 'title', columntype: 'textbox', filtertype: 'textbox', width: '23%' },
                { text: 'Lab', datafield: 'lab', columntype: 'textbox', filtertype: 'textbox', width: '23%' },
                { text: 'Tim Inovator', datafield: 'tim', columntype: 'textbox', filtertype: 'textbox', width: '13%' },
                { text: 'Tanggal Mulai', datafield: 'tgl', columntype: 'date', filtertype: 'date', cellsformat: 'yyyy/MM/dd', width: '10%' },
                { text: 'Final Step', datafield: 'hasil', columntype: 'textbox', filtertype: 'textbox', width: '13%' },
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
        document.location.href="<?php echo base_url();?>inovasi/inovasi_internal/add";
        });

    });

    function detail(id){
        document.location.href="<?php echo base_url();?>inovasi/inovasi_internal/detail/"+id;
    }

    function edit(id){
        document.location.href="<?php echo base_url();?>inovasi/inovasi_internal/edit/"+id;
    }

</script>
<div class="row-fluid">
   <div class="span12">
       <h3 class="page-title">
         <i class='icon-tasks'></i> Data Hasil Inovasi Internal
       </h3>
   </div>
</div>
<div id="popup" style="display:none"><div id="popup_title">Innovation</div><div id="popup_content">{popup}</div></div>
<div>
    <div class="div-grid">
        <div>Filter Data:</div>
        <div style="float:left;position:relative;width:80px;padding-left:40px">
            Year : <select size="1" class="input" name="year" style="width:110px">
                <option>2014</option>
                <option>2013</option>
            </select>
        </div>
        <div style="float:left;position:relative;width:190px;padding-left:40px">
            Judul : <input type="text" name="Judul" placeholder="Judul" style="width:180px;height:28px">
        </div>
        <div style="float:left;position:relative;width:190px;padding-left:20px">
            Tim Inovator: <input type="text" name="Tim" placeholder="Nama Tim" style="width:180px;height:28px">
        </div>
        <div style="float:left;position:relative;width:380px;padding-left:20px">
            <br>
            <button style='width:120px' id="refreshdatabutton" type="button" /><i class='icon-zoom-in'></i> Search</button>
            <button style='width:120px' id="clearfilteringbutton" type="button" /><i class='icon-rotate-left'></i> Clear Filter</button>
            <button style='width:120px' id="refreshdatabutton" type="button" /><i class='icon-refresh'></i> Refresh Data</button>
        </div>
        <?php if($this->session->userdata('level')!="researcher"){?><div style="float:right;position:relative;width:220px;text-align:right">
            <br>
             <button style='width:180px' id="btn_add" type="button" /><i class='icon-thumbs-up'></i> Tambah Hasil Inovasi</button>
        </div><?php }?>
        <div style="clear:both"></div>
    </div>
    <div class="div-grid">
        <div id="jqxgrid"></div>
    </div>
    <br>
    <br>
    <br>
</div>