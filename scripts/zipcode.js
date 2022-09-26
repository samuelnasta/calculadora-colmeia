// Clear input fields
function clear_address() {
    const elements = ["address", "number", "neighborhood", "city", "state"];
    elements.map(function (element) {
        document.getElementById(element).value = "";
    });
}

// When JSON successfully arrives, fill data in form
function display_address(response) {
    if (!("erro" in response)) {
        document.getElementById("address").value = response.logradouro;
        document.getElementById("neighborhood").value = response.bairro;
        document.getElementById("city").value = response.localidade;
        document.getElementById("state").value = response.uf;
        document.getElementById("number").select();
    } else {
        // On error
        clear_address();
        alert("CEP não encontrado.");
    }
}

//Validates zipcode and get AJAX results
function fill_address(zipcode) {
    zipcode = zipcode.replace(/\D/g, "");

    if (zipcode != "") {
        // Regex pattern with 8 numbers and no extra symbols or letters
        const zipcode_pattern = /^[0-9]{8}$/;

        // Test to match zipcode pattern
        if (zipcode_pattern.test(zipcode)) {
            clear_address();

            // Look for zipcode data in API
            fetch("https://viacep.com.br/ws/" + zipcode + "/json/")
                .then((response) => response.json())
                .then((response) => display_address(response));
        } else {
            // On error
            alert("Formato de CEP inválido.");
            document.getElementById("zipcode").select();
        }
    }
}
