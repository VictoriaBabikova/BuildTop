let change = document.getElementById('change');
let login = document.getElementById('formId');
let div = document.createElement('div');
let cont = document.createElement('div');
let text = document.createElement('h3');
let text2 = document.createElement('h3');
let user_name = document.getElementById('user_name');
let user_email = document.getElementById('user_email');
let password = document.getElementById('password');


change.onclick = function ShowWindow(event) {
    if (user_name.value == '' || user_email.value == '' || password.value == '') {
        div.className = "modal_window";
        div.innerHTML = "<img src='img/todolist.png' width=100 alt='to_do_list' style='padding-top:30px'>"
        text.innerHTML = "заполните все поля";
        login.append(div);
        div.append(text);
        setTimeout(function () {
            text.remove();          
            div.remove(); 
        }, 2900);
        setTimeout(function () {
           location.reload();  
        }, 3000);
        return false;
    }
    else {
        div.className = "modal_window";
        cont.className = "cont_svg";
        cont.innerHTML = `<svg viewbox="0 0 48 48" xmlns="http://www.w3.org/2000/svg">
        <path d="M 18 32.34 l -8.34 -8.34 -2.83 2.83 11.17 11.17 24 -24 -2.83 -2.83 z" stroke="#3da35a" fill="transparent"/> </svg>`;
        text2.innerHTML = "Изменения успешно сохранены";
        login.append(div);
        div.append(cont,text2);

        let checkmark = document.querySelector('svg');
        let className = "animate";

        if (!checkmark.classList.contains(className)) {
        checkmark.classList.add(className);
        
        setTimeout(function(){      
            checkmark.classList.remove(className);
        }, 1700);
            
        }
        setTimeout(function(){      
            div.remove(); 
        }, 3000);
    }
    
}