<h1 style="text-align:center;">Relatório de Fechamento</h1>

<h3>Vendas</h3>
<table border="1" width="100%" cellspacing="0" cellpadding="5">
    <tr>
        <th>Produto</th>
        <th>Valor</th>
    </tr>

    @foreach($vendas as $v)
    <tr>
        <td>{{ $v->nome }}</td>
        <td>R$ {{ number_format($v->preco_venda,2,',','.') }}</td>
    </tr>
    @endforeach
</table>

<br>

<h3>Despesas</h3>
<table border="1" width="100%" cellspacing="0" cellpadding="5">
    <tr>
        <th>Nome</th>
        <th>Valor</th>
    </tr>

    @foreach($despesas as $d)
    <tr>
        <td>{{ $d->nome }}</td>
        <td>R$ {{ number_format($d->valor,2,',','.') }}</td>
    </tr>
    @endforeach
</table>

<br>

<h2>Total Vendas: R$ {{ number_format($totalVendas,2,',','.') }}</h2>
<h2>Total Despesas: R$ {{ number_format($totalDespesas,2,',','.') }}</h2>
<h2>Lucro Final: R$ {{ number_format($lucro,2,',','.') }}</h2>
