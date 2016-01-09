$(document).ready(function(){
	 $('.sticky-leftpanel').mCustomScrollbar();
    window.setTimeout(function() {
        //$('.select2-results').mCustomScrollbar();
        $(".alert").fadeTo(100, 0).slideUp(500, function() {
            $(this).remove();
        });
    }, 4000);
    
    $(document).ajaxStart(function() {
        $('#preloader').show();
      })
      .ajaxStop(function() {
        $('#preloader').hide();
		$('table.table  tr td input').attr('placeholder','Search here...');
                $('table.table select').select2({placeholder:"All"});
      });
	  $('ul.children>li[class="active"]').parent().parent().addClass('active');
	  $('ul.children>li[class="active"]').parent().toggle();
});
function myAlert(msg,type)
{
	type = typeof(type) != "undefined"?type:"error";
	new PNotify({
		title: 'Alert'+": "+type,
		text: msg,
		type:type,
		//remove: true,
		delay: 2000,
		styling: 'bootstrap3'
	});
}

// Check session expired
function sessionTimeOut(data)
{
	var data = $.trim(data);
	if(data == 'timeout')
	{
		alert('Session Expired');
		location.href = '/';
		return false;
	}
	else
		return true;
}
 function adjustmainpanelheight() {
      // Adjust mainpanel height
      var docHeight = jQuery(document).height();
      if(docHeight > jQuery('.mainpanel').height())
         jQuery('.mainpanel').height('auto');
   }
   
/*** use this func. when one switch on one page**/
function loadSwitch()
 {
     //Switch
    //$('[data-toggle=switch]').wrap('<div class=switch />').parent().bootstrapSwitch();
   setTimeout(function(){
    $('.switch')['bootstrapSwitch']();
   },500);
}
/** use this func. when more than one switch exist on one page**/
function loadCustSwitch(id)
 { 
     //Switch
    //$('[data-toggle=switch]').wrap('<div class=switch />').parent().bootstrapSwitch();
   setTimeout(function(){
    $('#'+id+' .switch')['bootstrapSwitch']();
   },500);
}
function money2num(strMoney)
{
if(strMoney!=''&&typeof(strMoney)!='undefined'){var number=Number(strMoney.replace(/[^0-9\.]+/g,""));return number;}
}