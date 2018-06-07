<?php /* Smarty version Smarty-3.1.17, created on 2014-11-18 00:38:27
         compiled from "/var/www/application/public/templates/chart_pdf.tpl" */ ?>
<?php /*%%SmartyHeaderCode:3785892025469b98fb0a9d1-91363526%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '154d59c43f89e8d333f4f6b47bc0f0f882cb2992' => 
    array (
      0 => '/var/www/application/public/templates/chart_pdf.tpl',
      1 => 1416299891,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '3785892025469b98fb0a9d1-91363526',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.17',
  'unifunc' => 'content_5469b9901bbe89_20281060',
  'variables' => 
  array (
    'args' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5469b9901bbe89_20281060')) {function content_5469b9901bbe89_20281060($_smarty_tpl) {?><div id="chart_div"></div>
<script type="text/javascript" src="https://www.google.com/jsapi"></script>
<script type="text/javascript">
    google.load("visualization", "1", {packages:["corechart"]});
google.setOnLoadCallback(drawChart);
function drawChart() {

    var data = google.visualization.arrayToDataTable(<?php echo $_smarty_tpl->tpl_vars['args']->value['_d'];?>
);

    var options = <?php echo $_smarty_tpl->tpl_vars['args']->value['_o'];?>
;
    var chart = new google.visualization.<?php echo $_smarty_tpl->tpl_vars['args']->value['_t'];?>
(document.getElementById("chart_div"));
     google.visualization.events.addListener(chart, 'ready', function () {
        document.write('<img src="' +  chart.getImageURI() + '">');
      });
    chart.draw(data, options);
}



</script>

<?php }} ?>
