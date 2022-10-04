@extends('layouts.master')

@section('content')

    <div class="row">
        <div class="col-12 col-md-2 text-end">
            <a class="btn btn-primary" href="{{route('create')}}">Adicionar item</a>
        </div>
    </div>
    <div class="w-100 mt-5">
        <h6>Filtro por vencimento</h6>
        <div class="btn-group btn-group-sm mb-3 mt-1">
            <input type="radio" class="btn-check" name="options" id="option0" autocomplete="off" checked>
            <label class="btn btn-secondary" for="option0">Todos</label>

            <input type="radio" class="btn-check" name="options" id="option_7" autocomplete="off" />
            <label class="btn btn-secondary" for="option_7">Em 7 dias</label>

            <input type="radio" class="btn-check" name="options" id="option_31" autocomplete="off" />
            <label class="btn btn-secondary" for="option_31">Em 1 mês</label>

            <input type="radio" class="btn-check" name="options" id="option_90" autocomplete="off" />
            <label class="btn btn-secondary" for="option_90">Em 3 meses</label>
        </div>

        <table class="table table-hover table-striped table-bordered w-100" id="itens_table">
            <thead>
            <tr>
                <th scope="col">Nome</th>
                <th scope="col">Local</th>
                <th scope="col">Marca</th>
                <th scope="col">Categoria</th>
                <th scope="col">Código de barras</th>
                <th scope="col">Dias Restantes</th>
            </tr>
            </thead>
            <tbody>
                @foreach($itens as $i)
                    <tr>
                        <td><a href="{{ route('show', $i->id) }}">{{$i->nome}}</a></td>
                        <td>{{$i->local}}</td>
                        <td>{{$i->marca}}</td>
                        <td>{{$i->categoria}}</td>
                        <td>{{$i->barcode}}</td>
                        <td data-sort="{{$i->validade}}">{{dateSwap($i->validade)}} <span class="text-opacity-75 fst-italic"
                                                             style="font-size: small">({!! daysLeft($i->validade) !!})</span></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs5/jszip-2.5.0/dt-1.12.1/af-2.4.0/b-2.2.3/b-colvis-2.2.3/b-html5-2.2.3/r-2.3.0/datatables.min.css"/>
<link rel="stylesheet" href="{{url('datatables/styles.css')}}">

@section('scripts')
<script type="text/javascript" src="https://cdn.datatables.net/v/bs5/jszip-2.5.0/dt-1.12.1/af-2.4.0/b-2.2.3/b-colvis-2.2.3/b-html5-2.2.3/r-2.3.0/datatables.min.js"></script>
<script>
    window.addEventListener('load', function(){
        var selected = 'option0';
        var table = $('#itens_table').DataTable({
            // dom: 'Bftir',
            dom: 'Bfrtip',
            language: {
               url: '{{url('datatables/pt-BR.json')}}'
            },
            buttons: [{
                extend: 'excel',
                text: 'Planilha <i class="fas fa-file-excel"></i>'
            }],
            responsive: true,
            columnDefs: [
                { responsivePriority: 1, targets: 0 },
                { responsivePriority: 2, targets: 1 },
            ]
        });
        $('.btn-check').click(function(){
            selected = $(this).attr('id');
            table.draw();
        });
        //Filtro customizado
        $.fn.dataTable.ext.search.push(function (settings, data, dataIndex) {
            if (selected === 'option0')
                return true;
            let dias = parseInt(selected.slice(7));
            let dias_restantes = parseInt(data[5].slice(78).split(" ")[0]);
            dias_restantes = isNaN(dias_restantes) ? -1 : dias_restantes;
            return dias_restantes >= 0 && dias_restantes <= dias;

        });

    });
</script>
@endsection
