$('#pac-input').live("keypress", function(e) {
        if (e.keyCode == 13) {
            return false; // prevent the button click from happening
        }
});
function clearSelection() {
  if (selectedShape) {
    selectedShape.setEditable(false);
    selectedShape = null;
  }
}
function setSelection(shape) {
    
  clearSelection();
  selectedShape = shape;
  shape.setEditable(true); 
  if(drawnType == 'circle')
  {
      draw_circle.setMap(null);
  }
  else if(drawnType == 'rectangle')
  {
      rectangle.setMap(null);
  }
  else
  {
      bermudaTriangle.setMap(null);
  }
  if(shape.type == 'circle'){
      coordinates = [];
      coordinates.push('circle-'+shape.radius);
      coordinates.push(shape.center.lat());
      coordinates.push(shape.center.lng());
      $('#GeofencesMaster_geofences_string').val(coordinates);
     
  }
  else if(shape.type == 'rectangle')
  {
      var ne = shape.getBounds().getNorthEast();
      var sw = shape.getBounds().getSouthWest();
      coordinates = [];
      coordinates.push('rectangle');
      coordinates.push(ne.lat());
      coordinates.push(sw.lng());    
      coordinates.push(sw.lat());
      coordinates.push(ne.lng());
      $('#GeofencesMaster_geofences_string').val(coordinates);
  }
  else
  {
      shape.setEditable(false);
    save_coordinates_to_array(shape);
    
  }
  //console.log(coordinates);
}
function deleteSelectedShape() {
  if (selectedShape) {
    selectedShape.setMap(null);
  }
}
function removeLine() {
    if(drawnType != '')
    {
        if(drawnType == 'circle')
        {
            draw_circle.setMap(null);
        }
        else if(drawnType == 'rectangle')
        {
            rectangle.setMap(null);
        }
        else
        {
            bermudaTriangle.setMap(null);
        }
        $("#GeofencesMaster_geofences_string").val('');
    }
    deleteAllShape();
}
function deleteAllShape() {
  for (var i = 0; i < all_overlays.length; i++) {
    all_overlays[i].overlay.setMap(null);
  }
  $("#GeofencesMaster_geofences_string").val('');
  all_overlays = [];
}
//This function save latitude and longitude to the polygons[] variable after we call it.
function save_coordinates_to_array(shape)
{
    //Save polygon to 'polygons[]' array to get its coordinate.
    polygons.push(shape);

    //This variable gets all bounds of polygon.
    var polygonBounds = shape.getPath();
    coordinates = [];
     coordinates.push('polygone');
    for(var i = 0 ; i < polygonBounds.length ; i++)
    {
        coordinates.push(polygonBounds.getAt(i).lat(), polygonBounds.getAt(i).lng());
    } 
    $('#GeofencesMaster_geofences_string').val(coordinates);
}
// Sets a listener on a radio button to change the filter type on Places
  // Autocomplete.
function setupClickListener(id, types) {
    var radioButton = document.getElementById(id);
    google.maps.event.addDomListener(radioButton, 'click', function() {
      autocomplete.setTypes(types);
    });
  }
function initialize() {
    var latlng = center; // latitude is 29.392971,longitude: 79.454051
    var myOptions = {
        zoom: 14,
        center: latlng,
        panControl: false,
       // disableDefaultUI: true,
       streetViewControl: false,
        zoomControl: true,
        zoomControlOptions: {
           style: google.maps.ZoomControlStyle.LARGE,
           position: google.maps.ControlPosition.LEFT_CENTER
        },
        mapTypeId: google.maps.MapTypeId.ROADMAP
    };
    map = new google.maps.Map(document.getElementById("map"), myOptions);
    //map.fitBounds(bounds);
    marker = new google.maps.Marker({position: latlng,draggable: true, map: map,title: 'Marker'});
    createPolyline(polyCoordinates,'0');
//    google.maps.event.addListener(map, 'click', function(event)
//    {
//        polyCoordinates[count] = event.latLng;
//        createPolyline(polyCoordinates,'0');
//            count++;
//    });
     google.maps.event.addListener(marker, 'dragend', function (event) {
       // removeLine()    

    });
  /**** Start code for address auto complete */
    var input = /** @type {HTMLInputElement} */(
    document.getElementById('pac-input'));

    var types = document.getElementById('type-selector');
    map.controls[google.maps.ControlPosition.TOP_CENTER].push(input);
    map.controls[google.maps.ControlPosition.TOP_CENTER].push(types);

    var autocomplete = new google.maps.places.Autocomplete(input);
    $('#pac-input').autocomplete({
      selectFirst: true
    });
    autocomplete.bindTo('bounds', map);

    //var infowindow = new google.maps.InfoWindow();
    google.maps.event.addListener(autocomplete, 'place_changed', function() 
    {
        //infowindow.close();
        marker.setVisible(false);
        var place = autocomplete.getPlace();
        if (!place.geometry) 
        {
          window.alert('Autocomplete\'s returned place contains no geometry');
          return;
        }
        if (place.geometry.viewport) 
        {
          map.fitBounds(place.geometry.viewport);
        } 
        else
        {
          map.setCenter(place.geometry.location);
          map.setZoom(17);  // Why 17? Because it looks good.
        }
        marker.setIcon(({
          url: place.icon,
          size: new google.maps.Size(71, 71),
          origin: new google.maps.Point(0, 0),
          anchor: new google.maps.Point(17, 34),
          scaledSize: new google.maps.Size(35, 35)
        }));
        marker.setPosition(place.geometry.location);
        marker.setVisible(true);
        var address = '';
        if (place.address_components) {
          address = [
            (place.address_components[0] && place.address_components[0].short_name || ''),
            (place.address_components[1] && place.address_components[1].short_name || ''),
            (place.address_components[2] && place.address_components[2].short_name || '')
          ].join(' ');
        }
//        infowindow.setContent('<div><strong>' + place.name + '</strong><br>' + address);
//        infowindow.open(map, marker);
    });
  /**** Start code for address auto complete */
  /**** Start code for polygon */
  drawingManager = new google.maps.drawing.DrawingManager({
    drawingMode: google.maps.drawing.OverlayType.POLYGON,
       markerOptions: {
        draggable: true,
        optimized: false,
        icon: new google.maps.MarkerImage('uxt/images/ap_gif.gif')
    },
    drawingControlOptions: {
        position: google.maps.ControlPosition.TOP_LEFT,
        drawingModes: [
        google.maps.drawing.OverlayType.CIRCLE,
        google.maps.drawing.OverlayType.POLYGON,
        google.maps.drawing.OverlayType.RECTANGLE
        ]
    },
    rectangleOptions: {
                editable:true,
                draggable:true,
                geodesic:true
            },
    polygoneOptions: {
                editable:false,
                draggable:false                
            },
        map: map
    });
    google.maps.event.addListener(drawingManager, 'rectanglecomplete', function(event) {
            google.maps.event.addListener(event, 'bounds_changed', function(){
              setSelection(event);                
            });
        });
    google.maps.event.addDomListener(drawingManager, 'circlecomplete', function(e) 
    {
        google.maps.event.addListener(e, 'bounds_changed', function(){
                   setSelection(e);
                
            });
      circles.push(e);
    });
//    google.maps.event.addDomListener(drawingManager, 'polygoncomplete', function(e) 
//    {
//       
//          google.maps.event.addListener(e, 'bounds_changed', function(){
//                   console.log(e.type);
//                   setSelection(e);
//                
//            });
//      
//    });
      
    google.maps.event.addListener(drawingManager, 'overlaycomplete', function(e) {
	deleteAllShape();
	all_overlays.splice();
        all_overlays.push(e);
       
    if (e.type != google.maps.drawing.OverlayType.MARKER)
    {
        drawingManager.setDrawingMode(null);
        var newShape = e.overlay;
        newShape.type = e.type;
        setSelection(newShape);
    }
    });
  // Clear the current selection when the drawing mode is changed, or when the
  // map is clicked.
  google.maps.event.addDomListener(document, 'keyup', function (e) {
  // deleteAllShape();
   return false;
});
  setupClickListener('changetype-all', []);
  setupClickListener('changetype-address', ['address']);
  setupClickListener('changetype-establishment', ['establishment']);
  setupClickListener('changetype-geocode', ['geocode']);
  
  /**** End code for polygon */
}
var draw_circle = null;  // object of google maps polygon for redrawing the circle
        function createPolyline(polyC,point){
            // $('#GeofencesMaster_geofences_string').val(polyC);
        if(drawnType == 'circle')
        {
            draw_circle = new google.maps.Circle({
                center: center,
                radius: rad,
                strokeOpacity: 0.8,
                strokeWeight: 2,
                fillOpacity: 0.35,
                map: map
            });
            map.fitBounds(draw_circle.getBounds());
        }
        else if(drawnType == 'rectangle')
        {
            var bounds = new google.maps.LatLngBounds(
                polyC[0],
                polyC[1]
            );
            // Define the rectangle and set its editable property to true.
            rectangle = new google.maps.Rectangle({
              bounds: bounds,
            });
            rectangle.setMap(map);
            map.fitBounds(rectangle.getBounds());
        }
        else
        {
            bermudaTriangle = new google.maps.Polygon({
            paths: polyC,
            strokeOpacity: 0.8,
            strokeWeight: 2,
            fillOpacity: 0.35
        });
            bermudaTriangle.setMap(map);
        }
     }
google.maps.event.addDomListener(window, 'load', initialize);