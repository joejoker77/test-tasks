<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
    <script type="text/javascript" src="https://api-maps.yandex.ru/2.1/?lang=ru_RU"></script>
    <style type="text/css">html, body, #map {width: 100%;height: 100%;}</style>
    <title>Polygon area</title>
    <style>
        div#result {
            position: absolute;
            top: 50px;
            left: 50px;
            padding: 20px;
            background: white;
            box-shadow: 3px 3px 15px 0 rgba(0, 0, 0, 0.56);
        }
        div#result p{margin: 0;}
    </style>
</head>
<body>
    <div id="map"></div>
    <div id="result"></div>
<script>
    jQuery(document).ready(function ($) {

        var coord = [[55.72971176867458,37.61831644970703],[55.735087608068795,37.595571317260756],[55.738574241507834,37.58621577221679],[55.74724104424722,37.58235339123537],[55.7578903327607,37.58407000500488],[55.76229441215521,37.587159909790046],[55.7697947161594,37.596429624145514],[55.773568514646925,37.611278333251974],[55.773568514646925,37.62406710583497],[55.77245576605812,37.63574007946779],[55.768439929767936,37.64930132824707],[55.7632622747405,37.65659693676757],[55.75730953776135,37.65728358227541],[55.75145270280453,37.655910291259765],[55.742738421524756,37.65462283093261],[55.735499240800245,37.645095624511725],[55.73070465985291,37.63325098950196]];

        ymaps.modules.define('geo.utils', function (provide) {
            provide({
                RADIUS: 6378137,
                toRad: function toRad(deg) {
                    return deg * Math.PI / 180;
                }
            });
        });
        ymaps.modules.define('geo.polygonArea', ['geo.utils'], function (provide, util) {
            var RADIUS = util.RADIUS,
                toRad = util.toRad;

            function calculatePolygonArea(polygon) {
                var area = 0;
                var polyCoords = polygon.geometry.getCoordinates();
                if (polyCoords.length === 0) {
                    return area;
                }
                area = calculateArea(polyCoords[0]);
                for (var i = 1; i < polyCoords.length - 1; i++) {
                    area -= calculateArea(polyCoords[i]);
                }

                return area;
            }

            function calculateArea(coords) {
                var area = 0;
                for (var i = 0; i < coords.length - 1; i++) {
                    var p1 = coords[i];
                    var p2 = coords[i + 1];
                    area += toRad(p2[1] - p1[1]) * (2 + Math.sin(toRad(p1[0])) + Math.sin(toRad(p2[0])));
                }

                return Math.abs(area * RADIUS * RADIUS / 2.0);
            }

            provide({ calculatePolygonArea: calculatePolygonArea });
        });

        ymaps.ready({
            require: ['geo.polygonArea'],
            successCallback: function successCallback() {
                var vertices = coord,
                    polygon = void 0,
                    myMap = new ymaps.Map('map', {
                        center: [55.754079917677025,37.62174774615158],
                        zoom: 13,
                        controls: []
                    },{
                        searchControlProvider: 'yandex#search'
                    }),
                    myGeoObject = new ymaps.GeoObject({geometry: {type: "Polygon",coordinates: [coord],fillRule: "nonZero"},properties:{balloonContent: "Многоугольник"}}, {fillColor: '#00FF00', strokeColor: '#0000FF',opacity: 0.5,strokeWidth: 5,strokeStyle: 'shortdash'});

                myMap.geoObjects.add(myGeoObject);
                var stateMonitor = new ymaps.Monitor(myGeoObject.editor.state);
                stateMonitor.add("drawing", function (newValue) {
                    myGeoObject.options.set("strokeColor", newValue ? '#FF0000' : '#0000FF');
                });
                myGeoObject.editor.startEditing();
                myGeoObject.editor.events.add(["vertexdragend"], function (event) {
                    event.preventDefault();
                    var result = (ymaps.geo.polygonArea.calculatePolygonArea(myGeoObject) / 1000000).toFixed(3);
                    document.getElementById('result').innerHTML = '<p>Площадь выделенного участка: ' + result + 'км.<sup>2</sup></p>';
                });
                var result = (ymaps.geo.polygonArea.calculatePolygonArea(myGeoObject) / 1000000).toFixed(3);
                document.getElementById('result').innerHTML = '<p>Площадь выделенного участка: ' + result + ' км.<sup>2</sup></p>';
            }
        });
    });
</script>
</body>
</html>