<!DOCTYPE html >
  <head>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
    <meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
    <title>Using MySQL and PHP with Google Maps</title>

    <style>
      /* Always set the map height explicitly to define the size of the div
       * element that contains the map. */
      #map {
        height: 100%;
      }
      /* Optional: Makes the sample page fill the window. */
      html, body {
        height: 100%;
        margin: 0;
        padding: 0;
      }
    </style>

  </head>

<html>
  <body>
    <div id="map"></div>
    <script>
      var customLabel = {
        Digital: {
          label: 'D'
        },
        Analoga: {
          label: 'A'
        }
      };

        function initMap() {
        var map = new google.maps.Map(document.getElementById('map'), {
          center: new google.maps.LatLng(-24.808010,-56.080790),
          zoom: 12
        });
        var infoWindow = new google.maps.InfoWindow;

          // Change this depending on the name of your PHP or XML file
          //downloadUrl('https://storage.googleapis.com/mapsdevsite/json/mapmarkers2.xml', function(data) {
          downloadUrl('importabla/markers.xml', function(data) {
            var xml = data.responseXML;
            var markers = xml.documentElement.getElementsByTagName('marker');
            Array.prototype.forEach.call(markers, function(markerElem) {
              var id = markerElem.getAttribute('Codigo');
              var name = markerElem.getAttribute('Nombre');
              var address = markerElem.getAttribute('Direccion');
              var fec1 = markerElem.getAttribute('Feconec');
              var fec4 = markerElem.getAttribute('Telefono');
              var fec5 = markerElem.getAttribute('Latix');
              var fec6 = markerElem.getAttribute('Longx');
              var fec7 = markerElem.getAttribute('Type');


              var type = markerElem.getAttribute('type');
              var point = new google.maps.LatLng(
                  parseFloat(markerElem.getAttribute('lat')),
                  parseFloat(markerElem.getAttribute('lng')));

              var infowincontent = document.createElement('div');

              var text = document.createElement('text');
              text.textContent = id
              infowincontent.appendChild(text);
              infowincontent.appendChild(document.createElement('br'));

              var strong = document.createElement('strong');
              strong.textContent = name
              infowincontent.appendChild(strong);
              infowincontent.appendChild(document.createElement('br'));


              var text = document.createElement('text');
              text.textContent = address
              infowincontent.appendChild(text);
              infowincontent.appendChild(document.createElement('br'));

              var text = document.createElement('text');
              text.textContent = fec1
              infowincontent.appendChild(text);
              infowincontent.appendChild(document.createElement('br'));

              var text = document.createElement('text');
              text.textContent = fec4
              infowincontent.appendChild(text);
              infowincontent.appendChild(document.createElement('br'));

              var text = document.createElement('text');
              text.textContent = fec7
              infowincontent.appendChild(text);
              infowincontent.appendChild(document.createElement('br'));

              var text = document.createElement('text');
              text.textContent = fec5
              infowincontent.appendChild(text);

              var text = document.createElement('text');
              text.textContent = fec6
              infowincontent.appendChild(text);

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

      function doNothing() {}
    </script>

    <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCU3E-o_x9ilBFQJ_n8ZFQYfAoJdqt9DKQ&callback=initMap">
    </script>


  </body>
</html>