<script type="text/javascript" src="/resources/js/nprogress.js"></script>
<link rel="stylesheet" href="/resources/css/nprogress.css">
<br>
<form id="getPdfForm" method="post" action="/reports/view/{$AccountID}/{$oConnection->ConnectionID}/pdf">  
    <input type="hidden" id="pdf_date_from" name="report_date_from" value="">
    <input type="hidden" id="pdf_date_to" name="report_date_to" value="">
</form>

<nav class="navbar navbar-default" role="navigation" style="margin-top:15px; margin-bottom: 15px;">
    <div class="container-fluid">

        <div class="navbar-header">
            <div class="navbar-brand">Summary Report</div>
        </div>

        {foreach $aoConnections as $conn}
            <a class="btn btn-{if $conn->ConnectionID eq $oConnection->ConnectionID}primary{else}default{/if} navbar-btn" href="/reports/view/{$conn->AccountID}/{$conn->ConnectionID}">{$conn->Type|ucfirst}</a>
        {/foreach}

        <form id="daterange" class="navbar-form navbar-right" role="form" method="post" action="/reports/view/{$AccountID}/{$oConnection->ConnectionID}">
            <div class="form-group">
                 <img src="/resources/img/loading.gif" style="display: none" id="pdf_loading">
                <span id="reportrange" style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc">
                  <i class="glyphicon glyphicon-calendar fa fa-calendar"></i>
                  <span></span> <b class="caret"></b>
               </span>               
                <input class="form-control input-sm" type="hidden" id="report_date_from" name="report_date_from" value="{$report_date_from}">
                <input class="form-control input-sm" type="hidden" id="report_date_to" name="report_date_to" value="{$report_date_to}">
                &nbsp;&nbsp;<span id="getPdf" class="btn btn-danger btn-sm ">PDF</span>
            </div>
        </form>
    </div>
</nav>
<input type="hidden" id="FileValue" name="FileValue"/>
{$report}

{literal}

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

$('#reportrange span').html('{/literal}{$report_date_from|date_format}{literal}' + ' - ' + '{/literal}{$report_date_to|date_format}{literal}');

                  $('#reportrange').daterangepicker(optionSet2, cb);
                  $('#reportrange').on('apply.daterangepicker', function(ev, picker) { 
                  $("#report_date_from").val( picker.startDate.format('MM/D/YYYY'));
                  $("#report_date_to").val( picker.endDate.format('MM/D/YYYY'));
                  $("#daterange").submit();                    
                  });                  
               });

      

</script>
{/literal}
