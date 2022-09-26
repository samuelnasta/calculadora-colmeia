<?php
$db = new DB();

if(isset($_POST['submit-settings'])) {
    $delete = $db->get('DELETE FROM settings');
    $insert = $db->set(
        'settings',
        array(
            'profit_margin' => $_POST['profit-margin'],
            'fuel_consumption' => $_POST['fuel-consumption'],
            'fuel_price' => $_POST['fuel-price'],
            'cost_per_acquisition' => $_POST['cost-per-acquisition'],
        )
    );
    if($insert){
        echo '<div class="message-success">Configurações salvas</div>';
    }
}


$settings = $db->get("SELECT * FROM settings", NULL, 1);
if(empty($settings)) {
    $settings = (object)['id' => NULL, 'name' => NULL, 'price' => NULL, 'cost' => NULL];
}
?>

<section>
    <h1>Configurações</h1>
    
    <form action="?settings" method="post">
        <label>
            Margem de lucro
            <input type="text" name="profit-margin" value="<?= $settings->profit_margin ; ?>">
        </label>
        <label>
            Consumo de combustível
            <input type="text" name="fuel-consumption" value="<?= $settings->fuel_consumption ; ?>">
        </label>
        <label>
            Preço do litro de combustível
            <input type="text" name="fuel-price" value="<?= $settings->fuel_price ; ?>">
        </label>
        <label>
            Custo de aquisição GoogleAds (CAC)
            <input type="text" name="cost-per-acquisition" value="<?= $settings->cost_per_acquisition ; ?>">
        </label>

        <input type="submit" name="submit-settings" value="Alterar configurações">
    </form>

    
    <hr>




<?php
if(isset($_POST['submit-service-provider'])) {
    $delete = $db->get('DELETE FROM services_providers');
    $insert = $db->set(
        'services_providers',
        array(
            'name' => $_POST['name'],
            'zipcode' => $_POST['zipcode'],
            'address' => $_POST['address'],
            'number' => $_POST['number'],
            'city' => $_POST['city'],
            'state' => $_POST['state'],
        )
    );
    if($insert){
        echo '<div class="message-success">Prestador de serviço incluído com sucesso</div>';
    }
}


$service_provider = $db->get("SELECT * FROM services_providers", NULL, 1);
if(empty($service_provider)) {
    $service_provider = (object)['id' => NULL, 'name' => NULL, 'zipcode' => NULL, 'address' => NULL, 'number' => NULL, 'city' => NULL, 'state' => NULL];
}
?>


    <h1>Prestador de serviços</h1>
    <form action="?settings" method="post">
        <label>
            Nome
            <input type="text" name="name" value="<?= $service_provider->name; ?>">
        </label>
        <label>
            CEP
            <input type="text" name="zipcode" value="<?= $service_provider->zipcode; ?>">
        </label>
        <label>
            Endereço
            <input type="text" name="address" value="<?= $service_provider->address; ?>">
        </label>
        <label>
            Número
            <input type="text" name="number" value="<?= $service_provider->number; ?>">
        </label>
        <label>
            Cidade
            <input type="text" name="city" value="<?= $service_provider->city; ?>">
        </label>
        <label>
            Estado
            <input type="text" name="state" value="<?= $service_provider->state; ?>">
        </label>

        <input type="submit" name="submit-service-provider" value="Salvar">
    </form>
</section>