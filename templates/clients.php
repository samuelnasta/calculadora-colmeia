<?php
$db = new DB();

if(isset($_POST['name'])) {
    $insert = $db->set(
        'clients',
        array(
            'name' => $_POST['name'],
            'zipcode' => $_POST['zipcode'],
            'address' => $_POST['address'],
            'number' => $_POST['number'],
            'neighborhood' => $_POST['neighborhood'],
            'city' => $_POST['city'],
            'state' => $_POST['state'],
            'cpf_cnpj' => $_POST['cpf_cnpj'],
        )
    );
    if($insert){
        echo '<div class="message-success">Cliente incluído com sucesso</div>';
    }
}


if(!empty($_GET['delete'])) {
    $delete = $db->delete("clients", $_GET['delete']);
    if($delete){
        echo '<div class="message-success">Cliente removido com sucesso</div>';
    }
}


$clients = $db->get("SELECT * FROM clients");
$client = (object)['id' => NULL, 'name' => NULL, 'zipcode' => NULL, 'address' => NULL, 'number' => NULL, 'neighborhood' => NULL, 'city' => NULL, 'state' => NULL, 'cpf_cnpj' => NULL];

if(!empty($_GET['id'])) {
    $client = $db->get(
        "SELECT *
        FROM clients
        WHERE id = :id",
        array(':id' => $_GET['id']),
        1
    );
}

?>

<section id="clients">
    <h1>Clientes</h1>
    
    <ul class="list">
    <?php if($clients) {
        foreach ($clients as $list_client) {
            echo <<<EOF
            <li>
                <p>
                    <a href="?clients&id={$list_client->id}">{$list_client->name}</a>
                    <a href="?clients&delete={$list_client->id}">Apagar</a>
                </p>
            </li>
            EOF;
        }
    }
    ?>
    </ul>


    <form action="?clients" id="form-clients" method="post">
        <input type="hidden" name="submit-client">
        <label>
            Nome
            <input type="text" id="name" name="name"
            value="<?= $client->name; ?>">
        </label>
        <label>
            CEP
            <input type="text" id="zipcode" name="zipcode"
            value="<?= $client->zipcode; ?>"
            inputmode="numeric" pattern="[0-9]{8}"
            onblur="fill_address(this.value)">
        </label>
        <label>
            Endereço
            <input type="text" id="address" name="address"
            value="<?= $client->address; ?>">
        </label>
        <label>
            Número
            <input type="text" id="number" name="number"
            value="<?= $client->number; ?>">
        </label>
        <label>
            Bairro
            <input type="text" id="neighborhood" name="neighborhood"
             value="<?= $client->neighborhood; ?>">
        </label>
        <label>
            Cidade
            <input type="text" id="city" name="city"
             value="<?= $client->city; ?>">
        </label>
        <label>
            Estado
            <input type="text" id="state" name="state"
            value="<?= $client->state; ?>">
        </label>
        <label>
            CPF / CNPJ
            <input type="text" id="cpf_cnpj" name="cpf_cnpj"
            onblur="console.log(validate_cpf_cnpj(this.value))"
            value="<?= $client->cpf_cnpj; ?>">
        </label>

        <input type="submit" value="Salvar">
    </form>
</section>