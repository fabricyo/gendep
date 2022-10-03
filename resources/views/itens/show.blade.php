@extends('layouts.master')

@section('content')
    <div class="card text-center text-white">
        <div class="card-header bg-info">Detalhes</div>
        <div class="card-body bg-primary">
            <h5 class="card-title">{{$item->nome}}</h5>
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
                <div class="col-4">
                    <a class="btn btn-success" href="{{ route('checkout', $item->id) }}"><i class="fa-solid fa-right-from-bracket"></i> Dar saída</a>
                </div>
                <div class="col-4">
                    <a class="btn btn-warning" href="{{ route('edit', $item->id) }}"><i class="fa-solid fa-pencil"></i> Editar</a>
                </div>
                <div class="col-4">
                    <a class="btn btn-danger" id="deleteBtn"><i class="fa-solid fa-trash"></i> Apagar</a>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $("#deleteBtn").click(function(){
            if (window.confirm("Deseja mesmo apagar o item?")) {
                document.location = "{{ route('destroy', $item->id) }}"
            }
        });
    </script>

@endsection