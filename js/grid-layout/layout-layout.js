var drag = 1, saveTempleteData;
$(document).ready(function() {

    if (isPreview == '1') {
        previewPage();
    }


    $('.preloader').hide();
    applyRights();
    $('#button-share-modal').trigger('click');
});
$(document).ajaxStart(function() {

    //console.log($('.preloader'));
    //$('.preloader').show();
    $('.preloader').css({'display': 'block', 'visibility': 'visible'});
})
        .ajaxStop(function() {
//                $('.preloader').hide();
            $('.preloader').hide();
        });
$('body').delegate('.ddlRights', 'change', function() {
    var rights = $(this).val();
    $(this).parent().attr("rights", rights.join(','));
});
$(window).load(function() {
    if (isPreview == '1') {
        previewPage();
    }
    applyRights(), manageOwlCarousel();
});
function applyRights() {
    $('.maincontainer').find('.column').each(function(e) {
        currentRights = $(this).attr("rights");
        rights = [];
        if (typeof (currentRights) != 'undefined')
            rights = currentRights.split(',');
        if (isSuperAdmin) {
            $(this).find('.addbtn').show();
            $(this).css('background', '#fff');
        } else {
            if ($.inArray(userRight, rights) === -1) {
                $(this).sortable('disable');
                $(this).find('.addbtn').remove();
                $(this).css('background', '#f4f4f4');
            } else {
                $(this).find('.addbtn').show();
                $(this).css('background', '#fff');
            }
        }

    });

}

//preview page
function previewPage() {
    $('#sourcepreview').trigger('click');
    $('#edit,.addbtn,.navbar,.needToremove').remove();
//    $('#edit').remove();
}


function submitTemplete() {
    saveTemplete();
    //templateid
    var ajaxdata = {};
    ajaxdata['templete'] = templateid;
    saveTempleteData.success(function() {
        $.ajax({
            type: "POST",
            url: siteurl + "webBlankTemplateAjax/submitDataTemplete",
            data: ajaxdata,
            dataType: "json",
//            async: false,
            success: function(res) {
                if (res.status == '1') {
                    myAlert(res.message, 'success');
                } else {
                    myAlert(res.message, 'error');
                }

//                        window.location.href = '/build_v3/download';
            }
        });
    });

}

function saveLayout() {
//    console.log("saveLayout");

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
    saveTemplete();
    var ajaxdata = {};
    $('#download-layout').find('.needToremove').remove();
    $('#download-layout .owl-carousel').each(function() {
        var hmtl = '';
        var temp = this;
        $(temp).find('.owl-item').each(function() {
            hmtl += $(this).html();
        });
        $(temp).html(hmtl);

    });
    ajaxdata['templete'] = templateid;
    ajaxdata['layout'] = $('#download-layout').html();
    ajaxdata['layoutEdit'] = $('#download-layout-data').html();
    saveTempleteData.success(function() {
        $.ajax({
            type: "POST",
            url: siteurl + "webBlankTemplateAjax/PublishDataTemplete",
            data: ajaxdata,
            dataType: "json",
//        async: false,
            success: function(res) {
                myAlert(res.message, 'success');
//                        window.location.href = '/build_v3/download';
            }
        });
    });

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
function removeCard(card) {
    var ajaxdata = {};
    ajaxdata['card'] = card;
    if (confirm("Do you really want to remove this card?")) {
        $('body').find('#card_' + card).remove();
        /* $.ajax({
         type: "POST",
         url: siteurl + "webBlankTemplateAjax/removeCard",
         data: ajaxdata,
         dataType: "json",
         //            async: false,
         success: function(res) {
         if (res.status == 1) {
         $('body').find('#card_' + card).remove();
         }
         }
         });*/
    }

}


$('#selectCard').on('click', function() {
    var selectedCard = $(".cards input[name='radioCard']:checked");
    var ajaxdata = {};
    ajaxdata['card'] = selectedCard.val();
    ajaxdata['template'] = templateid;
    $.ajax({
        type: "POST",
        url: siteurl + "webBlankTemplateAjax/addCard",
        data: ajaxdata,
        dataType: "json",
//        async: false,
        success: function(res) {
            if (res.status == 1) {
                $('.zzzz').append(res.data), closeEditDialog(), manageOwlCarousel(), myAlert(res.message, 'success');
            }
        }
    });
});
$('.addbtn').on('click', function() {
    $('body').find('.zzzz').removeClass('zzzz');
    $(this).parent().removeClass('zzzz').addClass('zzzz');
});

function editCard(card, fields) {
    var ajaxdata = {};
    ajaxdata['card'] = card;
    ajaxdata['fields'] = fields;
    $.ajax({
        type: "POST",
        url: siteurl + "webBlankTemplateAjax/getEditForm",
        data: ajaxdata,
        dataType: "json",
        success: function(res) {
            if (res.status == 1) {
                $('#ajaxformdata').html(res.data), $('#editFormPopup').modal('show');
            }
        }
    });
}
$('#crform').on('submit', function(e) {
    e.preventDefault();
    $('.preloader').show();
    $.ajax({
        url: siteurl + "webBlankTemplateAjax/saveEditForm",
        type: "POST",
        data: new FormData(this),
        contentType: false,
        cache: false,
        processData: false,
        dataType: "json",
//        async: false,
        success: function(res) {
            if (res.status == '1') {
                $('#card_' + res.card).replaceWith(res.data), $('#editFormPopup').modal('hide'), manageOwlCarousel();
                myAlert(res.message, 'success');
                $('.preloader').hide();
            } else {
                $('.preloader').hide();
//                    myAlert(res.message, 'error');
            }

        }
    });

});

function saveTemplete() {
    var ajaxdata = {};
//    $('#download-layout-blank-structure>.container-fluid').html($('.demo').html());
//    $('#download-layout-blank-structure>.container-fluid').find('.remove,.drag,.ddlRights').remove();
    $('#download-layout-data').html($('.maincontainer').html());
    $('#download-layout-data .owl-carousel').each(function() {
        var hmtl = '';
        var temp = this;
        $(temp).find('.owl-item').each(function() {
            hmtl += $(this).html();
        });
        $(temp).html(hmtl);

    });
    ajaxdata['templete'] = templateid;
    ajaxdata['layoutEdit'] = $('#download-layout-data').html();
    ajaxdata['layout'] = '';
//    ajaxdata['layout'] = $('#download-layout-blank-structure>.container-fluid').html();

    saveTempleteData = $.ajax({
        type: "POST",
        url: siteurl + "webBlankTemplateAjax/saveLayoutAsDraft",
        data: ajaxdata,
        dataType: "json",
//        async: false,
        success: function(res) {
            myAlert(res.message, 'success');
        }
    });
}
function addSlide(card, fields) {
    var ajaxdata = {};
    ajaxdata['card'] = card;
    ajaxdata['fields'] = fields;
    $.ajax({
        type: "POST",
        url: siteurl + "webBlankTemplateAjax/addSlide",
        data: ajaxdata,
        dataType: "json",
//        async: false,
        success: function(res) {
            if (res.status == '1') {
                $('#card_' + card).replaceWith(res.data), manageOwlCarousel();
            } else {
//                    myAlert(res.message, 'error');
            }

        }
    });
}
function removeSlide(card, fields) {
    var ajaxdata = {};
    ajaxdata['card'] = card;
    ajaxdata['fields'] = fields;
    $.ajax({
        type: "POST",
        url: siteurl + "webBlankTemplateAjax/removeSlide",
        data: ajaxdata,
        dataType: "json",
        async: false,
        success: function(res) {
            if (res.status == '1') {
                $('#card_' + card).replaceWith(res.data), manageOwlCarousel(), myAlert(res.message, 'success');
            } else {
//                    myAlert(res.message, 'error');
            }

        }
    });
}
function closeEditDialog() {
    $('.close').trigger("click");
}
function getCards(grid) {
    var ajaxdata = {};
    ajaxdata['grid'] = grid;
    ajaxdata['pageType'] = pageType;
    $.ajax({
        type: "POST",
        url: siteurl + "webBlankTemplateAjax/getCardList",
        data: ajaxdata,
        dataType: "json",
//        async: false,
        success: function(res) {
            if (res.status == '1') {
                $('#cardPopupData').html(res.data);
            } else {
//                    myAlert(res.message, 'error');
            }

        }
    });
}
/**
 * Manage Offering Type
 */
$('body').delegate('#offering-type', 'change', function() {
    var offeringType = $(this).val();
    if (offeringType != '') {
        var ajaxdata = {};
        ajaxdata['type'] = offeringType;
        ajaxdata['templeteFor'] = 'mall';//static data for mall will change later
        ajaxdata['contentid'] = '1';//static data for mall will change later
        $.ajax({
            url: siteurl + "webActionFilter/GetDependentDropdown",
            data: ajaxdata,
            type: 'POST',
            success: function(data) {
                var res = $.parseJSON(data);
                if (res.status == '1') {
                    $('#dependent-ddl').html(res.data);
                    $('.existing-images').html('');
                    if (offeringType == 'tag') {
                        $('#hid_card_action').val(offeringType + ":");
                    } else {
                        $('#hid_card_action').val(offeringType + ":all");
                    }

                } else {
                }

            }
        });
    } else {
        $('#hid_card_action').val('');
    }
});

$('body').delegate('.ddlQueue', 'change', function() {
    var id = $(this).val();
    var type = $(this).attr('type');
    var next = $(this).attr('next');
    var val = $(this).find(":selected").text();
    var tempThis = $(this);
    if (id != '') {
        $('#hid_card_action').val(type + ":" + id + ":" + val);

//            console.log($('.ddlQueue').length);
        var notNoneOffering = [
//            'outlet-offer',
//                'event-eventOffer',
            'product-category',
            'store',
            'dine',
            'service',
            'entertain',
            'pvr',
            'event'
        ];
        if (next != 'none') {
            var ajaxdata = {};
            ajaxdata['type'] = next;
            if (next == 'selectstoreoptions') {
                ajaxdata['type'] = id;
                type = id;
                id = $(this).attr('parent_id');
                ajaxdata['id'] = $(this).attr('parent_id');
            }
            else {
                ajaxdata['id'] = id;
            }


            ajaxdata['templeteFor'] = 'mall';
            ajaxdata['contentid'] = '1';
            $.ajax({
                url: siteurl + "webActionFilter/GetDependentDropdown",
                data: ajaxdata,
                type: 'POST',
                async: false,
                success: function(data) {
                    var res = $.parseJSON(data);
                    if (res.status == '1') {
                        tempThis.parent().parent().parent().nextAll('.dropdown-cnt').remove();

                        $('.existing-images').html('');
//                        actionData[$('.ddlQueue').length] = id;
//                        for (i = $('.ddlQueue').length + 1; i < actionData.length; i++) {
//                            actionData.pop(i);
//                        }
//                        $('#hid_card_action_full').val(actionData.join(':'));
                        $('#dependent-ddl').append(res.data);
//                            console.log(id);
                        if ($.inArray(type, notNoneOffering) == -1) {
                            if (type == 'outletOffer') {
                                $('#hid_card_action').val(type + ":" + id + ":all");
                            } else {
                                $('#hid_card_action').val(type + ":all");
                            }
                        }
                        if (id == 'outlet-type-offer' || id == 'event-offer') {
                            $('#hid_card_action').val(id + ":all");
                        }
                        $(this).parent().parent().after('div').remove();
                    } else {
                    }

                }
            });
        } else {
            var ajaxdata = {};
            ajaxdata['type'] = type;
            ajaxdata['id'] = id;
            ajaxdata['templeteFor'] = 'mall';
            ajaxdata['contentid'] = '1';
            $.ajax({
                url: siteurl + "webActionFilter/GetImages",
                data: ajaxdata,
                type: 'POST',
                async: false,
                success: function(data) {
                    var res = $.parseJSON(data);
                    if (res.status == '1') {

//                        actionData[$('.ddlQueue').length] = id;
//                        for (i = $('.ddlQueue').length + 1; i <= actionData.length; i++) {
//                            actionData.pop(i);
//                        }
//                        $('#hid_card_action_full').val(actionData.join(':'));
                        $('.existing-images').html(res.data);
                    }
                }
            });
            $('#crform input[type="text"]').each(function() {
                if ($(this).val() == '') {
                    $(this).val(val);
                }
            });

        }

    } else {
        $('#hid_card_action').val(type + ":all");
    }
    console.log($('#hid_card_action').val());
});

$('body').on('keyup', '#product_tag', function() {
    $('#hid_card_action').val("tag:" + $('#product_tag').val());
});
$('#suggestionForm').on('submit', function(e) {
    e.preventDefault();
    if ($('#suggestionForm').validationEngine('validate')) {
        $.ajax({
            url: siteurl + "webBlankTemplateAjax/disApproveTemplate",
            type: "POST",
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            dataType: "json",
            async: false,
            success: function(res) {

                if (res.status == '1') {
                    myAlert(res.message, 'success');
                } else {
//                    myAlert(res.message, 'error');
                }

            }

        });
        this.reset();
    }

});
function disApprove() {
    if (confirm("Do you really want to disapprove it.")) {
        var ajaxdata = {};
        ajaxdata['templeteid'] = templateid;
        $.ajax({
            url: siteurl + "webBlankTemplateAjax/disApproveTemplate",
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

/**
 * validate form 
 */
if (isPreview != '1') {
    $('#commentPopup').validationEngine();
}
function updateGrid() {
    var ajaxdata = {};
    ajaxdata['templeteid'] = templateid;
    ajaxdata['contentboxHidden'] = $("#contentboxHidden").val();
    ajaxdata['taggedUserHidden'] = $("#taggedUserHidden").val();
    $.ajax({
        url: siteurl + "webBlankTemplateAjax/disApproveTemplate",
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

$('body').delegate('.radioImage', 'change', function() {
    var val = $(this).val();
    $('#hid_card_exist_file').val(val);
    $('#hid_card_exist_file').trigger('change');
});