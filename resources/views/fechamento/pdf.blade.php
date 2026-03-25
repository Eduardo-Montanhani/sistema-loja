<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <style>
        /* Estilos baseados em relatórios contábeis profissionais */
        body {
            font-family: 'Helvetica', 'Arial', sans-serif;
            color: #333;
            line-height: 1.6;
            margin: 0;
            padding: 20px;
        }

        .header {
            text-align: center;
            border-bottom: 2px solid #4f46e5;
            padding-bottom: 20px;
            margin-bottom: 30px;
        }

        .header h1 {
            margin: 0;
            text-transform: uppercase;
            letter-spacing: 2px;
            color: #1e293b;
        }

        .header p {
            margin: 5px 0 0;
            color: #64748b;
            font-size: 14px;
        }

        h3 {
            background: #f8fafc;
            padding: 10px;
            border-left: 4px solid #4f46e5;
            color: #1e293b;
            margin-top: 30px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th {
            background-color: #f1f5f9;
            color: #475569;
            text-align: left;
            padding: 12px;
            font-size: 12px;
            text-transform: uppercase;
            border-bottom: 1px solid #e2e8f0;
        }

        td {
            padding: 10px 12px;
            border-bottom: 1px solid #f1f5f9;
            font-size: 13px;
        }

        .text-right { text-align: right; }

        /* Cores de status */
        .text-success { color: #10b981; font-weight: bold; }
        .text-danger { color: #ef4444; font-weight: bold; }

        /* Seção de Resumo Final */
        .summary-container {
            margin-top: 50px;
            page-break-inside: avoid; /* Evita que o resumo quebre entre páginas no PDF */
        }

        .summary-box {
            width: 300px;
            margin-left: auto; /* Alinha o resumo à direita */
            border-top: 2px solid #e2e8f0;
            padding-top: 15px;
        }

        .summary-item {
            display: flex;
            justify-content: space-between;
            margin-bottom: 8px;
            font-size: 14px;
        }

        .summary-total {
            margin-top: 15px;
            padding-top: 15px;
            border-top: 1px solid #4f46e5;
            font-size: 18px;
            font-weight: bold;
            color: #1e293b;
        }

        .footer {
            margin-top: 50px;
            text-align: center;
            font-size: 10px;
            color: #94a3b8;
        }
    </style>
</head>
<body>

    <div class="header">
        <h1>Relatório de Fechamento</h1>
        <p>Período: {{ date('m/Y') }} | Gerado em: {{ date('d/m/Y H:i') }}</p>
    </div>

    <h3>Entradas (Vendas)</h3>
    <table>
        <thead>
            <tr>
                <th>Descrição do Produto</th>
                <th class="text-right">Valor Unitário</th>
            </tr>
        </thead>
        <tbody>
            @foreach($vendas as $v)
            <tr>
                <td>{{ $v->nome }}</td>
                <td class="text-right">R$ {{ number_format($v->preco_venda,2,',','.') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <h3>Saídas (Despesas)</h3>
    <table>
        <thead>
            <tr>
                <th>Identificação da Despesa</th>
                <th class="text-right">Valor Pago</th>
            </tr>
        </thead>
        <tbody>
            @foreach($despesas as $d)
            <tr>
                <td>{{ $d->nome }}</td>
                <td class="text-right text-danger">- R$ {{ number_format($d->valor,2,',','.') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="summary-container">
        <div class="summary-box">
            <div class="summary-item">
                <span>Total de Vendas:</span>
                <span class="text-success">R$ {{ number_format($totalVendas,2,',','.') }}</span>
            </div>
            <div class="summary-item">
                <span>Total de Despesas:</span>
                <span class="text-danger">R$ {{ number_format($totalDespesas,2,',','.') }}</span>
            </div>
            <div class="summary-total">
                <span>LUCRO FINAL:</span>
                <span class="{{ $lucro >= 0 ? 'text-success' : 'text-danger' }}" style="float: right;">
                    R$ {{ number_format($lucro,2,',','.') }}
                </span>
            </div>
        </div>
    </div>

    <div class="footer">
        Este documento é um resumo financeiro privado do Sistema Loja.
    </div>

</body>
</html>
