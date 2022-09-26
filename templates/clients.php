<?php
$client = (object)['id' => NULL, 'name' => NULL, 'zipcode' => NULL, 'address' => NULL, 'number' => NULL, 'neighborhood' => NULL, 'city' => NULL, 'state' => NULL];
?>
<section id="clients">
    <h1>Clientes</h1>
    
    <form action="" method="post">
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

        <input type="submit" value="Salvar">
    </form>
</section>