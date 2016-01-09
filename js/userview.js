$(document).ready(function(e){
    $('#viewuserTab li a:first').trigger('click');
    $('#viewuserTab li a[divid="profile"]').click(function(e){
        $('#viewHead').html('User Info');
    });
    $('#viewuserTab li a[divid="assignmall"]').click(function(e){
        //console.log(2);
        $('#viewHead').html('Assigned Mall');
       // if(typeof(datajson['assignmalloutlet']) != 'undefined' && datajson['assignmalloutlet']==0)
        {
        //console.log($(this).attr('divid'));
        var divid = $(this).attr('divid');
        var url=siteurl+"mallMaster/GetMall" ;
        //var url=siteurl+"OutletTypeMaster/getmalloutlet" ;
        var data = {};
        data['admin_id']=userinfo.admin_id;
        data['group_id']=userinfo.group_id;
        $.ajax({
                url: url,
                data : data,
                type : 'post',
                success : function(e){
                   // alert(e);
                    e  = $.trim(e);
                    //if(sessionTimeOut(e))
                    {
                        $('#'+divid).html(e);
                        datajson['assignmalloutlet']=1;
                    }
                }
           });
       }
    });
    
    $('#viewuserTab li a[divid="assignoutlet"]').click(function(e){
        $('#viewHead').html('Assigned Outlet');
       var divid = $(this).attr('divid');
        var url=siteurl+"outletMaster/GetOutlet" ;
        //var url=siteurl+"OutletTypeMaster/getmalloutlet" ;
        var data = {};
        data['admin_id']=userinfo.admin_id;
        data['group_id']=userinfo.group_id;
        $.ajax({
                url: url,
                data : data,
                type : 'post',
                success : function(e){
                   // alert(e);
                    e  = $.trim(e); 
                   $('#'+divid).html(e);
                   datajson['assignmalloutlet']=1;
                }
           });
    });
    $('#viewuserTab li a[divid="events"]').click(function(e){
        $('#viewHead').html('Assigned Events');
        var divid = $(this).attr('divid');
        var url=siteurl+"event/GetAssignEvents" ;
        var data = {};
        data['admin_id']=userinfo.admin_id;
        data['group_id']=userinfo.group_id;
        $.ajax({
                url: url,
                data : data,
                type : 'post',
                success : function(e){
                   // alert(e);
                    e  = $.trim(e); 
                   $('#'+divid).html(e);
                }
           });
    });
    $('#divContentPanel').delegate('#drpMallList','change',function(e){
        var divid = 'divOutletList';
        
        var url=siteurl+"outletMaster/AssignOutlet" ;
        var data = {};
        data['admin_id']=userinfo.admin_id;
        data['group_id']=userinfo.group_id;
        data['mall_id'] = $('#drpMallList').val();
        data['outlet_ids'] = $('#hdnAssignedOutletIds').val();
        console.log(data);
        $.ajax({
                url: url,
                data : data,
                type : 'post',
                success : function(e){
                    //alert(e);
                    e  = $.trim(e); 
                   $('#divOutletList').html(e);
                   datajson['assignmalloutlet']=1;
                }
           });
    });    
    
    
    
    $('#divContentPanel').delegate('#btnMallOutletSubmit','click',function(e){
        e.preventDefault();
         var url=siteurl+"adminOutletMapping/updateOutletMappingMall" ;
         $('#btnMallOutletSubmit').hide();
         $('#spnLoadingImg').show();
        var data = {};
        data['admin_id']=userinfo.admin_id;
        data['group_id']=userinfo.group_id;
        var checkedboxes='';
        checkedboxes = $('input[name="chkmall[]"]:checked').map(function () {
            return this.value;
        }).get();
        data['mall_id'] = checkedboxes;
        /*var mallid ='';
        if(typeof($('#drpMallList').val()) != 'undefined')
            mallid = $('#drpMallList').val();
        data['mall_id']=mallid;*/
        $.ajax({
                url: url,
                data : data,
                type : 'post',
                success : function(e){
                    //alert(e);
                    e  = $.trim(e); 
                    if(e==1)
                    {
                        myAlert('Records Updated Successfully','success');
                        $('#btnMallOutletSubmit').show();
                        $('#spnLoadingImg').hide();
                        /*$.gritter.add({
                                title: 'This is a regular notice!',
                                text: 'This will fade out after a certain amount of time.',
                                class_name: 'growl-success',
                                image: 'images/screen.png',
                                sticky: false,
                                time: ''
                         });
                     return false;*/
                     
                     
                   //$('#divOutletList').html(e);
                    datajson['assignmalloutlet']=1;
                    $('a[divid="assignmall"]').trigger('click');
                }
                else
                {
                    myAlert("Error occured during processing");
                }
                }
           });
    });
    
    
    $('#divContentPanel').delegate('#btnOutletSubmit','click',function(e){
        e.preventDefault();
         var url=siteurl+"adminOutletMapping/updateOutletMappingOutlet" ;
         $('#btnOutletSubmit').hide();
         $('#spnLoadingImg').show();
        var data = {};
        data['admin_id']=userinfo.admin_id;
        data['group_id']=userinfo.group_id;
        var checkedboxes='';
        checkedboxes = $('input[name="chkoutlet[]"]:checked').map(function () {
            return this.value;
        }).get();
        data['outlet_id'] = checkedboxes;
        data['mall_id'] = $('#hdnMallId').val();
        /*var mallid ='';
        if(typeof($('#drpMallList').val()) != 'undefined')
            mallid = $('#drpMallList').val();
        data['mall_id']=mallid;*/
        $.ajax({
                url: url,
                data : data,
                type : 'post',
                success : function(e){
                    //alert(e);
                    e  = $.trim(e); 
                    if(e==1)
                    {
                        myAlert('Records Updated Successfully','success');
                        
                        $('#btnMallOutletSubmit').show();
                        $('#spnLoadingImg').hide();
                        datajson['assignmalloutlet']=1;
                    $('a[divid="assignoutlet"]').trigger('click');
                }
                else
                {
                    myAlert('Error occured during processing');
                }
                }
           });
    });
    
    
    $('#viewuserTab li a[divid="rights"]').click(function(e){
        //console.log(2);
        
        $('#viewHead').html('Assigned Rights');
        
       // if(typeof(datajson['assignmalloutlet']) != 'undefined' && datajson['assignmalloutlet']==0)
        //{
        //console.log($(this).attr('divid'));
        var divid = $(this).attr('divid');
        var url=siteurl+"userRightsMapping/getRights" ;
        //var url=siteurl+"OutletTypeMaster/getmalloutlet" ;
        var data = {};
        data['admin_id']=userinfo.admin_id;
        data['group_id']=userinfo.group_id;
        $.ajax({
                url: url,
                data : data,
                type : 'post',
                success : function(e){
                   // alert(e);
                    e  = $.trim(e); 
                   $('#'+divid).html(e);
                   
                   $('#divRightList input[type=checkbox]').attr('disabled','true');
                   datajson['assignmalloutlet']=1;
                   adjustmainpanelheight();
                }
           });
      // }
    });
    
    
    
    $('#divContentPanel').delegate('#btnUpdateRights','click',function(e){
        e.preventDefault();
         var url=siteurl+"userRightsMapping/updateRights" ;
        // $('#btnUpdateRights').hide();
         //$('#spnLoadingImg').show();
        var data = {};
        data['admin_id']=userinfo.admin_id;
        data['group_id']=userinfo.group_id;
        var checkedboxes='';
        checkedboxes = $('input[name="chkrights[]"]:checked').map(function () {
            return this.value;
        }).get();
        data['right_id'] = checkedboxes;
        $.ajax({
                url: url,
                data : data,
                type : 'post',
                success : function(e){
                    //alert(e);
                    e  = $.trim(e); 
                    if(e==1)
                    {
                        myAlert('Rights Updated Successfully','success');
                    }else
                        myAlert('Error Occured during Processing','error');
                        
                   $('#viewuserTab li a[divid="rights"]').trigger('click');
                   datajson['assignmalloutlet']=1;
                }
           });
    });
     
 });
/* get all user activity - Hetal Patel*/
$('#viewuserTab li a[divid="useractivity"]').click(function(e){
   //$("#useractivity").show();
});

/** get assigned channels**/
$('#viewuserTab li a[divid="campaign"]').click(function(e){
        var divid = $(this).attr('divid');
        var url=siteurl+"channelMaster/GetUsersChannels" ;
        var data = {};
        data['admin_id']=userinfo.admin_id;
        data['group_id']=userinfo.group_id;
        $.ajax({
                url: url,
                data : data,
                type : 'post',
                success : function(e){
                   e  = $.trim(e); 
                   $('#'+divid).html(e);
                }
           });
   
    });
    
    $('#divContentPanel').delegate('#btnUpdateChannel','click',function(e){
        e.preventDefault();
        var uid = $(this).attr('admin_id');
        var url=siteurl+"channelMaster/UpdateChannelToUser" ;
        var data = {};
        data['admin_id']=userinfo.admin_id;
        data['group_id']=userinfo.group_id;
        var checkedboxes='';
        checkedboxes = $('input[name="chkchannel_'+uid+'[]"]:checked').map(function () {
            return this.value;
        }).get();
        if(checkedboxes.length == 0)
            checkedboxes='';
        data['channel_id'] = checkedboxes;
        $.ajax({
                url: url,
                data : data,
                type : 'post',
                success : function(e){
                    e  = $.trim(e); 
                    if(e==1)
                    {
                        myAlert('Record Updated Successfully','success');
                    }else if(e=='-1')
                    {
                        myAlert('Records can not be updated.Please try later');
                    }else
                        myAlert('Error Occured during Processing','error');
                    $('#viewuserTab li a[divid="campaign"]').trigger('click');
                }
        });

    });
    
    $('#divContentPanel').delegate('#btnUpdateRule','click',function(e){
        e.preventDefault();
        var uid = $(this).attr('admin_id');
        var url=siteurl+"ruleMaster/UpdateRuleToGroup" ;
        var data = {};
        data['admin_id']=userinfo.admin_id;
        data['group_id']=userinfo.group_id;
        var checkedboxes='';
        checkedboxes = $('input[name="chkrule_'+uid+'[]"]:checked').map(function () {
            return this.value;
        }).get();
        if(checkedboxes.length == 0)
            checkedboxes='';
        data['rule_id'] = checkedboxes;
        $.ajax({
                url: url,
                data : data,
                type : 'post',
                success : function(e){
                    e  = $.trim(e); 
                    if(e==1)
                    {
                        myAlert('Record Updated Successfully','success');
                    }else if(e=='-1')
                    {
                        myAlert('Records can not be updated.Please try later');
                    }else
                        myAlert('Error Occured during Processing','error');
                    $('#viewuserTab li a[divid="campaign"]').trigger('click');
                }
        });

    });

function loadMessage()
{
    var url=siteurl+"userActivity/AllLogs";
    $.ajax({
        url: url,
        type: 'POST',
        data: 'test',
        success: function(data) 
        {
            //alert(data);
            $('#useractivity').html('');
            $('#useractivity').html(data);
            $("#userAct-grid_c0").hide();
            $(".summary").css("width","35%");
        },
    });
}