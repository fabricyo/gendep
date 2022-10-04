@extends('layouts.master')

@section('content')
    <div class="card text-center text-white">
        <div class="card-header bg-info">Detalhes</div>
        <div class="card-body bg-primary">
            <h5 class="card-title">{{$item->nome}} ({{$item->qtd}})</h5>
            <p class="card-text">{{$item->local}}</p>
            <div class="row">
                <div class="col-6 mb-3">
                    <i class="fa-solid fa-tag"></i> {{$item->marca}}
                </div>
                <div class="col-6 mb-3">
                    <i class="fa-solid fa-list"></i> {{$item->categoria}}
                </div>
                <div class="col-12 mb-3">
                    <i class="fa-solid fa-barcode"></i> {{$item->barcode}}
                </div>
                <div class="col-6 col-sm-4  mb-3">
                    <i class="fa-solid fa-right-to-bracket"></i> {{dateSwap($item->entrada)}}
                </div>
                <div class="col-6 col-sm-4 mb-3">
                    <i class="fa-solid fa-right-from-bracket"></i> {!! $item->saida ? dateSwap($item->saida) : '<span class="fst-italic">Não definido</span>' !!}
                </div>
                <div class="col-6 col-sm-4 mb-3 mx-auto">
                    <i class="fa-solid fa-calendar-xmark"></i> {{dateSwap($item->validade)}} <br>
                    <span class="text-opacity-75 fst-italic">{!! daysLeft($item->validade) !!}</span>
                </div>
            </div>
        </div>
        <div class="card-footer bg-secondary">
            <div class="row">
                <div class="col-6 mb-3">
                    <button type="button" class="btn btn-success btnModal" data-tipo="e"
                            data-mdb-toggle="modal" data-mdb-target="#fluxoModal"><i class="fa-solid fa-right-to-bracket"></i> entrada</button>
                </div>
                <div class="col-6 mb-3">
                    <button type="button" class="btn btn-info btnModal" data-tipo="s"
                            data-mdb-toggle="modal" data-mdb-target="#fluxoModal"><i class="fa-solid fa-right-from-bracket"></i> saída</button>
                </div>
                <div class="col-6 mb-3">
                    <a class="btn btn-warning" href="{{ route('edit', $item->id) }}"><i class="fa-solid fa-pencil"></i> Editar</a>
                </div>
                <div class="col-6 mb-3">
                    <a class="btn btn-danger" id="deleteBtn"><i class="fa-solid fa-trash"></i> Apagar</a>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="fluxoModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalLabel"></h5>
                    <button type="button" class="btn-close" data-mdb-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <label for="nome" class="form-label">Quantidade</label>
                    <input type="number" class="form-control" id="qtd" name="qtd" placeholder="12" required>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-mdb-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-primary" id="btnFluxo" disabled>Salvar</button>
                </div>
            </div>
        </div>
    </div>

    <h6 class="mt-5">Fluxo de entrada e saída</h6>
    <table class="table table-hover table-striped table-bordered w-100 mt-4" id="fluxo_table">
        <thead>
        <tr>
            <th scope="col">Quantidade</th>
            <th scope="col">Tipo</th>
            <th scope="col">Data</th>
        </tr>
        </thead>
        <tbody>
        @foreach($fluxo as $f)
            <tr>
                <td>{{$f->qtd}}</td>
                <td>{{$f->tipo == 0 ? 'Entrada' : 'Saida'}}</td>
                <td data-sort="{{$f->created_at}}">{{dateSwap($f->created_at)}}</td>
            </tr>
        @endforeach
        </tbody>
    </table>





@endsection
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs5/jszip-2.5.0/dt-1.12.1/af-2.4.0/b-2.2.3/b-colvis-2.2.3/b-html5-2.2.3/r-2.3.0/datatables.min.css"/>
<link rel="stylesheet" href="{{url('datatables/styles.css')}}">
@section('scripts')
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs5/jszip-2.5.0/dt-1.12.1/af-2.4.0/b-2.2.3/b-colvis-2.2.3/b-html5-2.2.3/r-2.3.0/datatables.min.js"></script>

    <script>
        $("#deleteBtn").click(function(){
            if (window.confirm("Deseja mesmo apagar o item?")) {
                document.location = "{{ route('destroy', $item->id) }}"
            }
        });
        let selected = 'e';
        $(".btnModal").on('click', function(){
            selected = $(this).data('tipo');
            if (selected == 'e') {
                $("#modalLabel").html('Marcar entrada');
            }else{
                $("#modalLabel").html('Dar saída');
            }
        });

        $("#qtd").on('keyup', function(){
            if (isNaN(parseInt($(this).val())))
                $("#btnFluxo").attr('disabled', true);
            else
                $("#btnFluxo").attr('disabled', false);
        });
        $("#btnFluxo").click(function(){
            if (!isNaN(parseInt($("#qtd").val()))){
                let qtd = $("#qtd").val();
                window.location = '{{ route('fluxo') }}' + `?q=${qtd}&t=${selected}&i={{$item->id}}`;
            }
        });

        var table = $('#fluxo_table').DataTable({
            dom: 'ftir',
            language: {
                url: '{{url('datatables/pt-BR.json')}}'
            },
            order: [[2, 'desc']],
            responsive: true,
            columnDefs: [
                { responsivePriority: 1, targets: 0 },
                { responsivePriority: 2, targets: 1 },
            ]
        });
    </script>

@endsection