import * as L from 'leaflet';
import 'leaflet/dist/leaflet.css';

export default class Map {

    static init () {
        let map = document.querySelector('#map')
        if (map === null) {
            return
        }
        let icon = L.icon({
            iconUrl: '/images/map/house.png',
            iconSize: [37, 37],
            iconAnchor:   [22, 38],
        })
        let center = [map.dataset.lat,map.dataset.lng]
        map = L.map('map',{scrollWheelZoom: false}).setView(center, 13,)
        let token = 'pk.eyJ1IjoidGFyZ3VpaSIsImEiOiJjandneHRhM3QxeTE3NDhtZ2VhOXdlNThoIn0.gk19FARXSS3r1X_qsEtK1A'
        L.tileLayer(`https://api.tiles.mapbox.com/v4/{id}/{z}/{x}/{y}.png?access_token=${token}`, {
            maxZoom: 18,
            minZoom: 12,
            attribution: '© <a href=\'https://www.mapbox.com/about/maps/\'>Mapbox</a> © <a href=\'http://www.openstreetmap.org/copyright\'>OpenStreetMap</a>',
            id: 'mapbox.streets' /* mapbox.light / dark / streets / outdoors / satellite */
        }).addTo(map)
        L.marker(center,{icon: icon}).addTo(map)

    }
}