function encodeEmail() {
    const encodedExampleEmailAddress = "am1lbm9AcHJpa2xhZC5jeg==";
    const encodedEmailAddress = "cmV2aXplQHRpbWlkdXNyZXZpemUuY3o=";
    const exampleEmailAddressInput = document.getElementById("email");
    const emailAddressCollection = document.getElementsByClassName("email-address");
    
    for (let i = 0; i < emailAddressCollection.length; i++){
    emailAddressCollection.item(i).setAttribute("href", "mailto:".concat(atob(encodedEmailAddress)));
    }
    exampleEmailAddressInput.setAttribute("placeholder", atob(encodedExampleEmailAddress));
}

function telNumberFormatter() {
    let telNumberInput = document.getElementById("number");

    telNumberInput.addEventListener("focus", event => {
        telNumberInput.value = telNumberInput.value.replaceAll(" ","");
    })
    
    telNumberInput.addEventListener("focusout", event => {
        let telNumberInputArray = telNumberInput.value.split('');
                if(telNumberInput.value.length >= 3 && telNumberInputArray[3] != " "){
                    telNumberInputArray.splice(3,0," ");
                }
                if(telNumberInput.value.length >= 7 && telNumberInputArray[7] != " "){
                    telNumberInputArray.splice(7,0," ");
                }
    
                let inputString = telNumberInputArray.join("");
                telNumberInput.value = inputString.substring(0,11);
    })
}

function grecaptchaOutput() {
    if (grecaptcha.getResponse() != ""){
        document.getElementById("submitButton").disabled = false;
    } else {
        document.getElementById("submitButton").disabled = true;
    }
}

function grecaptchaExpired() {
    document.getElementById("submitButton").disabled = true;
}

function grecaptchaDataError() {
    alert("Vyskytl se problém při komunikaci se serverem. Prosím, vyplňte kontaktní formulář později.");
}

function formValidate() {
    (() => {
      'use strict'
    
      const forms = document.querySelectorAll('.needs-validation');
      
      Array.from(forms).forEach(form => {
        form.addEventListener('submit', event => {
          if (!form.checkValidity()) {
            event.preventDefault();
            event.stopPropagation();
          }
    
          form.classList.add('was-validated');  
        }, false)
      });
  
    })()
  }
  
function submitForm() {
    let xhttp = new XMLHttpRequest();
    let data = new FormData(document.getElementById("form-contact"));
    xhttp.onreadystatechange = function() {

        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("successfullySentModalText").innerText = "Kontaktní formulář byl v pořádku odeslán ke zpracování. Údaje naleznete také na Vašem e-mailu.";
        }

        if (this.readyState == 4 && this.status == 400) {
            document.getElementById("successfullySentModalText").innerText = "Vyskytla se chyba při zpracování údajů z kontaktního formuláře. Vyplňte, prosím, formulář znovu.";
        }
    };
    xhttp.open("POST", "../docs/php/email_sender.php", true);
    xhttp.send(data);

    xhttp.onerror = function() {
        alert("Vyskytl se problém při komunikaci se serverem. Prosím, vyplňte kontaktní formulář později.");
      };
}

function closeForm() {
    const contactFormModal = bootstrap.Modal.getInstance('#contactFormModal');
    const contactFormModalDOM = document.getElementById("contactFormModal");
    
    contactFormModal.hide();          
    contactFormModalDOM.addEventListener('hidden.bs.modal', () => {
        form = document.getElementById("form-contact");
        form.reset();
        form.classList.remove('was-validated');
    })

    const successfullySentModal = new bootstrap.Modal('#successfullySentModal');
    document.getElementById("successfullySentModalText").innerText = "Čeká se na odpověď serveru...";
    successfullySentModal.show();
}

function formSend() {
    document.addEventListener("DOMContentLoaded", function() {
        document.getElementById("form-contact").addEventListener("submit", (event) => {
    
            event.preventDefault();
    
            let name = document.getElementById("name").value;
            let number = document.getElementById("number").value;
            let email = document.getElementById("email").value;
            let address = document.getElementById("address").value;
            let comment = document.getElementById("comment").value;
        
            if (name && number && email.includes("@") && address && comment) {
                submitForm();
                closeForm();
            }
        });
    });
}

encodeEmail();
telNumberFormatter();
formValidate();
formSend();