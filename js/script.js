"use strict"

document.addEventListener('DOMContentLoaded', function () {

    const form = document.getElementById ('form');
    form.addEventListener('submit', formSend);

    async function formSend(e) {
        e.preventDefault();

        let error = formValidate(form);

        let formData = new FormData(form);

        if (error===0) {
            form.classList.add('_sending');
            let response = await fetch ('send.php', {
                method: 'POST',
                body: formData
            });
            if (response.ok) {
                let result = await response.json();
                form.classList.remove('_sending');
                formPreview.innerHTML = '';
                form.reset();
            } else {
                alert("Ошибка");
                form.classList.remove('_sending');
            }
        }
    }


    function formValidate(form) {
        let error = 0;
        let formReq = document.querySelectorAll('._req');

        for (let index = 0; index < formReq.length; index++) {
            const input = formReq[index];
            formRemoveError(input);

            if (input.classList.contains('_email')) {
                if(emailTest(input)) {
                    formAddError(input);
                    error++;
                }
            } else {
                if (input.value === '') {
                    formAddError(input);
                    error++;
                }
            }
            
        }
        return error;
    }

    function formAddError(input) {
        input.parentElement.classList.add('_error');
        input.classList.add('_error');
    }
    function formRemoveError(input) {
        input.parentElement.classList.add('_error');
        input.classList.remove('_error');
    }

    function emailTest(input) {
        return !/^[\w-\.]+@[\w-]+\.[a-z]{2,4}$/i .test(input.value);
    }


    let inputs = document.querySelectorAll('input[type="tel"]');
    let im = new Inputmask('+7 (999) 999-99-99');
    im.mask(inputs);

});


