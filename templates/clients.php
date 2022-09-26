<?php
$client = new Client();

if(isset($_POST['name'])) { $client->add(); }
if(!empty($_GET['delete'])) { $client->delete($_GET['delete']); }
if(!empty($_GET['id'])) { $this_client = $client->get($_GET['id']); }
$this_client = (!empty($_GET['id']))
    ? $client->get($_GET['id'])
    : $client->get(NULL);
?>

<section id="clients">
    <h1>Clientes</h1>
    
    <?php $clients = $client->list(); ?>

    <form action="?clients" id="form-clients" method="post">
        <input type="hidden" name="submit-client">
        <label>
            Nome
            <input type="text" id="name" name="name"
            value="<?= $this_client->name; ?>">
        </label>
        <label>
            CEP
            <input type="text" id="zipcode" name="zipcode"
            value="<?= $this_client->zipcode; ?>"
            inputmode="numeric" pattern="[0-9]{8}"
            onblur="fill_address(this.value)">
        </label>
        <label>
            Endereço
            <input type="text" id="address" name="address"
            value="<?= $this_client->address; ?>">
        </label>
        <label>
            Número
            <input type="text" id="number" name="number"
            value="<?= $this_client->number; ?>">
        </label>
        <label>
            Bairro
            <input type="text" id="neighborhood" name="neighborhood"
             value="<?= $this_client->neighborhood; ?>">
        </label>
        <label>
            Cidade
            <input type="text" id="city" name="city"
             value="<?= $this_client->city; ?>">
        </label>
        <label>
            Estado
            <input type="text" id="state" name="state"
            value="<?= $this_client->state; ?>">
        </label>
        <label>
            CPF / CNPJ
            <input type="text" id="cpf_cnpj" name="cpf_cnpj"
            onblur="console.log(validate_cpf_cnpj(this.value))"
            value="<?= $this_client->cpf_cnpj; ?>">
        </label>

        <input type="submit" value="Salvar">
    </form>
</section>