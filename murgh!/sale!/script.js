function initAutocomplete() {
    var map = new google.maps.Map(document.getElementById('map'), {
      center: {lat: 26.88353770941183, lng: 80.91297622037398},
      zoom: 9,
      mapTypeId: 'roadmap'
    });
  
    // Create the search box and link it to the UI element.
    var input = document.getElementById('pac-input');
    var searchBox = new google.maps.places.SearchBox(input);
    map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);
  
    // Bias the SearchBox results towards current map's viewport.
    map.addListener('bounds_changed', function() {
      searchBox.setBounds(map.getBounds());
    });
  
    var markers = [];
    // Listen for the event fired when the user selects a prediction and retrieve
    // more details for that place.
    searchBox.addListener('places_changed', function() {
    var places = searchBox.getPlaces();
  
    if (places.length == 0) {
    return;
    }
  
    // Clear out the old markers.
    markers.forEach(function(marker) {
    marker.setMap(null);
    });
    markers = [];
  
    // For each place, get the icon, name and location.
    var bounds = new google.maps.LatLngBounds();
    places.forEach(function(place) {
    if (!place.geometry) {
      console.log("Returned place contains no geometry");
      return;
    }
    var icon = {
      url: place.icon,
      size: new google.maps.Size(71, 71),
      origin: new google.maps.Point(0, 0),
      anchor: new google.maps.Point(17, 34),
      scaledSize: new google.maps.Size(25, 25)
    };
  
    // Create a marker for each place.
    markers.push(new google.maps.Marker({
      map: map,
      icon: icon,
      title: place.name,
      position: place.geometry.location
    }));
  
    if (place.geometry.viewport) {
      // Only geocodes have viewport.
      bounds.union(place.geometry.viewport);
    } else {
      bounds.extend(place.geometry.location);
    }
    });
        map.fitBounds(bounds);
      });
  
      var customLabel = {
      Farmer: {
        label: 'F'
      },
      Dealer: {
        label: 'D'
      }
    };
  
    var infoWindow = new google.maps.InfoWindow;
    // Change this depending on the name of your PHP or XML file
    downloadUrl('toxml.php', function(data) {
      var xml = data.responseXML;
      var markers = xml.documentElement.getElementsByTagName('marker');
      Array.prototype.forEach.call(markers, function(markerElem) {
        var id = markerElem.getAttribute('id');
        var type = markerElem.getAttribute('type');
        var name = markerElem.getAttribute('name');
        var image = markerElem.getAttribute('image');
        var point = new google.maps.LatLng(
            parseFloat(markerElem.getAttribute('lat')),
            parseFloat(markerElem.getAttribute('lng')));
  
        var infowincontent = document.createElement('div');
        var atag = document.createElement('a');
        atag.setAttribute('href','/murgh!/link!/prof.php?uid=' + id);
        infowincontent.innerHTML = "<strong style='display:block;text-align:center;padding-bottom:10px'>" + name + "</strong>"; //タイトル表示。ここにprofileへのリンク付けたい！
        atag.innerHTML = "<img style='width:100px;border-radius:50%' src='../user_image/" + image + "'/>";
        infowincontent.appendChild(atag);
        // var text = document.createElement('p');
        // text.textContent = mobile //テキスト表示。location等。imageどう変換できる？？
        // infowincontent.appendChild(text);

        var icon = customLabel[type] || {};
        var marker = new google.maps.Marker({
          map: map,
          position: point,
          label: icon.label
        });
        marker.addListener('click', function() {
          infoWindow.setContent(infowincontent);
          infoWindow.open(map, marker);
        });
      });
    });
  }
  
  
    function downloadUrl(url, callback) {
      var request = window.ActiveXObject ?
          new ActiveXObject('Microsoft.XMLHTTP') :
          new XMLHttpRequest;
  
      request.onreadystatechange = function() {
        if (request.readyState == 4) {
          request.onreadystatechange = doNothing;
          callback(request, request.status);
        }
      };
      request.open('GET', url, true);
      request.send(null);
  
    }
    // getting data from mysql
    function doNothing() {}