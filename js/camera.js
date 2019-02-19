var canvas_area = { audio: false, video: { width: 640, height: 480 } };

// Get access to the camera!
navigator.mediaDevices.getUserMedia(canvas_area).then(function(mediaStream) {
        var video = document.querySelector('video');
        video.srcObject = mediaStream;
        video.onloadedmetadata = function(e) {
            video.play();
        };
    }).catch(function(err) {console.log(err.name + ": " + err.message); });