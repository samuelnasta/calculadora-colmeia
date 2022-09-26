<?php

$db = new DB();

if(isset($_POST['submit'])) {
    $insert = $db->set(
        'services',
        array(
            'name' => $_POST['name'],
            'price' => $_POST['price'],
            'cost' => $_POST['cost'],
        )
    );
    if($insert){
        echo '<div class="message-success">Serviço incluído com sucesso</div>';
    }
}


if(!empty($_GET['delete'])) {
    $delete = $db->delete("services", $_GET['delete']);
    if($delete){
        echo '<div class="message-success">Serviço removido com sucesso</div>';
    }
}


$services = $db->get("SELECT * FROM services");
$service = (object)['id' => NULL, 'name' => NULL, 'price' => NULL, 'cost' => NULL];

if(!empty($_GET['id'])) {
    $service = $db->get(
        "SELECT *
        FROM services
        WHERE id = :id",
        array(':id' => $_GET['id']),
        1
    );
}
?>

<section>
    <h1>Serviços</h1>
    

    <ul class="list">
    <?php if($services) {
        foreach ($services as $list_service) {
            echo <<<EOF
            <li>
                <p>
                    <a href="?services&id={$list_service->id}">{$list_service->name} - R$ {$list_service->price}</a>
                    <a href="?services&delete={$list_service->id}">Apagar</a>
                </p>
            </li>
            EOF;
        }
    }
    ?>
    </ul>

    
    <h3>Adicionar serviço</h3>
    <form action="?services" method="post">
        <label>
            Nome
            <input type="text" name="name" required value="<?= $service->name; ?>">
        </label>
        <label>
            Preço
            <input type="text" name="price" required value="<?= $service->price; ?>">
        </label>
        <label>
            Custo
            <input type="text" name="cost" required value="<?= $service->cost; ?>">
        </label>

        <input type="submit" name="submit" value="Salvar">
    </form>
</section>