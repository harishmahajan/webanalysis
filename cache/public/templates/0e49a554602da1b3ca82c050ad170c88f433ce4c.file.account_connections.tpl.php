<?php /* Smarty version Smarty-3.1.17, created on 2015-03-16 22:15:13
         compiled from "/var/www/application/public/templates/account_connections.tpl" */ ?>
<?php /*%%SmartyHeaderCode:462638443541979400ff756-12055988%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '0e49a554602da1b3ca82c050ad170c88f433ce4c' => 
    array (
      0 => '/var/www/application/public/templates/account_connections.tpl',
      1 => 1426569302,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '462638443541979400ff756-12055988',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.17',
  'unifunc' => 'content_541979402090e8_68435131',
  'variables' => 
  array (
    'accountID' => 0,
    'account_error' => 0,
    'oConnections' => 0,
    'fb_date_from' => 0,
    'fb_date_to' => 0,
    'import_msg' => 0,
    'fb_app_id' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_541979402090e8_68435131')) {function content_541979402090e8_68435131($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_date_format')) include 'library/smarty/plugins/modifier.date_format.php';
?><br>
<nav class="navbar navbar-default" role="navigation" style="margin-top:15px; margin-bottom: 15px;">
    <div class="container-fluid">
            <a class="btn btn-info navbar-btn navbar-right btnPadding" href="/account/pop/<?php echo $_smarty_tpl->tpl_vars['accountID']->value;?>
" id="btnAddCon">New Connection</a>
    </div>
</nav>
<link rel="stylesheet" type="text/css" media="all" href="/resources/css/daterangepicker-bs3.css" />
<script type="text/javascript" src="/resources/js/moment.min.js"></script>
<script type="text/javascript" src="/resources/js/daterangepicker.js"></script>
<div id="fb-root"></div>

<form id="getPdfForm" method="post" action="/reports/view/<?php echo $_smarty_tpl->tpl_vars['accountID']->value;?>
">
    <input type="hidden" id="pdf_date_from" name="report_date_from" value="">
    <input type="hidden" id="pdf_date_to" name="report_date_to" value="">
</form>
                <?php if ($_smarty_tpl->tpl_vars['account_error']->value) {?>
                    <div class="alert alert-warning" id="ErrDiv">
                       <a href="#" class="close" onclick="$('#ErrDiv').hide()">
                          &times;
                       </a>
                       <strong>Missing Connections:</strong> <lable id="Errolab"><?php echo $_smarty_tpl->tpl_vars['account_error']->value;?>
</lable>
                       </div>
                    <div class="clearfix"></div>
                   <!--  <div class="form-group">
                        <p class="text-center text-danger">
                            <?php echo $_smarty_tpl->tpl_vars['account_error']->value;?>

                        </p>
                    </div> -->
                <?php }?>
<div class="panel panel-default" style="margin-top:20px;">
    <div class="panel-heading">Facebook connection</div>
    <div class="panel-body">
        <p>

            <div id="facebook_connect">
                <div class="row">
                    <div class="col-xs-4">
                        <button id="fb_connect_link" class="btn btn-primary">Load data from Facebook</button>
                    </div>
                    <div class="col-xs-8 text-right strong">
                        <strong>
                        <?php if ($_smarty_tpl->tpl_vars['oConnections']->value['facebook']) {?>
                            Data loaded from <?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['oConnections']->value['facebook']->FromDate,"%D");?>
 to <?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['oConnections']->value['facebook']->ToDate,"%D");?>

                        <?php }?>
                        </strong>
                    </div>
                </div>
            </div>

            <div id="facebook_select_page" style="display: none">
                <div class="form-group">
                    <?php if ($_smarty_tpl->tpl_vars['oConnections']->value['facebook']->ExternalConnectionID) {?>
                        <div id="fb_external_pageid" style="display: none"><?php echo $_smarty_tpl->tpl_vars['oConnections']->value['facebook']->ExternalConnectionID;?>
</div>
                    <?php }?>

                    <label for="fb_select_page">Select page:</label>
                    <select class="form-control" id="fb_select_page"></select>
                </div>
                <div class="form-group">
                    <label for="fb_date_from">Select data range:</label>
                    <div class="row">
                        <div class="col-md-6">
                            <div id="reportrange" style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc">
                              <i class="glyphicon glyphicon-calendar fa fa-calendar"></i>
                              <span></span> <b class="caret"></b>
                           </div>
                        </div>
                        <div class="col-xs-6">                        
                            <input class="form-control" type="hidden" id="fb_date_from" name="fb_date_from" value="<?php echo $_smarty_tpl->tpl_vars['fb_date_from']->value;?>
">                   
                            <input class="form-control" type="hidden" id="fb_date_to" name="fb_date_to" value="<?php echo $_smarty_tpl->tpl_vars['fb_date_to']->value;?>
">
                        </div>
                       
                    </div>
                </div>

                <button id="fb_link_page" class="btn btn-primary">Load data</button>
                <input id="accountID" type="hidden" name="accountID" value="<?php echo $_smarty_tpl->tpl_vars['accountID']->value;?>
">
            </div>

            <div id="facebook_loading" style="display: none">
                <img src="/resources/img/loading.gif">
            </div>

            <div id="facebook_requesting" style="display: none">
                Requesting data from facebook:

                <div class="progress">
                    <div id="fb_progressbar" class="progress-bar" role="progressbar" style="width: 0%;"></div>
                </div>

            </div>


        </p>
    </div>
</div>
<div class="panel panel-default" style="margin-top:20px;">
    <div class="panel-heading">Twitter connection</div>
    <div class="panel-body">
        <p>
            <div id="twitter_connect">
                <?php if ($_smarty_tpl->tpl_vars['oConnections']->value['twitter']->ExternalConnectionID) {?>
                    <div class="col-xs-5">
                        Twitter live stream connected to: <b>@<?php echo $_smarty_tpl->tpl_vars['oConnections']->value['twitter']->Name;?>
</b>
                        <div>
                            Connected starting from: <?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['oConnections']->value['twitter']->FromDate,"%D");?>

                        </div>
                    </div>
                    <div class="col-xs-7 text-center">
                        <div class="well well-sm">
                            <div>
                                <strong>Import Twitter historical data</strong>
                            </div>
                            <?php if ($_smarty_tpl->tpl_vars['import_msg']->value) {?>
                                <div style="color:red">
                                    <strong><?php echo $_smarty_tpl->tpl_vars['import_msg']->value;?>
</strong>
                                </div>
                            <?php }?>
                            <form class="form-inline" role="form" method="post" action="/account/connections/<?php echo $_smarty_tpl->tpl_vars['accountID']->value;?>
" enctype="multipart/form-data">
                                <div class="form-group">
                                    <input type="file" name="twitter_cvs" class="btn btn-default">
                                </div>
                                <input type="hidden" name="action" value="twitter_cvs">
                                <input type="submit" value="import" class="btn btn-primary" onclick='$("#tw_loading").show();$(this).hide();'>
                                <img style="display: none" id="tw_loading" src="/resources/img/loading.gif">
                            </form>
                        </div>
                    </div>
                <?php } else { ?>
                    <button id="tw_connect_link" class="btn btn-primary">Connect to Twitter live data stream</button>
                <?php }?>
            </div>
        </p>
    </div>
</div>
<br>
<div>
    <a href="/account/delpop/<?php echo $_smarty_tpl->tpl_vars['accountID']->value;?>
" id="delLink" style="color: red; font-weight: bold; font-size: large; float: right">
        Delete Account
    </a>
</div>

<script type="text/javascript">

/*$('#delLink').click(function(){

   $('#DelModal').modal('show');
   $('body#changeColor').css('padding-right','0px');

});*/
               $(document).ready(function() {

                  var cb = function(start, end, label) {
                    console.log(start.toISOString(), end.toISOString(), label);
                    $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
                    //alert("Callback has fired: [" + start.format('MMMM D, YYYY') + " to " + end.format('MMMM D, YYYY') + ", label = " + label + "]");
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

                  $('#reportrange span').html(moment().subtract(30, 'days').format('MMMM D, YYYY') + ' - ' + moment().format('MMMM D, YYYY'));

                  $('#reportrange').daterangepicker(optionSet2, cb);
                  
                  $('#reportrange').on('apply.daterangepicker', function(ev, picker) { 

                    $("#fb_date_from").val( picker.startDate.format('MM/D/YYYY'));
                    $("#fb_date_to").val( picker.endDate.format('MM/D/YYYY'));                   
                  });
                  
               });


<!--
var fb_app_id = '<?php echo $_smarty_tpl->tpl_vars['fb_app_id']->value;?>
';


function dateConverter(timestamp)
{
    var date = new Date(timestamp * 1000),
        year = date.getFullYear(),
        month = date.getMonth(),
        day = date.getDate();

    month++;
    return year +'-'+ (month<10?'0':'') + month + '-' + (day<10?'0':'') + day;
}

var t = 0;
function fb_save(accountID, pageID, action, data, from, to){
    $.ajax({
        type: "POST",
        url: "/ajax/fb_datain",
        data: {
            accountID : accountID,
            pageID : pageID,
            action : action,
            from : dateConverter(from),
            to : dateConverter(to),
            data : data
        },
        dataType: 'text'
    });
};

var fb_req = {};
function fb_requesting_reset(){
    // update
    fb_req = {req:0,res:0};
    $("#fb_progressbar").css('width', "0%").text('0%');
};

var fb_cache;
var fb_data_cache = {};
$(function(){

    // download indicator
    $( document ).ajaxSend(function() {
        fb_req['req']++;
        //console.log('request send: '+fb_req['req']);
    });
    $( document ).ajaxComplete(function() {

        fb_req['res']++;
        var presentage = parseInt(fb_req['res'] * 100 / fb_req['req'],10);
        // update
        $("#fb_progressbar").css('width', presentage+'%').text(presentage+'%');

        // do not redirect
        /*
        if(fb_req['res'] == fb_req['req']){
            $("#pdf_date_from").val($("#fb_date_from").val());
            $("#pdf_date_to").val($("#fb_date_to").val());
            $("#getPdfForm").submit();
        }
        */

    });

    var fb_get_accounts = function(userID){

        FB.api(userID + "/accounts", function (response){

            var fb_select = $("#fb_select_page");
            var fb_external_pageid = $("#fb_external_pageid").text() || false;

            // flush the cache
            fb_cache = [];

            // clear the selectbox
            fb_select.find('option').remove();

            if(!fb_external_pageid)
            {
                fb_select.append('<option value="">Select page...</option>');
            }

            $.each(response.data, function() {
                if(fb_external_pageid)
                {
                    if(fb_external_pageid != this.id)
                        return;
                }
                fb_cache[this.id] = this.access_token;
                fb_select.append($("<option />").val(this.id).text(this.name));
            });

            $("#facebook_loading").hide();
            $("#facebook_select_page").show();

        });

    };

    // IN example: 2014-01-20T06:19:24+0000
    // OUT example: 2014-01-19
    var utc_datetime_to_pst_date = function(uts_datetime){
        console.log("UTC: "+uts_datetime);
        var d = new Date(uts_datetime);
        var utc_time = d.getTime()/1000;
        //old code
        //doing calculation with 8 * 60 * 60 this will deduct one day from date
        // IN example: 2014-01-20T06:19:24+0000
        //OUT example: 2014-01-19
        var pst_time = ( utc_time - ( 9 * 60 * 60 ) );

        //new code
        //if you don't want deduct one day from date
        // IN example: 2014-05-16T07:00:00+0000
        // OUT example: 2014-05-16
        //var pst_time = ( utc_time - ( 7 * 60 * 60 ) );

        var d2 = new Date((pst_time*1000)); 
        return '' + d2.getUTCFullYear() + '-' + (d2.getUTCMonth()<9?'0':'') + (1+d2.getUTCMonth()) + '-' + (d2.getUTCDate()<10?'0':'') + d2.getUTCDate();
    }

    var fb_getUpdateData = function(accountID, pageID, accTok, from, to){

        //fb_requesting_new(4);
        FB.api('/' +pageID + '/insights', 'get', {
            fields: 'page_fan_adds',
            period: 'lifetime',
            since : from,
            until : to,
            access_token : accTok
        }, function (response) {

            // lets store the data
            if (response.error) {
              console.log('Error - ' + response.error.message);
              return
            } 
            for (var j = 0, jlen = response.data.length; j < jlen; j++) {

                if (response.data[j].name == "page_fans") {

                    var data = {};
                    for (var i = 0, ilen = response.data[j].values.length; i < ilen; i++) {
                        if(response.data[j].values[i].value == 0) continue;

                        /*
                        var d = response.data[j].values[i].end_time.split("-");
                        data[d[0]+'-'+d[1]+'-'+d[2].substr(0,2)] = response.data[j].values[i].value || 0;
                        */
                        data[utc_datetime_to_pst_date(response.data[j].values[i].end_time)] = response.data[j].values[i].value || 0;

                    };
                    fb_save(accountID, pageID, 'page_fans',data, from, to);
                };

                if (response.data[j].name == "page_fans_city" || response.data[j].name == "page_fans_country" || response.data[j].name == "page_fans_gender_age") {

                    var data = {};
                    for (var i = 0, ilen = response.data[j].values.length; i < ilen; i++) {

                        /*
                        var d = response.data[j].values[i].end_time.split("-");
                        var dd = d[0]+'-'+d[1]+'-'+d[2].substr(0,2);
                        */
                        var dd = utc_datetime_to_pst_date(response.data[j].values[i].end_time);

                        if(response.data[j].values[i].value.length == 0) continue;

                        data[dd] = {};
                        for(var key in response.data[j].values[i].value){
                            data[dd][key] = response.data[j].values[i].value[key] || 0;
                        };

                    };
                    fb_save(accountID, pageID, response.data[j].name,data, from, to);
                };

            };

        });

        //fb_requesting_new(4);
        FB.api('/' +pageID + '/insights', 'get', {
            fields: 'page_fan_adds',
            period: 'day',
            since : from,
            until : to,
            access_token : accTok
        }, function (response) {

            // data to main table
            var udata = {};

            // lets store the data
            for (var j = 0, jlen = response.data.length; j < jlen; j++) {


                if (
                        response.data[j].name == "page_storytellers" ||
                        response.data[j].name == "page_impressions_unique" ||
                        response.data[j].name == "page_impressions" ||
                        response.data[j].name == "page_engaged_users" ||
                        response.data[j].name == "page_fans_online_per_day" ||
                        response.data[j].name == "page_impressions_paid" ||
                        response.data[j].name == "page_impressions_organic" ||
                        response.data[j].name == "page_fan_removes" ||
                        response.data[j].name == "page_fan_adds_unique" ||
                        response.data[j].name == "page_consumptions"
                ) {
                    udata[response.data[j].name] = {};

                    for (var i = 0, ilen = response.data[j].values.length; i < ilen; i++) {
                        /*
                        var d = response.data[j].values[i].end_time.split("-");
                        udata[response.data[j].name][d[0]+'-'+d[1]+'-'+d[2].substr(0,2)] = response.data[j].values[i].value || 0;
                        */
                        udata[response.data[j].name][utc_datetime_to_pst_date(response.data[j].values[i].end_time)] = response.data[j].values[i].value || 0;
                    };
                };

                if ( response.data[j].name == "page_positive_feedback_by_type" ){
                    udata['page_comment'] = {};
                    udata['page_like'] = {};
                    udata['page_link'] = {};

                    for (var i = 0, ilen = response.data[j].values.length; i < ilen; i++) {
                        /*
                        var d = response.data[j].values[i].end_time.split("-");
                        var dd = d[0]+'-'+d[1]+'-'+d[2].substr(0,2);
                        */
                        var dd = utc_datetime_to_pst_date(response.data[j].values[i].end_time);

                        udata['page_comment'][dd] = response.data[j].values[i].value.comment || 0;
                        udata['page_like'][dd] = response.data[j].values[i].value.like || 0;
                        udata['page_link'][dd] = response.data[j].values[i].value.link || 0;
                    };
                };

                if (response.data[j].name == "page_fans_by_like_source" || response.data[j].name == "page_storytellers_by_age_gender" || response.data[j].name == "page_views_external_referrals") {

                    var data = {};
                    var temp={};
                    for (var i = 0, ilen = response.data[j].values.length; i < ilen; i++) {
                        /*
                        var d = response.data[j].values[i].end_time.split("-");
                        var dd = d[0]+'-'+d[1]+'-'+d[2].substr(0,2);
                        */
                        var dd = utc_datetime_to_pst_date(response.data[j].values[i].end_time);
                        
                        if(response.data[j].values[i].value.length == 0) continue;
                        data[dd] = {};
                        for(var key in response.data[j].values[i].value){
                            //temp[dd][key] =response.data[j].values[i].value;
                            data[dd][key] = response.data[j].values[i].value[key] || 0;
                        };

                        console.log(data);
                        

                    };
                    //var arr = Object.keys(data).map(function(k) { return data[k] });
                    
                    fb_save(accountID, pageID, response.data[j].name,data, from, to);
                };

            };

            //alert(JSON.stringify(data));
            fb_save(accountID, pageID, 'DataFb',udata, from, to);

        });

        FB.api('/' +pageID + '/posts', 'get', {
            period: 'day',
            since : from,
            until : to,
            access_token : accTok
        }, function (response) {

            $(response.data).each(function (index, element){

                if (element.message == undefined){
                    element.message = element.story || element.description;
                }

                //fb_requesting_new(1);
                FB.api('/' +element.id + '/insights', 'get', {
                    access_token : accTok
                }, function (response) {

                    var dataset = {};
                    dataset['id'] = element.id;
                    /*
                    dataset['day'] = element.created_time.substr(0, 10);
                    */
                    dataset['day'] = utc_datetime_to_pst_date(element.created_time);
                    dataset['link'] = element.link;
                    dataset['message'] = element.message.substr(0, 50);

                    $(response.data).each(function (index, elementIn) {

                        if( elementIn.name == "post_story_adds" ||
                            elementIn.name == "post_consumptions" ||
                            elementIn.name == "post_impressions_unique" ||
                            elementIn.name == "post_impressions_fan_unique" ||
                            elementIn.name == "post_impressions" ||
                            elementIn.name == "post_impressions_viral_unique" ||
                            elementIn.name == "post_engaged_users" ||
                            elementIn.name == "post_stories_by_action_type"
                        ){
                            dataset[elementIn.name] = elementIn.values[0].value;
                        }

                        // last element just to save values
                        if (elementIn.name == "post_stories_by_action_type") {
                            fb_save(accountID, pageID, 'DataFb_Posts',dataset, from, to);
                        }

                    });


                });

            });

        });

    };

    $("#fb_link_page").click(function(){

        var from = timestamp($("#fb_date_from").val()+" 00:00:00");
        var to = timestamp($("#fb_date_to").val()+" 23:59:59");

        //deduct 24 hour 
        //input :12/1/2014
        //output:11/30/2014
        from-=(24*60*60);

        //add 24 hour
        //input :12/31/2014
        //output:1/1/2015
        to+=(24*60*60);
        /*
        note: 
        Q: why we need to deduct 24 hour FROM var from and add 24 hour in var to?
        A: data you fetch for 2014-12-01 actually belong to 2014-11-30, 2014-12-02 actually belong to 2014-12-01 and Vice versa. so your are selecting date 2014-12-01 to 2014-12-31 but your actually getting data for 2014-11-30 to 2014-12-30 to solve this deduction and addition is implimented.
        */
        function timestamp(input)
        {
            var dateString = input,
            dateParts = dateString.split(' '),
            timeParts = dateParts[1].split(':'),
            date;

            dateParts = dateParts[0].split('/');
           
            var humDate = new Date(Date.UTC(dateParts[2],
            (stripLeadingZeroes(dateParts[0])-1),
            stripLeadingZeroes(dateParts[1]),
            stripLeadingZeroes(timeParts[0]),
            stripLeadingZeroes(timeParts[1]),
            stripLeadingZeroes(timeParts[2])));
            
            return (humDate.getTime()/1000.0);
        }

        function stripLeadingZeroes(input)
        {
            if((input.length > 1) && (input.substr(0,1) == "0"))
              return input.substr(1);
            else
              return input;
        }

        /*
        old code
        var from = ($.datepicker.formatDate('@', $.datepicker.parseDate('mm/dd/yy',$("#fb_date_from").val()))/1000);
        var to = ($.datepicker.formatDate('@', $.datepicker.parseDate('mm/dd/yy',$("#fb_date_to").val()))/1000);

        alert ("first "+from+" "+to);
        // deduct 1 day at from
        from -= ( 60 * 60 * 24 );

        // lets add 23:59:59
        to += (( 60 * 60 * 24 ) - 1);
alert ("2 "+from+" "+to);*/
        
        $("#facebook_select_page").hide();
        $("#facebook_requesting").show();
        fb_requesting_reset();

        var pageID = $("#fb_select_page").val();
        var accountID = $("#accountID").val();
        var accTok = fb_cache[pageID];
        // sent short access token to server, so ve can request long access topen and store it to db :)
        $.ajax({
            type: "POST",
            url: "/ajax/fb_short_token",
            data: {
                accountID : accountID,
                pageID : pageID,
                accTok : accTok
            },
            dataType: 'text'
        });

        var tendays = ( 10 * 60 * 60 * 24 );
        // if more than 10 days - split to chunks
        var _to = to, _from = to;
        do
        {
            _to = _from;
            _from -= tendays;

            // on last iteration, period may be smaller
            if(_from < from) 
            {
                _from = from;
            }

            // and action
            fb_getUpdateData(accountID, pageID, accTok, _from, _to);
        }
        while( (_to - tendays)  > from );

    });//$("#fb_link_page").click(function() END

    $("#fb_connect_link").click(function(){

        $("#facebook_connect").hide();
        $("#facebook_loading").show();

        FB.init({
            appId : fb_app_id,
            status : false,
            cookie : true,
            xfbml : true
        });

        FB.login(function (response) {
            if (response.authResponse) {
                fb_get_accounts(response.authResponse.userID);
            }
        }, { 
            enable_profile_selector:true,
            scope: 'manage_pages,read_insights' 
        });

    });

    $("#tw_connect_link").click(function(){
        window.open("/twitter/connect", "Secure Login", "location=1, status=1, scrollbars=1, width=800, height=455");
    });

});

// lets load the facebook js
(function(d, s, id){
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) {return;}
    js = d.createElement(s); js.id = id;
    js.src = "//connect.facebook.net/en_US/all.js";
    fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));

$(function() {
    $( "#fb_date_from" ).datepicker({
        changeMonth: true,
        onClose: function( selectedDate ) {
            $( "#fb_date_to" ).datepicker( "option", "minDate", selectedDate );
        }
    });
    $( "#fb_date_to" ).datepicker({
        changeMonth: true,
        onClose: function( selectedDate ) {
            $( "#fb_date_from" ).datepicker( "option", "maxDate", selectedDate );
        }
    });
});

// -->
</script>
<?php }} ?>
