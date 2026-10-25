<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Scan QR Code Absensi</title>
    <script src="https://unpkg.com/html5-qrcode"></script>
    <style>
        body { font-family: Arial, sans-serif; text-align: center; background: #f4f6f9; padding: 20px; }
        #reader { width: 300px; margin: 20px auto; background: white; padding: 10px; border-radius: 8px; }
    </style>
</head>
<body>
    <h2>Absensi Kelas QR Code</h2>

    @if(session('success'))
        <p style="color: green; font-weight: bold;">{{ session('success') }}</p>
    @endif

    @if(session('error'))
        <p style="color: red; font-weight: bold;">{{ session('error') }}</p>
    @endif

    <div id="reader"></div>

    <form id="attendance-form" action="{{ route('scan.store') }}" method="POST">
        @csrf
        <input type="hidden" name="qr_code" id="qr_code_input">
    </form>

    <script>
        function onScanSuccess(decodedText) {
            document.getElementById('qr_code_input').value = decodedText;
            document.getElementById('attendance-form').submit();
        }

        let html5QrcodeScanner = new Html5QrcodeScanner("reader", { fps: 10, qrbox: 250 });
        html5QrcodeScanner.render(onScanSuccess);
    </script>
</body>
</html>