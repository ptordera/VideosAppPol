@props(['headers' => []])

<div class="responsive-table-container">
    <table class="responsive-table">
        <thead>
        <tr>
            @foreach($headers as $header)
                <th>{{ $header }}</th>
            @endforeach
        </tr>
        </thead>
        <tbody>
        {{ $slot }}
        </tbody>
    </table>
</div>

<style>
    .responsive-table-container {
        overflow-x: auto;
        border-radius: 8px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
    }

    .responsive-table {
        width: 100%;
        border-collapse: collapse;
        background-color: white;
    }

    .responsive-table th {
        background-color: #f8f9fa;
        padding: 12px 15px;
        text-align: left;
        font-weight: 600;
        color: #495057;
        border-bottom: 2px solid #dee2e6;
    }

    .responsive-table td {
        padding: 12px 15px;
        border-bottom: 1px solid #e9ecef;
    }

    .responsive-table tbody tr:hover {
        background-color: #f8f9fa;
    }

    @media (max-width: 768px) {
        .responsive-table-container {
            box-shadow: none;
        }

        .responsive-table,
        .responsive-table thead,
        .responsive-table tbody,
        .responsive-table th,
        .responsive-table td,
        .responsive-table tr {
            display: block;
        }

        .responsive-table thead tr {
            position: absolute;
            top: -9999px;
            left: -9999px;
        }

        .responsive-table tr {
            margin-bottom: 15px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            background-color: white;
        }

        .responsive-table td {
            position: relative;
            padding-left: 40%;
            border: none;
            border-bottom: 1px solid #eee;
        }

        .responsive-table td:last-child {
            border-bottom: none;
        }

        .responsive-table td:before {
            position: absolute;
            top: 12px;
            left: 15px;
            width: 35%;
            padding-right: 10px;
            white-space: nowrap;
            font-weight: 600;
            color: #495057;
        }

        /* Añadir etiquetas para cada celda en móvil */
        .responsive-table td.has-label:before {
            content: attr(data-label);
        }
    }
</style>
