<?php /* Smarty version Smarty-3.1.17, created on 2015-01-12 22:30:15
         compiled from "/var/www/application/public/templates/manage_account.tpl" */ ?>
<?php /*%%SmartyHeaderCode:21418333655466de15c4b864-46065824%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'fc39c57078daea60b88862542c9723123b956e49' => 
    array (
      0 => '/var/www/application/public/templates/manage_account.tpl',
      1 => 1421127121,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '21418333655466de15c4b864-46065824',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.17',
  'unifunc' => 'content_5466de165dff58_83138538',
  'variables' => 
  array (
    'fb_app_id' => 0,
    'accountID' => 0,
    'oConnections' => 0,
    'fb_date_from' => 0,
    'fb_date_to' => 0,
    'import_msg' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5466de165dff58_83138538')) {function content_5466de165dff58_83138538($_smarty_tpl) {?><style type="text/css">
.inst
{
  background-color: #D68533;
}
button.inst:hover
{
  background-color: #C1782E;
}
.fileUpload {
  position: relative;
  overflow: hidden;
  margin: 10px;
}
.fileUpload input.upload {
  position: absolute;
  top: 0;
  right: 0;
  margin: 0;
  padding: 0;
  font-size: 20px;
  cursor: pointer;
  opacity: 0;
  filter: alpha(opacity=0);
}
</style>
<link rel="stylesheet" type="text/css" media="all" href="/resources/css/daterangepicker-bs3.css" />
<script type="text/javascript" src="/resources/js/moment.min.js"></script>
<script type="text/javascript" src="/resources/js/daterangepicker.js"></script>
<script type="text/javascript">

$(window).load(function(){
    $('#myModal').modal('show');
    });//$(window).load

/*document.getElementById("twitter_cvs").onChange = function () {
    document.getElementById("uploadFile").value = this.value;
};
*/
$(function () { $('#myModal').on('hide.bs.modal', function () {
    $("#backToaccount").submit();
    })
 });//$(function () { $('#myModal').on



               $(document).ready(function() {

                  var cb = function(start, end, label) {
                    console.log(start.toISOString(), end.toISOString(), label);
                    $('#reportrangePOP span').html(start.format('M/D/YYYY') + ' - ' + end.format('M/D/YYYY'));
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

                  $('#reportrangePOP span').html(moment().subtract(30, 'days').format('M/D/YYYY') + ' - ' + moment().format('M/D/YYYY'));

                  $('#reportrangePOP').daterangepicker(optionSet2, cb);
                  
                  $('#reportrangePOP').on('apply.daterangepicker', function(ev, picker) { 

                    $("#fb_date_fromPOP").val( picker.startDate.format('MM/D/YYYY'));
                    $("#fb_date_toPOP").val( picker.endDate.format('MM/D/YYYY'));                   
                  });
                  
               });



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
    $("#fb_progressbarPOP").css('width', "0%").text('0%');
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
        $("#fb_progressbarPOP").css('width', presentage+'%').text(presentage+'%');

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

            var fb_select = $("#fb_select_pagePOP");
            var fb_external_pageid = $("#fb_external_pageidPOP").text() || false;

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

            $("#facebook_loadingPOP").hide();
            $("#facebook_select_pagePOP").show();

        });

    };

    // IN example: 2014-01-20T06:19:24+0000
    // OUT example: 2014-01-19
    var utc_datetime_to_pst_date = function(uts_datetime){
        var d = new Date(uts_datetime);
        var utc_time = d.getTime()/1000;
        //old code
        //doing calculation with 8 * 60 * 60 this will deduct one day from date
        // IN example: 2014-01-20T06:19:24+0000
        // OUT example: 2014-01-19
       // var pst_time = ( utc_time - ( 8 * 60 * 60 ) );

        //new code
        //if you don't want deduct one day from date
        // IN example: 2014-05-16T07:00:00+0000
        // OUT example: 2014-05-16
        var pst_time = ( utc_time - ( 7 * 60 * 60 ) );

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

    $("#fb_link_pagePOP").click(function(){

        var from = timestamp($("#fb_date_fromPOP").val()+" 00:00:00");
        var to = timestamp($("#fb_date_toPOP").val()+" 23:59:59");
        
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
        
        $("#facebook_select_pagePOP").hide();
        $("#facebook_requestingPOP").show();
        fb_requesting_reset();

        var pageID = $("#fb_select_pagePOP").val();
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
            if(_from < from) _from = from;

            // and action
            fb_getUpdateData(accountID, pageID, accTok, _from, _to);
        }
        while( (_to - tendays)  > from );

    });

  $("#fb_connect_linkPOP").click(function(){

        $("#facebook_connectPOP").hide();
        $("#facebook_loadingPOP").show();

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

    /*function FbConnectLink()
    {
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
    }*/
    /*///////////////
    //twitter start/
    /////////////*/
    $("#tw_connect_link").click(function(){
        window.open("/twitter/connect", "Secure Login", "location=1, status=1, scrollbars=1, width=800, height=455");
    });
    /*///////////////
    //twitter end/
    /////////////*/

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
    $( "#fb_date_fromPOP" ).datepicker({
        changeMonth: true,
        onClose: function( selectedDate ) {
            $( "#fb_date_toPOP" ).datepicker( "option", "minDate", selectedDate );
        }
    });
    $( "#fb_date_toPOP" ).datepicker({
        changeMonth: true,
        onClose: function( selectedDate ) {
            $( "#fb_date_fromPOP" ).datepicker( "option", "maxDate", selectedDate );
        }
    });
});


</script>

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" 
   aria-labelledby="myModalLabel" aria-hidden="true">
   <div class="modal-dialog">
      <div class="modal-content">
         <div class="modal-header">
            <button type="button" class="close" 
               data-dismiss="modal" aria-hidden="true">
                  &times;
            </button>
            <div class="row">
              <div class="col-xs-8"> 
                <h4>
               Manage Social Accounts<br>
              <small>connect your 3rd party social accoount to webanalysis.co</small>
            </h4>
              </div>
              <div class="col-xs-4">
                <a class="btn btn-default" href="/account/pop/<?php echo $_smarty_tpl->tpl_vars['accountID']->value;?>
" id="btnAddCon">+ Add Connection</a>
              </div>
            </div>            
         </div>
         <div class="modal-body">
        <!--model body-->
            <div id="fb-root"></div>
            <form id="getPdfForm" method="post" action="/reports/view/<?php echo $_smarty_tpl->tpl_vars['accountID']->value;?>
">
                <input type="hidden" id="pdf_date_from" name="report_date_from" value="">
                <input type="hidden" id="pdf_date_to" name="report_date_to" value="">
            </form>           
            <!-- facebook -->
            <div class="container">
                <div class="row">
                    <div class="col-md-12 divBG" id="FBbtn">
                        <table width="100%">
                            <tr>
                                <td>
                                    <img src="/resources/img/fb_form.png" style="float:left;">
                                </td>
                                <td width="70%" height="10">
                                    <h4>Facebook</h4>
                                </td>
                                <td height="10">
                                    <input type="checkbox"> Active
                                </td>
                                <td height="10">
                                    <button type="button" class="close">&times;</button>
                                </td>
                            </tr>
                        </table>                 
                        <div id="facebook_connectPOP">
                            <div class="row">
                                <div class="col-md-12" style="">
                                    <button id="fb_connect_linkPOP" class="btn btn-primary" >Import data from Facebook</button>
                                </div>                              
                            </div>
                        </div><!--facebook_connectPOP-->
                        <div id="facebook_select_pagePOP" style="display: none;" class="col-xs-12 form-group row">
                        <?php if ($_smarty_tpl->tpl_vars['oConnections']->value['facebook']->ExternalConnectionID) {?>
                            <div id="fb_external_pageidPOP" style="display: none"><?php echo $_smarty_tpl->tpl_vars['oConnections']->value['facebook']->ExternalConnectionID;?>
</div>
                        <?php }?>
                            <div class="row">
                                <div class="col-xs-12">
                                    <small>Import Historical Data:</small>
                                    <div id="reportrangePOP" style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc">
                                          <i class="glyphicon glyphicon-calendar fa fa-calendar"></i>
                                          <span></span> <b class="caret"></b>
                                    </div>
                                    <input class="form-control" type="hidden" id="fb_date_fromPOP" name="fb_date_fromPOP" value="<?php echo $_smarty_tpl->tpl_vars['fb_date_from']->value;?>
">                 
                                    <input class="form-control" type="hidden" id="fb_date_toPOP" name="fb_date_toPOP" value="<?php echo $_smarty_tpl->tpl_vars['fb_date_to']->value;?>
">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-9">
                                    <small>Select page:</small>
                                    <select class="form-control" id="fb_select_pagePOP"></select>                               
                                </div>                                                    
                                <div class="col-xs-0" style="position:absolute; bottom:0;right:15px">
                                    <button id="fb_link_pagePOP" class="btn btn-primary">Import</button>
                                    <input id="accountID" type="hidden" name="accountID" value="<?php echo $_smarty_tpl->tpl_vars['accountID']->value;?>
">
                                </div>
                            </div>
                        </div><!--facebook_select_pagePOP-->

                        <div id="facebook_loadingPOP" style="display: none">
                            <img src="/resources/img/loading.gif"/>
                        </div>

                        <div id="facebook_requestingPOP" style="display: none">
                            Requesting data from facebook:
                            <div class="progress">
                                <div id="fb_progressbarPOP" class="progress-bar" role="progressbar" style="width: 0%;">
                                </div>
                            </div>
                        </div>

                    </div><!--divBG-->
                </div><!--row-->
            </div><!--container-->
        
            <!-- facebook end -->
            <br>
            <!-- twitter -->
            <div class="container">
                <div class="row">
                    <div class="col-md-12 divBG" id="Tweetbtn">
                         <table width="100%">
                            <tr>
                                <td>
                                    <img src="/resources/img/tw_form.png" style="float:left;">
                                </td>
                                <td width="70%" height="10">
                                    <h4>Twitter</h4>
                                </td>
                                <td height="10">
                                    <input type="checkbox"> Active
                                </td>
                                <td height="10">
                                    <button type="button" class="close">&times;</button>
                                </td>
                            </tr>
                        </table>
                        <div id="twitter_connect">
                            <?php if ($_smarty_tpl->tpl_vars['oConnections']->value['twitter']->ExternalConnectionID) {?>
                                
                                <div class="col-md-12" style="">
                                    <div>
                                        <small>Import historical data (excel or json file)</small>
                                    </div>
                                    <?php if ($_smarty_tpl->tpl_vars['import_msg']->value) {?>
                                        <div style="color:red">
                                            <strong><?php echo $_smarty_tpl->tpl_vars['import_msg']->value;?>
</strong>
                                        </div>
                                    <?php }?>
                                    <form class="form-inline" role="form" method="post" action="/account/connections/<?php echo $_smarty_tpl->tpl_vars['accountID']->value;?>
" enctype="multipart/form-data">
                                        <select class="form-control" style="width:80%">
                                          <option>
                                            <?php echo $_smarty_tpl->tpl_vars['oConnections']->value['twitter']->Name;?>

                                          </option>
                                        </select>
                                                        
                                        <input id="uploadFile" placeholder="Choose File" disabled="disabled" style="height: 30px;"/>
                                        <div class="form-group fileUpload" style="top:-5px;">
                                            <span class="btn btn-primary">Brows</span>
                                            <input type="file" name="twitter_cvs" class="upload" id="twitter_cvs"/>
                                        </div>
                                        <input type="hidden" name="action" value="twitter_cvs"/>
                                        <input type="submit" value="Upload" class="btn btn-primary" onclick='$("#tw_loading").show();$(this).hide();' style=""/>
                                        
                                        <img style="display: none" id="tw_loading" src="/resources/img/loading.gif"/>
                                    </form>
                                </div><!--colmd-12-->                        
                            <?php } else { ?>
                                <button id="tw_connect_link" class="btn btn-primary">Import historical data</button>
                            <?php }?>
                            </div><!--twitter_connect-->
                    </div> <!--col-md-->                      
                </div><!--row-->
            </div> <!-- Container-->           
            <!--twitter end-->
            <br>
            <div class="container">
              <div class="row" style="">
                <div class="col-md-12 divBG" id="Pinbtn">
                  <br>
                  <div class="row">
                    <div id="btndivpi" class="col-xs-10">
                      <button id="pi_connect_Add" class="btn btn-danger btn-block">Connect To Pinterest</button>
                    </div>
                    <div id="btnTogpi" class="col-xs-2">
                      <button type="button" id="togpi" onclick="togDiv('pi')" class="btn btn-link">Hide</button>
                    </div> 
                  </div>
                  <br>
                </div>
              </div>
            </div>
            <!--Pinterest end-->
            <br>
            <div class="container">
              <div class="row" style="">
                <div class="col-md-12 divBG" id="Instbtn">
                  <br>
                  <div class="row">
                    <div id="btndivin" class="col-xs-10">
                      <button id="in_connect_Add" class="btn btn-block inst" ><font color="white">Connect To Instagram</font></button>
                    </div>
                    <div id="btnTogin" class="col-xs-2">
                      <button type="button" id="togin" onclick="togDiv('in')" class="btn btn-link">Hide</button>
                    </div> 
                  </div>
                  <br>
                </div>
              </div>
            </div>
            <!--Instagram end-->
            <br>
            <!--show dashbord-->
                <button type="button" style="margin-right: 17px" class="btn btn-info pull-right" id="btnbackToDeshbord1" onClick="$('#backToDeshbord').submit();">Finish And View Reports
                </button>
            <!--show dashbord end-->
         </div>
         <br><br>
         
      </div><!-- /.modal-content -->
</div><!-- /.modal -->
<form id="backToDeshbord" method="post" action="/dashboard/view/<?php echo $_smarty_tpl->tpl_vars['accountID']->value;?>
">    
</form>
<form id="backToaccount" method="post" action="/account/connections/<?php echo $_smarty_tpl->tpl_vars['accountID']->value;?>
">    
</form>
<?php }} ?>
