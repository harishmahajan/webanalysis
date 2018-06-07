<?php /* Smarty version Smarty-3.1.17, created on 2015-01-02 21:52:25
         compiled from "/var/www/application/public/templates/reports_view_html.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1977968638541920eb03c044-35821727%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '7d358c8aee31183498b1f09d7f904ca4bc5109ee' => 
    array (
      0 => '/var/www/application/public/templates/reports_view_html.tpl',
      1 => 1420264328,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1977968638541920eb03c044-35821727',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.17',
  'unifunc' => 'content_541920eb0a0984_01143103',
  'variables' => 
  array (
    'AccountID' => 0,
    'oConnection' => 0,
    'aoConnections' => 0,
    'conn' => 0,
    'report_date_from' => 0,
    'report_date_to' => 0,
    'report' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_541920eb0a0984_01143103')) {function content_541920eb0a0984_01143103($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_date_format')) include 'library/smarty/plugins/modifier.date_format.php';
?><script type="text/javascript" src="/resources/js/nprogress.js"></script>
<link rel="stylesheet" href="/resources/css/nprogress.css">
<br>
<form id="getPdfForm" method="post" action="/reports/view/<?php echo $_smarty_tpl->tpl_vars['AccountID']->value;?>
/<?php echo $_smarty_tpl->tpl_vars['oConnection']->value->ConnectionID;?>
/pdf">  
    <input type="hidden" id="pdf_date_from" name="report_date_from" value="">
    <input type="hidden" id="pdf_date_to" name="report_date_to" value="">
</form>

<nav class="navbar navbar-default" role="navigation" style="margin-top:15px; margin-bottom: 15px;">
    <div class="container-fluid">

        <div class="navbar-header">
            <div class="navbar-brand">Summary Report</div>
        </div>

        <?php  $_smarty_tpl->tpl_vars['conn'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['conn']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['aoConnections']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['conn']->key => $_smarty_tpl->tpl_vars['conn']->value) {
$_smarty_tpl->tpl_vars['conn']->_loop = true;
?>
            <a class="btn btn-<?php if ($_smarty_tpl->tpl_vars['conn']->value->ConnectionID==$_smarty_tpl->tpl_vars['oConnection']->value->ConnectionID) {?>primary<?php } else { ?>default<?php }?> navbar-btn" href="/reports/view/<?php echo $_smarty_tpl->tpl_vars['conn']->value->AccountID;?>
/<?php echo $_smarty_tpl->tpl_vars['conn']->value->ConnectionID;?>
"><?php echo ucfirst($_smarty_tpl->tpl_vars['conn']->value->Type);?>
</a>
        <?php } ?>

        <form id="daterange" class="navbar-form navbar-right" role="form" method="post" action="/reports/view/<?php echo $_smarty_tpl->tpl_vars['AccountID']->value;?>
/<?php echo $_smarty_tpl->tpl_vars['oConnection']->value->ConnectionID;?>
">
            <div class="form-group">
                 <img src="/resources/img/loading.gif" style="display: none" id="pdf_loading">
                <span id="reportrange" style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc">
                  <i class="glyphicon glyphicon-calendar fa fa-calendar"></i>
                  <span></span> <b class="caret"></b>
               </span>               
                <input class="form-control input-sm" type="hidden" id="report_date_from" name="report_date_from" value="<?php echo $_smarty_tpl->tpl_vars['report_date_from']->value;?>
">
                <input class="form-control input-sm" type="hidden" id="report_date_to" name="report_date_to" value="<?php echo $_smarty_tpl->tpl_vars['report_date_to']->value;?>
">
                &nbsp;&nbsp;<span id="getPdf" class="btn btn-danger btn-sm ">PDF</span>
            </div>
        </form>
    </div>
</nav>
<input type="hidden" id="FileValue" name="FileValue"/>
<?php echo $_smarty_tpl->tpl_vars['report']->value;?>




<script type="text/javascript">
/*https://developer.mozilla.org/en/docs/Web/API/Window*/


function p()
{
  alert("sd");
}



/*NProgress.start();
        setTimeout(function() { NProgress.done(); $('.fade').removeClass('out'); }, 1000);
         $("#getPdf").click(function() { NProgress.inc(); });*/
/*$(window).on("load",function()
{
  var ReTimer = setInterval(function() { 
            clearInterval(ReTimer);          
            console.log("1");
        }, 2000);
});*/
var TxtVar="0";
$("#getPdf").click(function(){
        $("#pdf_date_from").val($("#report_date_from").val());
        $("#pdf_date_to").val($("#report_date_to").val());         
        $("#pdf_loading").show();
        $("#getPdfForm").submit(); 
        /*$("#daterange").loadingbar({
            success: function(data, text, xhr) {$("#pdf_loading").hide();},
        });*/    
        NProgress.start(); 
        NProgress.set(0.4);
        NProgress.inc(); 
        /*$.get( "/reports/ReadFilePDF", function( data ) {
         console.log( data);
        });*/       
        $.ajax({
          url:'/reports/ReadFilePDF',
          dataType:'text',
          success:function(data)
          {
            console.log( data);
            if(data=="1")
            {
              NProgress.done();
              $("#pdf_loading").hide();
            }

          }
        });   
  
    });

$(document).ready(function() {
                  var cb = function(start, end, label) {
                    console.log(start.toISOString(), end.toISOString(), label);
                    $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
                    }


                  var optionSet2 = {
                    startDate: moment().subtract(7, 'days'),
                    endDate: moment(),
                    opens: 'left',
                    ranges: {
                       'Today': [moment(), moment()],
                       'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                       'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                       'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                       'This Month': [moment().startOf('month'), moment().endOf('month')],
                       'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
                    }
                  };

$('#reportrange span').html('<?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['report_date_from']->value);?>
' + ' - ' + '<?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['report_date_to']->value);?>
');

                  $('#reportrange').daterangepicker(optionSet2, cb);
                  $('#reportrange').on('apply.daterangepicker', function(ev, picker) { 
                  $("#report_date_from").val( picker.startDate.format('MM/D/YYYY'));
                  $("#report_date_to").val( picker.endDate.format('MM/D/YYYY'));
                  $("#daterange").submit();                    
                  });                  
               });

      

</script>

<?php }} ?>
