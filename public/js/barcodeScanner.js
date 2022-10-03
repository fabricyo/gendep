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
