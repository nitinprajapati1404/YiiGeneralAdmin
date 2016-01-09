var config;
(function($, window, document, undefined) {
    config = {
//        arguments: 'yes',
        height: 'test',
        /*
         * 
         * @param {type} param : is the object in that our all predefined values are assogn to the properties
         * @returns {config} return all default properties and methods which are define through out system
         */
        init: function(param) {
            this.siteUrl = param.siteUrl;
            this.siteText = param.siteText;
            this.ckEditorType = param.ckEditorTypeValue;
            return this;
        },
        /*
         * function to check value in array
         * @array : is the array 
         * @value : check this value exists in array or not
         */
        isInArray: function(value,array) {
//            console.log(array.indexOf(value));
            return array.indexOf(value) > -1;
        },
        /*
         * 
         * @param {type} url : url on which we need to make ajax call
         * @param {type} type : data Type(json or xml)
         * @param {type} data : data what we want to send to action
         * @returns {jqXHR} whole response of ajax
         */
        ajaxCall: function(url, type, data) {
            return ($.ajax({
                url: url,
                type: type,
                data: data
            }))
        },
        /*
         * 
         * @param {type} object : on which we want to put action and want to preview images
         * @param {type} action : which action is apply on object
         * @param {type} location : where to display our images
         * @returns {undefined}
         */
         imagePreview: function (object, action, location, imageConfig, multi) {
            if (window.File && window.FileList && window.FileReader) {
                $(location).empty();

//                $(location).html('');
                $(object).on(action, function (e) {
                    var files = e.target.files;
                    var filesLength = files.length;
                    if (!multi) {
                        $(location).empty();
                    }

                    for (var i = 0; i < filesLength; i++) {
                        var f = files[i];
                        var fileReader = new FileReader();
                        fileReader.onload = (function (f) {
                            $(".exist").remove();
//                             console.log(f.target.result);
                            var image = new Image();
//                            $("<img></img>", {
//                                class: "imageThumb",
//                                src: f.target.result,
//                                title: f.target.name
//                            }).appendTo(location);
                            image.src = f.target.result;
                            image.title = f.target.name;
                            image.class = "imageThumb";
                            image.onload = function () {
                                
                                if (imageConfig.isRatioValidation) {
                                    // Maximum image size
                                    if (imageConfig.condType == ">") {
                                        if (this.height <= imageConfig.height && this.width <= imageConfig.width) {
                                            $(object).val("");
                                            alert("Image size should be minimum of "+imageConfig.width+" X "+imageConfig.height);
                                            
                                        }else{
                                            $(image).appendTo(location);
                                        }
                                    }
                                    // Minimum image size
                                    if (imageConfig.condType == "<") {
                                        if (this.height >= parseInt(imageConfig.height) && this.width >= parseInt(imageConfig.width)) {
                                            $(object).val("");
                                            alert("Image size should be maximum of "+imageConfig.width+" X "+imageConfig.height);
                                        }else{
                                            $(image).appendTo(location);
                                        }
                                    }
                                    // Equal image size
                                    if (imageConfig.condType == "=") {
                                        if (this.height == imageConfig.height && this.width == imageConfig.width) {
                                            $(object).val("");
                                            alert("Image size should be same as "+imageConfig.width+" X "+imageConfig.height);
                                        }else{
                                            $(image).appendTo(location);
                                        }
                                    }


                                }

                            }
                        });
                        fileReader.readAsDataURL(f);
                    }
                });
            } else {
                alert("Your browser doesn't support to File API")
            }
        },
        onImageExistsPreview: function(value, location) {
            if (value !== undefined && value !== '') {
                var valueImage = value;
                var arr = valueImage.split(',');
                $.each(arr, function(index, value) {
                    $(location).append('<img class="imageThumb exist" src="' + value + '" />');
                });
            }


        },
        /*
         * 
         * @param {type} object : on which we need to make action and on which action will occur and output will come
         * @param {type} action : which action should apply on object
         * @param {type} formId : id of form in that form our image file will exists
         * @param {type} targetId : where to preview our images
         * @param {type} resultPlace : which things to display and on which our content will put
         * @returns {undefined}
         */
        uploadImages: function(object, action, formId, targetId, resultPlace) {
            $(object).on(action, function() {
                $(formId).ajaxForm({
                    //display the uploaded images
                    target: targetId,
                    beforeSubmit: function(e) {
                        $(resultPlace).show();
                    },
                    success: function(e) {
                        $(resultPlace).hide();
                    },
                    error: function(e) {
                    }
                }).submit();
            });
        },
        /*
         * @object : on which process occur
         * @event : Which action function will trigger for ex change,click etc
         * @object : method which will execute after trigger event
         */
        eventHandler: function(object, event, handler) {
            $(document).delegate(object, event, handler);
        },
        /*
         * desable event on individual class or id
         */
        removeEventHandler: function(object, event) {
            console.log(object);
            $(document).undelegate(object, event);
        },
        /**
         * 
         * @param {type} formObject : id of the form 
         * @param {type} object : id of the button on which we put action
         * @param {type} flag
         * @returns {undefined}
         * 
         */
        submitForm: function(formObject, flag) { 
            $(formObject).validationEngine();
            if (flag == undefined) {
                flag = true;
            }
            if ($(formObject).validationEngine('validate') && flag)
            {
                $('form' + formObject).submit();
            } else {
                console.log("something missing...");
            }
        },
        /**
         * 
         * @param {type} fieldObject : Name of the field
         * @param {type} objectId : id of the field 
         * @param {type} filebrowserImageUploadUrl : 
         * @returns {undefined}
         * 
         */
        ckEditorFormGet: function(fieldObject, objectId) { 
            CKEDITOR.replace(fieldObject, {
                filebrowserImageUploadUrl: this.ckEditorType
            });
            // objectId = eval(objectId); 
            var editor = CKEDITOR.instances[objectId];
            CKEDITOR.disableAutoInline = true;
            editor.on('instanceReady', function() {
                var writer = editor.dataProcessor.writer;
                writer.indentationChars = '';
                writer.lineBreakChars = '';
                adjustmainpanelheight();
            });
        },
        ckEditorValueOnBlur: function(objectId) {
            var flag = false;
             var description = CKEDITOR.instances[objectId].getData();
            if (description) {
                flag = true;
                console.log("data exists");
               $('#cke_'+objectId).removeClass('errorMsgTxtBx');
                $('.errDescription').hide();

            } else {
                flag = false;
                $('#cke_'+objectId).addClass('errorMsgTxtBx').after('<div>This Field is Required</div>');
                console.log('here');
                $('.errDescription').show().css('color', '#ff0000');
                $('#cke_'+objectId).focus();
            }
            
            console.log(flag);
            return flag;
        },
        checkvalue : function(value){
            console.log(value);
            if(value!==''){
                console.log("Has Value");
                return true;
            }else{
                console.log("Has No Value");
                return false;
            }
        }
    }
})(jQuery, window, document);

