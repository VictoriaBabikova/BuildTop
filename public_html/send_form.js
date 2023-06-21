"use strict"
let hiddenBlock = document.getElementsByClassName('container_grid');
let ImageLoader = document.getElementsByClassName('container_form');
document.addEventListener('DOMContentLoaded', function () {  
    let form = document.getElementById('send_message');
    form.addEventListener('submit', formSend);

    async function formSend(e) {
        e.preventDefault();
        hiddenBlock[0].classList.add('_sending');
        ImageLoader[0].classList.add('_sending');
        let formData = new FormData(form);
        let response = await fetch('/send_message', {
            method: 'POST',
            body: formData
        });
        let div = document.createElement('div');
        let cont = document.createElement('div');
        let text2 = document.createElement('h3');
        div.className = "modal_window";
        cont.className = "cont_svg";
        cont.innerHTML = `<svg viewbox="0 0 48 48" xmlns="http://www.w3.org/2000/svg">
        <path d="M 18 32.34 l -8.34 -8.34 -2.83 2.83 11.17 11.17 24 -24 -2.83 -2.83 z" stroke="#3da35a" fill="transparent"/> </svg>`;
        ImageLoader[0].append(div);
        div.append(cont,text2);
        let checkmark = document.querySelector('svg');
        let className = "animate";

        if (!checkmark.classList.contains(className)) {
        checkmark.classList.add(className);
        if (response.ok) {
            let result = await response.json().then(result => {
                text2.innerHTML = result.message;
            }).catch(error => console.error(error));
            hiddenBlock[0].classList.remove('_sending');
            ImageLoader[0].classList.remove('_sending');
            setTimeout(function(){      
                checkmark.classList.remove(className);
            }, 1700);         
            }
            setTimeout(function(){      
                div.remove();            
            }, 3000);
                
            form.reset();
        }
        else {
            alert('Ошибка');
            hiddenBlock[0].classList.remove('_sending');
            ImageLoader[0].classList.remove('_sending');
        }
    }
});
 
