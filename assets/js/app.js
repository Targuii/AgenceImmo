// any CSS you require will output into a single css file (app.css in this case)
import Places from 'places.js'
import Map from './components/map'
import 'slick-carousel'
import 'slick-carousel/slick/slick.css'
import 'slick-carousel/slick/slick-theme.css'

Map.init()

let inputAddress = document.querySelector('#property_adress')
if (inputAddress !== null){
    let place = Places({
        container: inputAddress
    })
    place.on('change', e => {
        document.querySelector('#property_city').value = e.suggestion.city
        document.querySelector('#property_postal_code').value = e.suggestion.postcode
        document.querySelector('#property_lat').value = e.suggestion.latlng.lat
        document.querySelector('#property_lng').value = e.suggestion.latlng.lng
    })
}
let searchAddress = document.querySelector('#search_address')
if (searchAddress !== null){
    let place = Places({
        container: searchAddress
    })
    place.on('change', e => {
        document.querySelector('#lat').value = e.suggestion.latlng.lat
        document.querySelector('#lng').value = e.suggestion.latlng.lng
    })
}
//let $ = require('jquery')

global.$ = global.jQuery = $;

require('../css/app.css');
require('select2');

$('[data-slider]').slick({
    dots: true,
    arrows: true,
    autoplay: true,
    autoplaySpeed: 8000,
    fade: true

})

$('select').select2();

    let $contactButton = $('#contactButton')
$contactButton.click(e => {
    e.preventDefault();
    $('#contactForm').slideDown();
    $contactButton.slideUp();

})
// suppression des éléments (picture)

document.querySelectorAll('[data-delete]').forEach(a => {
    a.addEventListener('click', e=> {
        e.preventDefault()
        fetch(a.getAttribute('href'),{
            method: 'DELETE',
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'Content-Type': 'appliation/json'
            },
            body: JSON.stringify({'_token': a.dataset.token})
        }).then(response => response.json())
            .then(data => {
                if (data.success){
                    a.parentNode.parentNode.removeChild(a.parentNode)
                }else{
                    alert(data.error)
                }
            })
            .catch(e => alert(e))
    })
})

$(function () {$('[data-toggle="tooltip"]').tooltip()});

console.log('ok .. ça marche')
