function processOfferingtype(offeringType)
{
    if (offeringType != '') {
        var ajaxdata = {};
        ajaxdata['type'] = offeringType;
        ajaxdata['templeteFor'] = templeteFor;
        ajaxdata['contentid'] = contentid;
        $.ajax({
            url: siteurl + "actionFilter/GetDependentDropdown",
            data: ajaxdata,
            type: 'POST',
            async: false,
            success: function(data) {
                var res = $.parseJSON(data);
                if (res.status == '1') {
                    $('#dependent-ddl').html(res.data);
                    $('.existing-images').html('');
                    $('#hid_card_action').val(offeringType + ":all");
                    actionData = [];
//                        console.log(offeringType);
                    actionData.push(offeringType);
                    $('#hid_card_action_full').val(actionData.join(':'));

                    $('#offering-type').val(offeringType);
                } else {
                }

            }
        });
    } else {
        $('#hid_card_action').val('');
    }
    console.log($('#hid_card_action').val());
}
function loadCarousal() {
    var owl = $(".owl-demo");
    owl.owlCarousel({
        autoPlay: false,
        pagination: true,
        singleItem: true,
        transitionStyle: "fade",
    }); /* Carousel js */
}
$(document).ready(function(e) {

    /*
     * For Custom scroll 
     */
    $('.mobile_inner, .existing-images').mCustomScrollbar();
    $('#selectCard').on('click', function() {
        var selectedCard = $(".cards input[name='radioCard']:checked");
        var ajaxdata = {};
        ajaxdata['type'] = selectedCard.val();
        ajaxdata['templete'] = templete;
        ajaxdata['is_preview'] = is_preview;
        var liIds = $('#allcards .mycards').map(function(i, n) {
            return $(n).attr('sequence');
        }).get();
        ajaxdata['card_order'] = liIds.length + 1;
//            console.log(liIds.length + 1);
        $.ajax({
            url: siteurl + 'tempCard/getCard',
            data: ajaxdata,
            type: 'POST',
            async: false,
            success: function(data) {
                var res = $.parseJSON(data);
                if (res.status == '1') {
                    /*
                     $('#allcards').append(res.data);                        
                     myAlert(res.message, 'success');
                     loadCarousal();
                     */
                    loadCards();

                } else {
                    myAlert(res.message, 'error');
                }
                closeCardsDialog();
            }
        });
        loadCarousal();
        manageCardOrder();
        /*
         var liIds = $('#allcards .mycards').map(function(i, n) {
         return $(n).attr('sequence');
         }).get().join(',');
         */
    });
});
$(window).load(function() {
    loadCards();
});

/*
 * Enable Sorting for cards
 * @returns {undefined}     */
function enableDragable() {
    if (is_preview == '0') {
        $("#allcards").sortable({
            stop: function() {
                manageCardOrder();
            }
        });
    }

}
function manageCardOrder() {
    var liIds = $('#allcards .mycards').map(function(i, n) {
        return $(n).attr('sequence');
    }).get().join(',');
    var ajaxdata = {};
    ajaxdata['fields'] = liIds;
    $('#formdata').html('');
    $.ajax({
        url: siteurl + "tempCard/saveOrder",
        data: ajaxdata,
        type: 'POST',
        async: false,
        success: function(data) {

        }
    });
}
function popupOpen(fields, card, popup_type) {
    var ajaxdata = {};
    ajaxdata['fields'] = fields;
    ajaxdata['templeteFor'] = templeteFor;
    ajaxdata['contentid'] = contentid;
    $('#formdata').html('');
    $.ajax({
        url: siteurl + "cardForms/GetForm/" + card,
        data: ajaxdata,
        type: 'POST',
        async: false,
        success: function(data) {
            $('#formdata').html(data);
        }
    });
    openDialog();
}
$('#crform').on('submit', function(e) {
    e.preventDefault();
    $.ajax({
        url: siteurl + "cardForms/saveContentForm",
        type: "POST",
        data: new FormData(this),
        contentType: false,
        cache: false,
        processData: false,
        async: false,
        success: function(data) {
            var res = $.parseJSON(data);
            if (res.status == '1') {
                loadCards();
                myAlert(res.message, 'success');
                closeDialog();
            } else {
                myAlert(res.message, 'error');
            }

        }
    });

});
function openDialog() {
    $('#carousel_form').show();
}
function closeDialog() {
    $('.close').trigger("click");
}
function closeCardsDialog() {
    $('.close').trigger("click");
}
function removeCard(card) {
    if (card != '') {
        if (confirm('Do you really want to remove this card?')) {
            $.ajax({
                url: siteurl + "cardForms/RemoveCard/" + card,
                /* data: ajaxdata,*/
                type: 'POST',
                success: function(data) {
                    var res = $.parseJSON(data);
                    if (res.status == '1') {
                        loadCards();
                        myAlert(res.message, 'success');
                    } else {
                        myAlert(res.message, 'error');
                    }

                }
            });
        }
    }
}

$('body').delegate('#offering-type', 'change', function() {
    var offeringType = $(this).val();
    processOfferingtype(offeringType);
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


            ajaxdata['templeteFor'] = templeteFor;
            ajaxdata['contentid'] = contentid;
            $.ajax({
                url: siteurl + "actionFilter/GetDependentDropdown",
                data: ajaxdata,
                type: 'POST',
                async: false,
                success: function(data) {
                    var res = $.parseJSON(data);
                    if (res.status == '1') {
                        tempThis.parent().parent().parent().nextAll('.dropdown-cnt').remove();

                        $('.existing-images').html('');
                        actionData[$('.ddlQueue').length] = id;
                        for (i = $('.ddlQueue').length + 1; i < actionData.length; i++) {
                            actionData.pop(i);
                        }
                        $('#hid_card_action_full').val(actionData.join(':'));
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
            ajaxdata['templeteFor'] = templeteFor;
            ajaxdata['contentid'] = contentid;
            $.ajax({
                url: siteurl + "actionFilter/GetImages",
                data: ajaxdata,
                type: 'POST',
                async: false,
                success: function(data) {
                    var res = $.parseJSON(data);
                    if (res.status == '1') {

                        actionData[$('.ddlQueue').length] = id;
                        for (i = $('.ddlQueue').length + 1; i <= actionData.length; i++) {
                            actionData.pop(i);
                        }
                        $('#hid_card_action_full').val(actionData.join(':'));
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
/*
 * To clear field data
 */
$('body').delegate('.clr-btn', 'click', function() {
    $(this).prev().val('');
});

$('body').delegate('.radioImage', 'change', function() {
    var val = $(this).val();
    $('#hid_card_exist_file').val(val);
    $('#hid_card_exist_file').trigger('change');
});
$('.submit').on('click', function() {
    var action = $(this).attr('submitType');
    $('#actionType').val(action);
    $('#callCount').val('0');
});
/*To publish template*/
function publishTemplete(id) {
    var ajaxdata = {};
    ajaxdata['template'] = templete;
    ajaxdata['contentboxHidden'] = $("#contentboxHidden").val();
    ajaxdata['taggedUserHidden'] = $("#taggedUserHidden").val();
    $.ajax({
        url: siteurl + "tempCard/ValidateTemplete/" + id,
        type: 'POST',
        async: false,
        data: ajaxdata,
        success: function(data) {
            var res = $.parseJSON(data);
            if (res.status == '1') {
                $('#callCount').val('1');
                $('#disapproveForm').modal('hide');
                myAlert(res.message, 'success');
            } else {
                myAlert(res.message, 'error');
            }

        }
    });
}
/* To disapprove template*/
function disapproveTemplete() {
    var ajaxdata = {};
    ajaxdata['template'] = templete;
    ajaxdata['contentboxHidden'] = $("#contentboxHidden").val();
    ajaxdata['taggedUserHidden'] = $("#taggedUserHidden").val();
    $.ajax({
        url: siteurl + "tempCard/disapprove/",
        type: 'POST',
        data: ajaxdata,
        async: false,
        success: function(data) {
            var res = $.parseJSON(data);
            if (res.status == '1') {
                $('#callCount').val('1');
                myAlert(res.message, 'success');
                $('#disapproveForm').modal('hide');
            } else {
                myAlert(res.message, 'error');
            }

        }
    });
}
/*
 * To send submit request to pop up form for "submit" "publish" "disapprove" 
 * */
function updateGrid() {
    var actionType = $('#actionType').val();
    var ajaxdata = {};
    ajaxdata['template'] = templete;
    ajaxdata['contentboxHidden'] = $("#contentboxHidden").val();
    ajaxdata['taggedUserHidden'] = $("#taggedUserHidden").val();
    if ($('#callCount').val() == '0') {
        if (actionType == "submit") {
            submitTemplete();
        } else if (actionType == "disapprove") {
            disapproveTemplete();
        } else if (actionType == "publish") {
            publishTemplete(templete);
        }
    }
}


/**
 *To submit template
 *  @returns {undefined}
 * 
 */
function submitTemplete() {
    var ajaxdata = {};
    ajaxdata['template'] = templete;
    ajaxdata['contentboxHidden'] = $("#contentboxHidden").val();
    ajaxdata['taggedUserHidden'] = $("#taggedUserHidden").val();
    $.ajax({
        url: siteurl + "tempCard/submitTemplate/",
        type: 'POST',
        data: ajaxdata,
        async: false,
        success: function(data) {
            var res = $.parseJSON(data);
            if (res.status == '1') {
                $('#callCount').val('1');
                $('#disapproveForm').modal('hide');
                myAlert(res.message, 'success');
            } else {
                myAlert(res.message, 'error');
            }

        }
    });
}
/*To remove slide from carousal*/
function removeCarouselSlide(slide) {
    if (confirm("Do you really want to remove this slide?")) {
        $.ajax({
            url: siteurl + "tempCard/removeCarouselSlide/" + slide,
            type: 'POST',
            async: false,
            success: function(data) {
                var res = $.parseJSON(data);
                if (res.status == '1') {
                    myAlert(res.message, 'success');
                    loadCards();
                } else {
                    myAlert(res.message, 'error');
                }

            }
        });
    }
}
/*To add slide to carousal*/
function addCarouselSlide(mapid) {
    $.ajax({
        url: siteurl + "tempCard/addCarouselSlide/" + mapid,
        type: 'POST',
        success: function(data) {
            var res = $.parseJSON(data);
            if (res.status == '1') {
                myAlert(res.message, 'success');
                loadCards();
                $('.bs-form-modal-static').modal('show');
                popupOpen(res.data.fields, res.data.card, '');
            } else {
                myAlert(res.message, 'error');
            }

        }
    });
}
/**
 * Validate Aspect Ratio for image
 * @param {type} data : file field
 * @param {type} height
 * @param {type} width
 * @returns {undefined}
 * 
 */
function validateImageMobile(data, height, width) {
    height = typeof height !== 'undefined' ? height : 600;
    width = typeof width !== 'undefined' ? width : 600;
    var _URL = window.URL || window.webkitURL;
    var img, file, flag;
    flag = 1;
    var fileExtension = ['jpeg', 'jpg', 'png', 'gif'];
    if ($.inArray(data.value.split('.').pop().toLowerCase(), fileExtension) == -1) {
        flag = 0;
    }
    if (flag) {
        if ((file = data.files[0])) {
            img = new Image();
            img.onload = function() {
//                    console.log(this.width + " " + this.height);
                if (this.width < width || this.height < height) {
                    myAlert("Invalid Image size,minimum (" + width + "x" + height + ") required", 'error');
                    data.value = "";
                } else {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        $('#existingImage').attr('src', e.target.result);
                    };
                    reader.readAsDataURL(data.files[0]);
                }
            };
            img.src = _URL.createObjectURL(file);
        }
    } else {
        data.value = "";
        myAlert("Invalid Image", 'error');
    }

}

function getMeta(data) {
    var urldata = data.value;
    url = CDN + urldata;
//        alert(url);
    $("<img/>").attr("src", url).load(function() {
//            alert(this.width + ' ' + this.height);
    });
}
