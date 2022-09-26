<?php
$db = new DB();
$service = new Service();

if(isset($_POST['submit'])) { $service->add(); }
if(!empty($_GET['delete'])) { $service->delete($_GET['delete']); }

$this_service = (!empty($_GET['id']))
    ? $service->get($_GET['id'])
    : $service->get(NULL);
?>

<section>
    <h1>Serviços</h1>
    
    <p><strong>MLS</strong> - Margem de Lucro Simples<br>
    <strong>MLR</strong> - Margem de Lucro Real</p>

    <?php $service->list(); ?>


    <h3>Adicionar serviço</h3>
    <form action="?services" method="post">
        <label>
            Nome
            <input type="text" name="name" required value="<?= $this_service->name; ?>">
        </label>
        <label>
            Preço
            <input type="text" name="price" required value="<?= $this_service->price; ?>">
        </label>
        <label>
            Custo
            <input type="text" name="cost" required value="<?= $this_service->cost; ?>">
        </label>

        <input type="submit" name="submit" value="Salvar">
    </form>
</section>