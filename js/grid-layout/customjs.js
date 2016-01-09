
function manageOwlCarousel() {
    full12x2gridcarousal(), fullCarousalwithArrow(), full2Carousal(), full4Carousal(), full6Carousal(), full12Carousal();
}
function full12Carousal() {
    $('#maincontainer').find('.full12gridcarousal').each(function() {
        $(this).owlCarousel({
            // your initial option here, again.
            navigation: true, // Show next and prev buttons
            slideSpeed: 300,
            pagination: true,
            navigation: false,
                    singleItem: true,
            items: 1,
            itemsDesktop: true,
        });
        $(this).data('owlCarousel').destroy();
        $(this).owlCarousel({
            // your initial option here, again.
            navigation: true, // Show next and prev buttons
            slideSpeed: 300,
            pagination: true,
            navigation: false,
                    singleItem: true,
            // "singleItem:true" is a shortcut for:
            items: 1,
            itemsDesktop: true,
        });
    });
}
function full6Carousal() {
    $('#maincontainer').find('.full6gridcarousal').each(function() {
        $(this).owlCarousel({
            // your initial option here, again.
            navigation: true, // Show next and prev buttons
            slideSpeed: 300,
            pagination: true,
            navigation: false,
                    singleItem: true,
            items: 1,
            itemsDesktop: true,
        });
        $(this).data('owlCarousel').destroy();
        $(this).owlCarousel({
            // your initial option here, again.
            navigation: true, // Show next and prev buttons
            slideSpeed: 300,
            pagination: true,
            navigation: false,
                    singleItem: true,
            // "singleItem:true" is a shortcut for:
            items: 1,
            itemsDesktop: true,
        });
    });
}
function full4Carousal() {
    $('#maincontainer').find('.full4gridcarousal').each(function() {
        $(this).owlCarousel({
            // your initial option here, again.
            navigation: true, // Show next and prev buttons
            slideSpeed: 300,
            pagination: true,
            navigation: false,
                    singleItem: false,
            items: 3,
            itemsDesktop: true,
        });
        $(this).data('owlCarousel').destroy();
        $(this).owlCarousel({
            // your initial option here, again.
            navigation: true, // Show next and prev buttons
            slideSpeed: 300,
            pagination: true,
            navigation: false,
                    singleItem: false,
            // "singleItem:true" is a shortcut for:
            items: 3,
            itemsDesktop: true,
        });
    });
}
function full2Carousal() {
    $('#maincontainer').find('.full2gridcarousal').each(function() {
        $(this).owlCarousel({
            // your initial option here, again.
            navigation: true, // Show next and prev buttons
            slideSpeed: 300,
            pagination: true,
            navigation: false,
                    singleItem: false,
            items: 6,
            itemsDesktop: true,
        });
        $(this).data('owlCarousel').destroy();
        $(this).owlCarousel({
            // your initial option here, again.
            navigation: true, // Show next and prev buttons
            slideSpeed: 300,
            pagination: true,
            navigation: false,
                    singleItem: false,
            // "singleItem:true" is a shortcut for:
            items: 6,
            itemsDesktop: true,
        });
    });
}
function full12x2gridcarousal() {
    $('#maincontainer').find('.full12x2gridcarousal').each(function() {
        $(this).owlCarousel({
            // your initial option here, again.
            navigation: true, // Show next and prev buttons
            slideSpeed: 300,
            pagination: true,
            navigation: false,
                    singleItem: false,
            items: 2,
            itemsDesktop: true,
        });
        $(this).data('owlCarousel').destroy();
        $(this).owlCarousel({
            // your initial option here, again.
            navigation: true, // Show next and prev buttons
            slideSpeed: 300,
            pagination: true,
            navigation: false,
                    singleItem: false,
            // "singleItem:true" is a shortcut for:
            items: 2,
            itemsDesktop: true,
        });
    });
}
function fullCarousalwithArrow() {
    $('#maincontainer').find('.witharrow').each(function() {
        $(this).owlCarousel({
            navigation: true, // Show next and prev buttons
            slideSpeed: 300,
            pagination: false,
            navigation : true,
                    navigationText: ["", ""],
            singleItem: false,
            // "singleItem:true" is a shortcut for:
            items: 1,
            itemsDesktop: true,
        });
        $(this).data('owlCarousel').destroy();
        $(this).owlCarousel({
            navigation: true, // Show next and prev buttons
            slideSpeed: 300,
            pagination: false,
            navigation : true,
            navigationText: ["<i class='fa fa-angle-left fa-5x'></i>", "<i class='fa fa-angle-right fa-5x'></i>"],
            singleItem: false,
            // "singleItem:true" is a shortcut for:
            items: 1,
            itemsDesktop: true,
        });
    });   
}

//full12x2gridcarousal
