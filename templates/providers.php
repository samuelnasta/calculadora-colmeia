<?php
$provider = new Services_Provider();

if(isset($_POST['submit-service-provider'])) { $provider->change(); }

$this_provider = $provider->get();
?>

<section>
    <h1>Prestador de serviços</h1>

    <form action="?providers" method="post">
        <input type="hidden" name="submit-service-provider">
        <label>
            Nome
            <input type="text" id="name" name="name"
            value="<?= $this_provider->name; ?>">
        </label>
        <label>
            CEP <span class="description">(sem o hífen)</span>
            <input type="text" id="zipcode" name="zipcode"
            value="<?= $this_provider->zipcode; ?>"
            inputmode="numeric" pattern="[0-9]{8}"
            onblur="fill_address(this.value)">
        </label>
        <label>
            Endereço
            <input type="text" id="address" name="address"
            value="<?= $this_provider->address; ?>">
        </label>
        <label>
            Número
            <input type="text" id="number" name="number"
            value="<?= $this_provider->number; ?>">
        </label>
        <label>
            Bairro
            <input type="text" id="neighborhood" name="neighborhood"
             value="<?= $this_provider->neighborhood; ?>">
        </label>
        <label>
            Cidade
            <input type="text" id="city" name="city"
             value="<?= $this_provider->city; ?>">
        </label>
        <label>
            Estado
            <input type="text" id="state" name="state"
            value="<?= $this_provider->state; ?>">
        </label>

        <input type="submit" name="submit-service-provider" value="Salvar">
    </form>
</section>