function init(){
const paris = {
    
        lng : 100.50128,
        lat : 13.75421
      }
    const zoomLevel = 7;
   const map = L.map(`mapid`).setView([paris.lat, paris.lng],zoomLevel);
   const mainLayer = L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=sk.eyJ1IjoiY2ljZXJvbiIsImEiOiJja3E1ZGE5aWIxMjRnMnZvMGQ3MmdsM3VkIn0.xsSOc3Bbw7vkqsX2Ye1oyg', {
    attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
    maxZoom: 18,
    id: 'mapbox/streets-v11',
    tileSize: 512,
    zoomOffset: -1,
    accessToken: 'sk.eyJ1IjoiY2ljZXJvbiIsImEiOiJja3E1ZGE5aWIxMjRnMnZvMGQ3MmdsM3VkIn0.xsSOc3Bbw7vkqsX2Ye1oyg'
    });
    map.addLayer(mainLayer);
}

