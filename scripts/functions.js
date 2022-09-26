const form_client = document.getElementById("form-clients");
form_client.addEventListener("submit", function (event) {
    event.preventDefault();
    let cpf_cnpj_value = document.getElementById("cpf_cnpj").value;
    if (!validate_cpf_cnpj(cpf_cnpj_value)) {
        alert("CPF/CNPJ inválido");
    }
});
