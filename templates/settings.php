<section>
    <h1>Configurações</h1>
    
    <form action="?settings" method="post">
        <label>
            Margem de lucro
            <input type="text" name=profit_margin" value="">
        </label>
        <label>
            Consumo de combustível
            <input type="text" name=fuel_consumption" value="">
        </label>
        <label>
            Preço do litro de combustível
            <input type="text" name=fuel_price" value="">
        </label>
        <label>
            Custo de aquisição GoogleAds (CAC)
            <input type="text" name="cost_per_acquisition" value="">
        </label>

        <input type="submit" value="Alterar configurações">
    </form>

    <hr>

    <h1>Prestador de serviços</h1>
    <form action="?service-provider" method="post">
        <label>
            Nome
            <input type="text" name=name" value="">
        </label>
        <label>
            CEP
            <input type="text" name=zipcode" value="">
        </label>
        <label>
            Endereço
            <input type="text" name="address" value="">
        </label>
        <label>
            Número
            <input type="text" name="number" value="">
        </label>
        <label>
            Cidade
            <input type="text" name="city" value="">
        </label>
        <label>
            Estado
            <input type="text" name="state" value="">
        </label>

        <input type="submit" value="Salvar">
    </form>
</section>