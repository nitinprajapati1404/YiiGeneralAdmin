var googleMapLocation;
(function($, window, document, undefined) {
    googleMapLocation = {
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
         * field : location id on which this will called
         * ,stateId : where to save that id of state
         * ,countryId : where to save that id of country
         * longitudeId : where to save that id of longitude
         * latitudeId : where to save that id of latitude
         */
        pickfunction: function(field, stateId, countryId, longitudeId, latitudeId) {
            var e = document.getElementById(field);
//        console.log(e);
            var name = e.value;
//        console.log("name==" + name);
            if (typeof (name) != 'undefined' && name != '')
            {
                var options = {
                    types: ['geocode'],
                    componentRestrictions: {country: name}
                };
            }
            else
            {
                var options = {
                    types: ['geocode'],
                };
            }
            this.googleGetPlaces(field, e, options, stateId, countryId, longitudeId, latitudeId);

        },
        /*
         * field : location id on which this will called
         * e  : value taken by that id
         * options  : what options you want want
         * ,stateId : where to save that id of state
         * ,countryId : where to save that id of country
         * longitudeId : where to save that id of longitude
         * latitudeId : where to save that id of latitude
         */
        googleGetPlaces: function(field, e, options, stateId, countryId, longitudeId, latitudeId) {
            console.log(stateId);
            var autocomplete = new google.maps.places.Autocomplete(e, options);
            google.maps.event.addListener(autocomplete, 'place_changed', function() {
                picplace = autocomplete.getPlace();
//                console.log(picplace);
                address = picplace.address_components;
                address.forEach(function(entry) {
                    types = entry.types;   // array of type of location based on that we can decide state and country
                    if (config.isInArray('administrative_area_level_1', types) && config.isInArray('political', types)) {
//                        console.log(entry.short_name);
                        document.getElementById(stateId).value = entry.short_name;
                    } else if (config.isInArray('country', types) && config.isInArray('political', types)) {
//console.log(entry.short_name);
                        document.getElementById(countryId).value = entry.short_name;
                    }
                });
//            console.log(picplace.address_components);
//            console.log("FORMATEED==" + picplace.formatted_address);
                IsplaceChange = true;
                $("#" + field).keydown(function() {
                    IsplaceChange = false;
                });
                //   document.getElementById('city2').value = place.name;
                document.getElementById(longitudeId).value = picplace.geometry.location.lat();
                document.getElementById(latitudeId).value = picplace.geometry.location.lng();

            });
        },
        checkvalue: function(value) {
            console.log(value);
            if (value !== '') {
                console.log("Has Value");
                return true;
            } else {
                console.log("Has No Value");
                return false;
            }
        }
    }
})(jQuery, window, document);


//function pickfunction() {
////        var IsplaceChange = false;
////        var input = document.getElementById('field');
//    var e = document.getElementById("field");
////        console.log(e);
//    var name = e.value;
////        console.log("name==" + name);
//    if (typeof (name) != 'undefined' && name != '')
//    {
//        var options = {
//            types: ['geocode'],
//            componentRestrictions: {country: name}
//        };
//    }
//    else
//    {
//        var options = {
//            types: ['geocode'],
//        };
//    }
//    var autocomplete = new google.maps.places.Autocomplete(e, options);
//    google.maps.event.addListener(autocomplete, 'place_changed', function() {
//        picplace = autocomplete.getPlace();
//        console.log(picplace);
//        address = picplace.address_components;
//        address.forEach(function(entry) {
//            types = entry.types;   // array of type of location based on that we can decide state and country
//            if (isInArray('administrative_area_level_1', types) && isInArray('political', types)) {
//                document.getElementById('state').value = entry.short_name;
//            } else if (isInArray('country', types) && isInArray('political', types)) {
//
//                document.getElementById('country').value = entry.short_name;
//            }
//        });
////            console.log(picplace.address_components);
////            console.log("FORMATEED==" + picplace.formatted_address);
//        IsplaceChange = true;
//        $("#field").keydown(function() {
//            IsplaceChange = false;
//        });
//        //   document.getElementById('city2').value = place.name;
//        document.getElementById('longitude').value = picplace.geometry.location.lat();
//        document.getElementById('latitude').value = picplace.geometry.location.lng();
//
//    });
//}
//
//function isInArray(value, array) {
//    return array.indexOf(value) > -1;
//}


