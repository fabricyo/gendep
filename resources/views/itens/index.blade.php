@extends('layouts.master')

@section('content')

    <div class="row">
        <div class="col-12 col-md-2 text-end">
            <a class="btn btn-primary" href="{{route('create')}}">Adicionar item</a>
        </div>
    </div>
    <div class="w-100 mt-5">
        <table class="table table-primary w-100" id="itens_table">
            <thead>
            <tr>
                <th scope="col">Nome</th>
                <th scope="col">Local</th>
                <th scope="col">Ação</th>
            </tr>
            </thead>
            <tbody>
                @foreach($itens as $i)
                    <tr>
                        <td><a href="{{ route('show', $i->id) }}">{{$i->nome}}</a></td>
                        <td>{{$i->local}}</td>
                        <td>{{$i->barcode}}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection


@section('scripts')
<script type="text/javascript" src="https://cdn.datatables.net/v/bs5/jszip-2.5.0/dt-1.12.1/b-2.2.3/b-html5-2.2.3/date-1.1.2/datatables.min.js"></script>
<script>
    window.addEventListener('load', function(){
        $('#itens_table').DataTable({
            dom: 'ftir',
            language: {
               url: '//cdn.datatables.net/plug-ins/1.12.1/i18n/pt-BR.json'
            }
        });
    });
</script>
@endsection
