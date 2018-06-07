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
                <input class="form-control input-sm" type="text" id="report_date_from" name="report_date_from" value="{$report_date_from}">
                <input class="form-control input-sm" type="text" id="report_date_to" name="report_date_to" value="{$report_date_to}">
                <span id="getPdf" class="btn btn-danger btn-sm">PDF</span>
            </div>
        </form>

    </div>
</nav>

{$report}

{literal}
<script type="text/javascript">
<!--
$(function() {
    $( "#report_date_from" ).datepicker({
        changeMonth: true,
        onClose: function( selectedDate ) {
            $("#report_date_to").datepicker( "option", "minDate", selectedDate );
        },
        onSelect: function (dateText, inst) {
            $("#daterange").submit();
        }
    });
    $( "#report_date_to" ).datepicker({
        changeMonth: true,
        onClose: function( selectedDate ) {
            $("#report_date_from").datepicker( "option", "maxDate", selectedDate );
        },
        onSelect: function (dateText, inst) {
            $("#daterange").submit();
        }
    });
    $("#getPdf").click(function(){
        $("#pdf_date_from").val($("#report_date_from").val());
        $("#pdf_date_to").val($("#report_date_to").val());
        $("#getPdfForm").submit();
    });
});
// -->
</script>
{/literal}
