<?php
$settings = new Settings();

if(isset($_POST['submit-settings'])) { $settings->change(); }

$this_setting = $settings->get();
?>

<section>
    <h1>Configurações</h1>
    
    <form action="?settings" method="post">
        <input type="hidden" name="submit-settings">
        <label>
            Margem de lucro <span class="description">- %</span>
            <input type="text" name="profit-margin" value="<?= $this_setting->profit_margin ; ?>">
        </label>
        <label>
            Consumo de combustível <span class="description">- km/l</span>
            <input type="text" name="fuel-consumption" value="<?= $this_setting->fuel_consumption ; ?>">
        </label>
        <label>
            Preço do litro de combustível <span class="description">- R$</span>
            <input type="text" name="fuel-price" value="<?= $this_setting->fuel_price ; ?>">
        </label>
        <label>
            Custo de aquisição GoogleAds (CAC) <span class="description">- R$</span>
            <input type="text" name="cost-per-acquisition" value="<?= $this_setting->cost_per_acquisition ; ?>">
        </label>

        <input type="submit" name="submit-settings" value="Alterar configurações">
    </form>
</section>