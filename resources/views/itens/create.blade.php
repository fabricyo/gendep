@extends('layouts.master')

@section('content')
    @if($errors->any())
        <div class="row">
            <div class="col-12">
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Erro</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{$error}}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    @endif
    <div class="container-fluid">
        <form method="POST" action="{{route('store')}}" class="row">
            @csrf
            <div class="col-12 col-md-6 mb-3">
                <label for="nome" class="form-label">Nome</label>
                <input type="text" class="form-control" id="nome" name="nome" placeholder="Arroz" required>
            </div>
            <div class="col-12 col-md-6 mb-3">
                <label for="qtd" class="form-label">Quantidade</label>
                <input type="number" pattern="[0-9]*" inputmode="numeric" class="form-control" id="qtd" name="qtd" placeholder="23" required>
            </div>
            <div class="col-12 col-md-6 mb-3">
                <label for="marca" class="form-label">Marca</label>
                <input type="text" class="form-control" id="marca" name="marca" placeholder="Tio João" required>
            </div>
            <div class="col-12 col-md-6 mb-3">
                <label for="categoria" class="form-label">Categoria</label>
                <input type="text" class="form-control" id="categoria" name="categoria" placeholder="Alimentação" required>
            </div>
            <div class="col-12 col-md-6 mb-3">
                <label for="local" class="form-label">Local</label>
                <input type="text" class="form-control" id="local" name="local" placeholder="A - 2">
            </div>
            <div class="col-12 col-md-8 mb-3 mx-auto">
                <label for="barcode" class="form-label">Código de barras</label>
                <input type="number" class="form-control" id="barcode" name="barcode">
                <button type="button" class="btn btn-info mt-2" id="btn_barcode">Ler <i class="fa-solid fa-barcode"></i></button>
                <div id="barcode-scanner" class="mt-2">
                    <video src="" playsinline autoplay></video>
                    <canvas class="drawingBuffer" id="drawingBuffer"></canvas>
                </div>
            </div>
            <div class="col-12 col-md-6 mb-3">
                <label for="entrada" class="form-label">Entrada</label>
                <input type="datetime-local" class="form-control" id="entrada" name="entrada" value="{{date('Y-m-d H:i')}}" required>
            </div>
            <div class="col-12 col-md-6 mb-3">
                <label for="validade" class="form-label">Validade</label>
                <input type="date" class="form-control" id="validade" name="validade" required>
            </div>

            <div class="col-12 text-center mt-3">
                <button type="submit" class="btn btn-success">Salvar <i class="fa-solid fa-plus"></i></button>
            </div>
        </form>
    </div>
    <style>
        #barcode-scanner video, canvas {
            width: 100%;
            height: 30rem;
        }

        #barcode-scanner video.drawingBuffer, canvas.drawingBuffer {
            display: none;
        }
    </style>
@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/@ericblade/quagga2/dist/quagga.js"></script>
    <script src="{{url('js/barcodeScanner.js')}}"></script>
@endsection
