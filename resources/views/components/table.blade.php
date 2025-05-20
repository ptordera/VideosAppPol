@props(['headers' => []])

<div class="table-responsive">
    <table {{ $attributes->merge(['class' => 'table table-hover table-responsive-list']) }}>
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
    /* Estilos para la tabla mejorada */
    .table-responsive-list {
        width: 100%;
        margin-bottom: 1rem;
        border-collapse: collapse;
        background-color: white;
        border-radius: 0.5rem;
        overflow: hidden;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
    }

    .table-responsive-list thead th {
        background-color: #f8f9fa;
        padding: 1rem;
        font-weight: 600;
        color: #495057;
        border-bottom: 2px solid #dee2e6;
        text-transform: uppercase;
        font-size: 0.85rem;
        letter-spacing: 0.5px;
    }

    .table-responsive-list tbody tr {
        transition: all 0.2s ease;
    }

    .table-responsive-list tbody tr:hover {
        background-color: rgba(0, 0, 0, 0.02);
    }

    .table-responsive-list td {
        padding: 1rem;
        vertical-align: middle;
        border-bottom: 1px solid #e9ecef;
    }

    /* Estilos responsivos para móviles */
    @media (max-width: 768px) {
        .table-responsive-list thead {
            display: none;
        }

        .table-responsive-list,
        .table-responsive-list tbody,
        .table-responsive-list tr {
            display: block;
            width: 100%;
        }

        .table-responsive-list tr {
            margin-bottom: 1rem;
            border-radius: 0.5rem;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            background-color: white;
            animation: fadeIn 0.3s ease-in-out;
        }

        .table-responsive-list td {
            display: flex;
            justify-content: space-between;
            align-items: center;
            text-align: right;
            padding: 0.75rem 1rem;
            border-bottom: 1px solid #f0f0f0;
        }

        .table-responsive-list td:last-child {
            border-bottom: none;
        }

        .table-responsive-list td:before {
            content: attr(data-label);
            font-weight: 600;
            color: #495057;
            padding-right: 0.5rem;
            text-align: left;
            flex: 1;
        }

        /* Ajustes para celdas con botones o contenido complejo */
        .table-responsive-list td.actions-cell {
            flex-direction: column;
            align-items: flex-start;
        }

        .table-responsive-list td.actions-cell:before {
            margin-bottom: 0.5rem;
            width: 100%;
        }

        .table-responsive-list td.actions-cell .d-flex {
            width: 100%;
            justify-content: flex-end;
        }
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(5px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
</style>
