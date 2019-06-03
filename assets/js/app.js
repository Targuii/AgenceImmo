// any CSS you require will output into a single css file (app.css in this case)
require('../css/app.css');
require('select2');

global.$ = global.jQuery = $;


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
