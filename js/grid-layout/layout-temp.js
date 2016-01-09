
var drag = 1;
$(document).ready(function() {
    $('#button-share-modal').trigger('click');
});
$('body').delegate('.ddlRights', 'change', function() {
    var rights = $(this).val();
    $(this).parent().attr("rights", rights.join(','));
});
function applyRights() {
    $('.maincontainer').find('.column').each(function(e) {
        currentRights = $(this).attr("rights");
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

function saveLayout() {
    console.log("saveLayout");
    var ajaxdata = {};
//    ajaxdata['templete'] = templateid;
//    ajaxdata['layout'] = $('.demo').remove('.ddlRights,.remove,.drag').html();
//    ajaxdata['layoutEdit'] = $('.demo').html();
//    $.ajax({
//        type: "POST",
//        url: siteurl + "webBlankTemplateAjax/saveBlankLayout",
//        data: ajaxdata,
//        success: function(data) {
//
//        }
//    });
}

function downloadLayout() {
    console.log("downloadLayout");
//                $.ajax({
//                    type: "POST",
//                    url: "/build_v3/downloadLayout",
//                    data: {'layout-v3': $('#download-layout').html()},
//                    success: function(data) {
//                        window.location.href = '/build_v3/download';
//                    }
//                });
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