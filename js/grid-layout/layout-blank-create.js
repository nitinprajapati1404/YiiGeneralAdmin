
var drag = 1;
$(document).ready(function() {
    $('#button-share-modal').trigger('click');
    $(this).find('.addbtn').css('display', 'none');
    if (isPreview == '1') {
        previewPage();
    }
    $(document).ajaxStart(function() {
        $('#preloader').show();
      })
      .ajaxStop(function() {
        $('#preloader').hide();
      });
    $('#preloader').hide();
    ddlReassign();

});
$('body').delegate('.ddlRights', 'change', function() {
    var rights = $(this).val();
    $(this).parent().attr("rights", rights.join(','));
//    var temp = $(this);
//    temp.find('option').removeAttr('selected');
//    $.each(rights, function(i, x) {
//        temp.find('option[value="' + x + '"]').attr("selected", true);
//    });
});
$('#commentPopup').validationEngine();
function previewPage() {
    $('.drag,.remove').remove();
}

function applyRights() {
    $('.maincontainer').find('.column').each(function() {
        var currentRights = $(this).attr("rights");
        rights = [];
        rights = currentRights.split(',');
        console.log(rights);
        if ($.inArray('1', rights) === -1) {
            $(this).sortable('disable');
            $(this).css('background', '#f4f4f4');
        } else {
            $(this).css('background', '#fff');
        }
    });

}

function ddlReassign() {
    $('.maincontainer').find('.column').each(function() {
        var currentRights = $(this).attr("rights");
        rights = [];
        rights = currentRights.split(',');
        var temp = $(this);
//        temp.find('.ddlRights option').removeAttr('selected');
//        temp.find('.ddlRights option').css("background", "");
//        temp.find('.ddlRights option').css("color", "");

        $.each(rights, function(i, x) {
            temp.find('.ddlRights option[value="' + x + '"]').attr("selected", true);
//            temp.find('.ddlRights option[value="' + x + '"]').css("background", "#3399ff");
//            temp.find('.ddlRights option[value="' + x + '"]').css("color", "#ffffff");
        });
        console.log('changes');
    });
}

function logout() {
    window.location.href = siteurl + "site/logout";
}
function saveBlankTemplete() {
    var ajaxdata = {};
    $('#download-layout-blank-structure').html($('.demo').html());
    $('#download-layout-blank-structure').find('.remove,.drag,.ddlRights').remove();
    ajaxdata['templete'] = templateid;
    ajaxdata['layoutEdit'] = $('.demo').html();
    ajaxdata['layout'] = $('#download-layout-blank-structure').html();

    $.ajax({
        type: "POST",
        url: siteurl + "webBlankTemplateAjax/saveBlankLayout",
        data: ajaxdata,
        dataType: "json",
        async: false,
        success: function(data) {
            console.log(data);
            if (data.status == '1') {
                myAlert(data.message, 'success');
            } else {
                myAlert(data.message, 'error');
            }
        }
    });
}
function saveLayout() {
//    console.log("saveLayout");
//    var ajaxdata = {};
//    $('#download-layout-blank-structure>.container-fluid').html($('.demo').html());
//    $('#download-layout-blank-structure>.container-fluid').find('.remove,.drag,.ddlRights').remove();
//    ajaxdata['templete'] = templateid;
//    ajaxdata['layoutEdit'] = $('.demo').html();
//    ajaxdata['layout'] = $('#download-layout-blank-structure>.container-fluid').html();
//
//    $.ajax({
//        type: "POST",
//        url: siteurl + "webBlankTemplateAjax/saveBlankLayout",
//        data: ajaxdata,
//        success: function(data) {
//            console.log(data)
//        }
//    });
}

function downloadLayout() {
    console.log("publish");
    var ajaxdata = {};
    $('#download-layout-blank-structure').html($('.demo').html());
    $('#download-layout-blank-structure').find('.remove,.drag,.ddlRights').remove();
    ajaxdata['templete'] = templateid;
    ajaxdata['layoutEdit'] = $('.demo').html();
    ajaxdata['layout'] = $('#download-layout-blank-structure').html();

    $.ajax({
        type: "POST",
        url: siteurl + "webBlankTemplateAjax/publishBlankLayout",
        data: ajaxdata,
        dataType: "json",
        success: function(data) {
//            console.log(data);
            if (data.status == '1') {
                myAlert(data.message, 'success');
            } else {
                myAlert(data.message, 'error');
            }
//            alert(data.message);
        }
    });

}

function submitTemplete() {
    saveBlankTemplete();
    var ajaxdata = {};
    ajaxdata['templete'] = templateid;
    $.ajax({
        type: "POST",
        url: siteurl + "webBlankTemplateAjax/submitStructure",
        data: ajaxdata,
        dataType: "json",
        async: false,
        success: function(res) {
            if (res.status == '1') {
                myAlert(res.message, 'success');
            } else {
                myAlert(res.message, 'error');
            }
        }
    });
}


function disApprove() {
    if (confirm("Do you really want to disapprove it.")) {
        var ajaxdata = {};
        ajaxdata['templeteid'] = templateid;
        $.ajax({
            url: siteurl + "webBlankTemplateAjax/disApproveStructure",
            data: ajaxdata,
            type: 'POST',
            dataType: "json",
            success: function(res) {

                if (res.status == '1') {
                    myAlert(res.message, 'success');
                } else {
                    myAlert(res.message, 'error');
                }

            }
        });
    }

}

function downloadHtmlLayout() {
    console.log("downloadHtmlLayout");
//                $.ajax({
//                    type: "POST",
//                    url: "/build_v3/downloadLayout",
//                    data: {'layout-v3': $('#download-layout').html()},
//                    success: function(data) {
//                        window.location.href = '/build_v3/downloadHtml';
//                    }
//                });
}
/**
 * Manage Sequence for newely added grid
 * @param {type} e : object of dragged element
 * 
 */
function manageSequence(e)
{
    drag++;
    $('#estRows').find('div.custcls').attr('sequence', drag + '_seq');
}
function undoLayout() {
    console.log("undoLayout");
//                $.ajax({
//                    type: "POST",
//                    url: "/build_v3/getPreviousLayout",
//                    data: {},
//                    success: function(data) {
//                        undoOperation(data);
//                    }
//                });
}

function redoLayout() {
    console.log("redoLayout");
//
//                $.ajax({
//                    type: "POST",
//                    url: "/build_v3/getPreviousLayout",
//                    data: {},
//                    success: function(data) {
//                        redoOperation(data);
//                    }
//                });
}


function updateGrid() {
    var ajaxdata = {};
    ajaxdata['templeteid'] = templateid;
    ajaxdata['contentboxHidden'] = $("#contentboxHidden").val();
    ajaxdata['taggedUserHidden'] = $("#taggedUserHidden").val();
    $.ajax({
        url: siteurl + "webBlankTemplateAjax/disApproveStructure",
        data: ajaxdata,
        type: 'POST',
        dataType: "json",
        success: function(res) {

            if (res.status == '1') {
                myAlert(res.message, 'success');
                $("#contentbox").html('');
                $("#contentboxHidden").val('');
                $('#disapproveForm').modal('hide');
            } else {
                myAlert(res.message, 'error');
            }

        }
    });
}