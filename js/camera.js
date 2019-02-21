var video = document.getElementById('video');
var sticks = document.getElementById('filters');

if(navigator.mediaDevices && navigator.mediaDevices.getUserMedia)
{
   navigator.mediaDevices.getUserMedia({ video: true }).then(function(stream)
   {
       video.srcObject = stream;
   });
}

var filters = new Array;
filters[0] = "png/catears.png";
filters[1] = "png/Claus.png";
filters[2] = "png/dab.png";
filters[3] = "png/dtf.png";
filters[4] = "png/Faceless.png";
filters[5] = "png/focku.png";
filters[6] = "png/kodak.png";
filters[7] = "png/Ninja.png";
filters[8] = "png/tears.png";
filters[9] = "png/bugeye.png";
filters[10] = "png/fallout.png";
filters[11] = "png/savage.png";

function add_effect(e)
{
    var img = new Image;
    img.crossOrigin = "Anonymous";
    img.src = filters[e];
    var can1 = document.getElementById('filters').getContext('2d');
    can1.drawImage(img,0,0,200,200);
}

function snap()
{
    var can = document.getElementById('canvas').getContext('2d');
    can.drawImage(video,0,0,400,300);
    can.drawImage(sticks,0,0,400,300);
    var str = document.getElementById('canvas').toDataURL();
    document.getElementById('camera').value = str;
}