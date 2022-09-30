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
    <div class="row">
        <div class="col-12">
            <form method="POST" action="{{route('store')}}">
                @csrf
                <div class="mb-3">
                    <label for="nome" class="form-label">Nome</label>
                    <input type="text" class="form-control" id="nome" name="nome" placeholder="Arroz">
                </div>
                <div class="mb-3">
                    <label for="local" class="form-label">local</label>
                    <input type="text" class="form-control" id="local" name="local" placeholder="A - 2">
                </div>
                <div class="mb-3">
                    <label for="barcode" class="form-label">Código de barras</label>
                    <input type="text" class="form-control" id="barcode" name="barcode">
                    <button type="button" class="btn btn-info mt-2" id="btn_barcode">Ler <i class="fa-solid fa-barcode"></i></button>
                    <div id="barcode-scanner" class="mt-2">
                        <video src="" playsinline autoplay></video>
                        <canvas class="drawingBuffer" id="drawingBuffer"></canvas>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="entrada" class="form-label">Entrada</label>
                    <input type="date" class="form-control" id="entrada" name="entrada">
                </div>
                <div class="mb-3">
                    <label for="validade" class="form-label">Validade</label>
                    <input type="date" class="form-control" id="validade" name="validade">
                </div>

                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
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
    <script>
        $("#barcode-scanner").hide();
        var _scannerIsRunning = false;
        function startScanner() {
            Quagga.init({
                inputStream: {
                    name: "Live",
                    type: "LiveStream",
                    target: document.querySelector('#barcode-scanner'),
                    constraints: {
                        width: { ideal: 4096 },
                        height: { ideal: 2160 },
                        facingMode: "environment"
                    },
                },
                decoder: {
                    readers: [
                        "code_128_reader",
                        "ean_reader",
                        "ean_8_reader",
                        "code_39_reader",
                        "code_39_vin_reader",
                        "codabar_reader",
                        "upc_reader",
                        "upc_e_reader",
                        "i2of5_reader"
                    ],
                },

            }, function (err) {
                if (err) {
                    console.log(err);
                    return
                }
                console.log("Initialization finished. Ready to start");
                Quagga.start();

                // Set flag to is running
                _scannerIsRunning = true;
            });

            Quagga.onDetected(function (result) {
                $("#barcode").val(result.codeResult.code.toString());
                stopScanner();
                console.log("Barcode detected and processed : [" + result.codeResult.code + "]", result);
            });
            $("#barcode-scanner").show();
            document.getElementById("drawingBuffer").scrollIntoView();
        }
        function stopScanner(){
            $("#barcode-scanner").hide();
            $("#barcode").focus();
            Quagga.stop();
            _scannerIsRunning = false;
        }



        // Start/stop scanner
        document.getElementById("btn_barcode").addEventListener("click", function () {
            if (_scannerIsRunning) {
                stopScanner();
            } else {
                startScanner();
            }
        }, false);
    </script>
@endsection
