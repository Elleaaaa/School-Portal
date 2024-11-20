<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>VR School Tour</title>
    <meta name="description" content="VR School Tour - A-Frame">
    <script src="https://aframe.io/releases/1.2.0/aframe.min.js"></script>
    <script src="https://unpkg.com/aframe-event-set-component@5/dist/aframe-event-set-component.min.js"></script>
    <style>
        body {
            margin: 0;
        }

        canvas {
            display: block;
        }
    </style>
</head>

<body>
    <a-scene>
        <a-assets>
            <!-- Add your 360-degree images here -->
            <img id="panorama1" src="{{ asset('images/panoramasample.jpg') }}">
            <img id="panorama2" src="{{ asset('images/panoramasample1.jpg') }}">
            <img id="panorama3" src="{{ asset('images/panoramasample2.jpg') }}">
            <img id="panorama4" src="{{ asset('images/panoramasample3.jpg') }}">
        </a-assets>

        <!-- 360-degree image -->
        <a-sky id="image-360" radius="10" src="#panorama1"
            animation__fade="property: components.material.material.color; type: color; from: #FFF; to: #000; dur: 300; startEvents: fade"
            animation__fadeback="property: components.material.material.color; type: color; from: #000; to: #FFF; dur: 300; startEvents: animationcomplete__fade"></a-sky>

        <!-- Navigation Arrows -->
        <a-entity position="2 0 -4" geometry="primitive: cone; radiusBottom: 0.2; radiusTop: 0; height: 0.4"
            material="color: red" rotation="90 0 0" class="clickable" data-raycastable
            onclick="changeSky('#panorama4');">
        </a-entity>

        <a-entity position="-2 0 -4" geometry="primitive: cone; radiusBottom: 0.2; radiusTop: 0; height: 0.4"
            material="color: blue" rotation="90 180 0" class="clickable" data-raycastable
            onclick="changeSky('#panorama1');">
        </a-entity>

        <!-- Camera + cursor -->
        <a-entity camera wasd-controls look-controls>
            <a-cursor id="cursor"
                animation__click="property: scale; startEvents: click; from: 0.1 0.1 0.1; to: 1 1 1; dur: 150"
                animation__fusing="property: fusing; startEvents: fusing; from: 1 1 1; to: 0.1 0.1 0.1; dur: 1500"
                event-set__mouseenter="_event: mouseenter; color: springgreen"
                event-set__mouseleave="_event: mouseleave; color: black" raycaster="objects: .clickable"></a-cursor>
        </a-entity>

    </a-scene>

    <script>
        // Sky change function to switch images
        function changeSky(newImage) {
            const sky = document.querySelector('#image-360');
            sky.setAttribute('src', newImage);
            sky.emit('fade');
        }
    </script>
</body>

</html>
