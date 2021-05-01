<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Home - Entry UI</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,700,300italic,400italic,700italic">
</head>

<body id="page-top">
    <div style="margin-top: 40px;">
    <header style="background-image:url('');">
        <div class="container my-auto text-center" >
            <h1 class="mb-1" style="font-size: 4rem; margin-left: 27px;">Enter PIN Number</h1>
            <form action="open.php" method="POST">
            <div class="btn-group-vertical ml-4 mt-4" role="group">
                <div class="btn-group">
                    <input class="text-center form-control-lg mb-2" name="code" id="code">
                </div>
                <div class="btn-group">
                    <button type="button" class="btn btn-outline-primary py-3 px-3" onclick="document.getElementById('code').value=document.getElementById('code').value + '1';">1</button>
                    <button type="button" class="btn btn-outline-primary py-3 px-3" onclick="document.getElementById('code').value=document.getElementById('code').value + '2';">2</button>
                    <button type="button" class="btn btn-outline-primary py-3 px-3" onclick="document.getElementById('code').value=document.getElementById('code').value + '3';">3</button>
                </div>
                <div class="btn-group">
                    <button type="button" class="btn btn-outline-primary py-3 px-4" onclick="document.getElementById('code').value=document.getElementById('code').value + '4';">4</button>
                    <button type="button" class="btn btn-outline-primary py-3 px-4" onclick="document.getElementById('code').value=document.getElementById('code').value + '5';">5</button>
                    <button type="button" class="btn btn-outline-primary py-3 px-4" onclick="document.getElementById('code').value=document.getElementById('code').value + '6';">6</button>
                </div>
                <div class="btn-group">
                    <button type="button" class="btn btn-outline-primary py-3 px-4" onclick="document.getElementById('code').value=document.getElementById('code').value + '7';">7</button>
                    <button type="button" class="btn btn-outline-primary py-3 px-4" onclick="document.getElementById('code').value=document.getElementById('code').value + '8';">8</button>
                    <button type="button" class="btn btn-outline-primary py-3 px-4" onclick="document.getElementById('code').value=document.getElementById('code').value + '9';">9</button>
                </div>
                <div class="btn-group">
                    <button type="button" class="btn btn-danger py-3 px-4" onclick="document.getElementById('code').value=document.getElementById('code').value.slice(0,0);">✖</button>
                    <button type="button" class="btn btn btn-outline-primary py-3 px-4" onclick="document.getElementById('code').value=document.getElementById('code').value + '0';">0</button>
                    <button type="submit" class="btn btn-success py-3 px-4" id="submit">✔</button>
                </div>
            </div>
               </form> 
            <p class="mb-5" id="label" style="margin-left: 27px; padding-top: 13px; display: none;"><strong>Please bring QR code up to the scanner.</strong></p>
            <button class="btn btn-primary btn-xl js-scroll-trigger" id="qr" style="margin-left: 27px; margin-top: 15px;" role="button" onclick="qr();">QR Code</button>
            <div class="watermark" style="margin-left: 27px; margin-top: 15px; color: LightGray; font-size: 12px;">Team: <br> Jacob Highbridge <br> Brandon Boukzam, Christian Cruz <br> Yingqi Feng, Tony You</div>
        </div>
    </header>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.min.js"></script>
    <script src="assets/js/script.min.js"></script>

    <script>
        var form = document.getElementById("code");
        var qrButton = document.getElementById("qr");
        var label = document.getElementById("label");

        function qr() {
            qrButton.disabled = true;
            label.style.display = "block";
            qrButton.style.marginTop = "-18px";

            setTimeout(() => {
                qrButton.disabled = false; 
                label.style.display = "none"; 
                qrButton.style.marginTop = "15px";
            }, 10000);

        }

        </script>
</body>
</html>
