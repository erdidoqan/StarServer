
@extends('home.layouts.master')
@section('content')
    <script src="{{asset('assets/js/StarWebPrintBuilder.js')}}"></script>
    <script src="{{asset('assets/js/StarWebPrintTrader.js')}}"></script>

    <script type='text/javascript'>
        <!--
        var cursor         = 0;
        var lineSpace      = 0;
        var leftPosition   = 0;
        var centerPosition = 0;
        var rightPosition  = 0;

        function DrawLeftText(text) {
            var canvas = document.getElementById('canvasPaper');

            if (canvas.getContext) {
                var context = canvas.getContext('2d');

                context.textAlign = 'left';

                context.fillText(text, leftPosition, cursor);

                context.textAlign = 'start';
            }
        }

        function DrawCenterText(text) {
            var canvas = document.getElementById('canvasPaper');

            if (canvas.getContext) {
                var context = canvas.getContext('2d');

                context.textAlign = 'center';

                context.fillText(text, centerPosition, cursor);

                context.textAlign = 'start';
            }
        }

        function DrawRightText(text) {

            var canvas = document.getElementById('canvasPaper');

            if (canvas.getContext) {
                var context = canvas.getContext('2d');

                context.textAlign = 'right';

                context.fillText(text, rightPosition, cursor);

                context.textAlign = 'start';
            }
        }

        function DrawBottomText(text) {
            var canvas = document.getElementById('canvasPaper');

            if (canvas.getContext) {
                var context = canvas.getContext('2d');

                context.textAlign = 'bottom';

                context.fillText(text, rightPosition, cursor);

                context.textAlign = 'start';
            }
        }

        function onDrawReceipt() {
            switch (document.getElementById('paperWidth').value) {
                case 'inch2' :
                    drawReceipt(28, 28, 384, 1);
                    break;
                case 'inch3DotImpact' :
                    drawReceipt(32, 12, 576, 1.5);
                    break;
                default :
                    drawReceipt(30, 32, 776, 2.5);
                    break;
                case 'inch4' :
                    drawReceipt(48, 48, 832, 2);
                    break;
            }
        }

        Number.prototype.formatMoney = function(c, d, t){
            var n = this,
                    c = isNaN(c = Math.abs(c)) ? 2 : c,
                    d = d == undefined ? "." : d,
                    t = t == undefined ? "," : t,
                    s = n < 0 ? "-" : "",
                    i = parseInt(n = Math.abs(+n || 0).toFixed(c)) + "",
                    j = (j = i.length) > 3 ? j % 3 : 0;
            return s + (j ? i.substr(0, j) + t : "") + i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + t) + (c ? d + Math.abs(n - i).toFixed(c).slice(2) : "");
        };

        function drawReceipt(fontSize, lineSpace, receiptWidth, logoScale) {
            var canvas = document.getElementById('canvasPaper');

            if (canvas.getContext) {
                var context = canvas.getContext('2d');

                context.clearRect(0, 0, canvas.width, canvas.height);

//      context.textAlign    = 'start';
                context.textBaseline = 'top';

                var font = '';

                font += fontSize + 'px ';

                font += document.getElementById('font').value;

                context.font = font;

                leftPosition   =  0;
//      centerPosition =  canvas.width       / 2;
                centerPosition = (canvas.width - 16) / 2;
//      rightPosition  =  canvas.width;
                rightPosition  = (canvas.width - 16);

//      cursor = 0;
                cursor = 120 * logoScale; // ロゴが入るスペースを空けておく
                DrawCenterText("Ground Floor Block A Trinity Square"); cursor += lineSpace;
                DrawCenterText("127 Brighton Road"); cursor += lineSpace;
                DrawCenterText("CR5 2NJ"); cursor += lineSpace;
                DrawCenterText("VAT NO: 627 0767 30"); cursor += lineSpace;
                cursor += lineSpace;
                DrawLeftText('SERKAN {{$date}}');DrawRightText('T64715F11');
                cursor += lineSpace;
                DrawLeftText('Till No: 3');
                cursor += lineSpace;
                DrawLeftText('Table: {{$table}} Covers: 1');
                cursor += lineSpace;
                cursor += lineSpace;
                @foreach($allBasket as $basket)

                    @if($basket->promotion)
                        var price = ({{ $basket->price }}).formatMoney(2);
                        DrawLeftText('{{$basket->count}} {{$basket->menu_name}}');    DrawRightText(price + 'P');  cursor += lineSpace;
                    @else
                        var price = ({{ $basket->price }}).formatMoney(2);
                        DrawLeftText('{{$basket->count}} {{$basket->menu_name}}');    DrawRightText(price);  cursor += lineSpace;
                    @endif
                @endforeach


                cursor += lineSpace;

                @if($subTotal)
                    DrawCenterText('Sub-Total');      DrawRightText({{ $subTotal }});  cursor += lineSpace;
                @endif

                @if($promotion)
                    DrawCenterText('Discount/Promotions');      DrawRightText({{ $promotion }});  cursor += lineSpace;
                    cursor += lineSpace;
                @endif


                //context.fillRect(0, cursor - 2, receiptWidth, 2);     // Underline
                var total = ({{ $total }}).formatMoney(2);

                DrawCenterText('TOTAL');    DrawRightText(total); cursor += lineSpace;
                cursor += lineSpace;
                DrawCenterText('TO PAY');    DrawRightText({!! $toPay !!}); cursor += lineSpace;

                cursor += lineSpace;


//      alert('Cursor:' + cursor + ', ' + 'Canvas:' + canvas.height);
                DrawCenterText('"Service charge not included"'); cursor += lineSpace;
                DrawCenterText('For a chance to win a £500 Gift Card'); cursor += lineSpace;
                DrawCenterText('in our Monthly Prize Draw please go to'); cursor += lineSpace;
                DrawCenterText('www.mypizzaexpress.com to tell us about'); cursor += lineSpace;
                DrawCenterText('your visit. Your invite code is: 3426'); cursor += lineSpace;
                DrawCenterText('-------------------------------------');cursor += lineSpace;

                var image = new Image();

                image.src = 'assets/img/logo.png' + '?' + new Date().getTime();

                image.onload = function () {
                    context.drawImage(image, 450 - image.width * logoScale, 0, image.width * logoScale, image.height * logoScale);
                }

                image.onerror = function () {
                    alert('Image file was not able to be loaded.');
                }
            }
        }

        function onResizeCanvas() {
            var canvas = document.getElementById('canvasPaper');

            if (canvas.getContext) {
                var context = canvas.getContext('2d');

                switch (document.getElementById('paperWidth').value) {
                    case 'inch2' :
                        canvas.width = 384;
                        canvas.height = 555;
                        break;
                    case 'inch3DotImpact' :
                        canvas.width = 576;
                        canvas.height = 840;
                        break;
                    default :
                        canvas.width = 576;
                        canvas.height = 1200;
                        break;
                    case 'inch4' :
                        canvas.width = 832;
                        canvas.height = 952;
                        break;
                }
                document.getElementById('canvasPaper').style.width="350px";
                onDrawReceipt();
            }
        }

        function refocusFontSelectbox() {
            var fontSelectbox = document.getElementById('font');
            fontSelectbox.blur();
            fontSelectbox.focus();
        }

        function refocusWidthSelectbox() {
            var paperWidthSelectbox = document.getElementById('paperWidth');
            paperWidthSelectbox.blur();
            paperWidthSelectbox.focus();
        }

        function onSendMessage() {
            nowPrinting();
            var url              = document.getElementById('url').value;
            var papertype        = document.getElementById('papertype').value;
            var blackmark_sensor = document.getElementById('blackmark_sensor').value;

            var trader = new StarWebPrintTrader({url:url, papertype:papertype, blackmark_sensor:blackmark_sensor});

            trader.onReceive = function (response) {
                var msg = '- onReceive -\n\n';

                msg += 'TraderSuccess : [ ' + response.traderSuccess + ' ]\n';

//      msg += 'TraderCode : [ ' + response.traderCode + ' ]\n';

                msg += 'TraderStatus : [ ' + response.traderStatus + ',\n';

                if (trader.isCoverOpen            ({traderStatus:response.traderStatus})) {msg += '\tCoverOpen,\n';}
                if (trader.isOffLine              ({traderStatus:response.traderStatus})) {msg += '\tOffLine,\n';}
                if (trader.isCompulsionSwitchClose({traderStatus:response.traderStatus})) {msg += '\tCompulsionSwitchClose,\n';}
                if (trader.isEtbCommandExecute    ({traderStatus:response.traderStatus})) {msg += '\tEtbCommandExecute,\n';}
                if (trader.isHighTemperatureStop  ({traderStatus:response.traderStatus})) {msg += '\tHighTemperatureStop,\n';}
                if (trader.isNonRecoverableError  ({traderStatus:response.traderStatus})) {msg += '\tNonRecoverableError,\n';}
                if (trader.isAutoCutterError      ({traderStatus:response.traderStatus})) {msg += '\tAutoCutterError,\n';}
                if (trader.isBlackMarkError       ({traderStatus:response.traderStatus})) {msg += '\tBlackMarkError,\n';}
                if (trader.isPaperEnd             ({traderStatus:response.traderStatus})) {msg += '\tPaperEnd,\n';}
                if (trader.isPaperNearEnd         ({traderStatus:response.traderStatus})) {msg += '\tPaperNearEnd,\n';}

                msg += '\tEtbCounter = ' + trader.extractionEtbCounter({traderStatus:response.traderStatus}).toString() + ' ]\n';

//      msg += 'Status : [ ' + response.status + ' ]\n';
//
//      msg += 'ResponseText : [ ' + response.responseText + ' ]\n';


                alert('Your bill is printed');
                window.location.replace("/basket/bosalt");
            }

            trader.onError = function (response) {
                var msg = '- onError -\n\n';

                msg += '\tStatus:' + response.status + '\n';

                msg += '\tResponseText:' + response.responseText;

                alert(msg);
            }

            try {
                var canvas = document.getElementById('canvasPaper');

                if (canvas.getContext) {
                    var context = canvas.getContext('2d');

                    var builder = new StarWebPrintBuilder();

                    var request = '';

                    request += builder.createInitializationElement();

                    request += builder.createBitImageElement({context:context, x:0, y:0, width:canvas.width, height:canvas.height});

                    request += builder.createCutPaperElement({feed:true});

                    trader.sendMessage({request:request});
                }
            }
            catch (e) {
                alert(e.message);
            }
        }
        function nowLoading(){
            document.getElementById('form').style.display="block";
            document.getElementById('overlay').style.display="none";
            document.getElementById('nowLoadingWrapper').style.display="none";
        }
        function nowPrinting(){
            document.getElementById('overlay').style.display="block";
            document.getElementById('nowPrintingWrapper').style.display="table";
            timer = setTimeout(function (){
                document.getElementById('overlay').style.opacity= 0.0;
                document.getElementById('overlay').style.transition= "all 0.3s";
                intimer = setTimeout(function (){
                    document.getElementById('overlay').style.display="none";
                    document.getElementById('overlay').style.opacity= 1;
                    clearTimeout(intimer);
                }, 300);
                document.getElementById('nowPrintingWrapper').style.display="none";
                clearTimeout(timer);
            }, 11000);
        }
        window.onload = function() {
            nowLoading();
            onResizeCanvas();
        }
        // -->
    </script>
    <style>
        #foooter {
            width: 600px;
            height: 46px;
            border-radius: 10px 10px 0px 0px;
            text-align: center;
            padding: 0;
            position: fixed;
            bottom: 0;
            left: 50%;
            margin-left: -300px;
        }
    </style>

    <div id="overlay">
        <div id="nowPrintingWrapper">
            <section id="nowPrinting">
                <h1>Now Printing</h1>
                <p><img src="assets/images/icon_loading.gif" /></p>
            </section>
        </div>
        <div id="nowLoadingWrapper">
            <section id="nowLoading">
                <h1>Now Loading</h1>
                <p><img src="assets/images/icon_loading.gif" /></p>
            </section>
        </div>
    </div>

    <form onsubmit='return false;' id="form">
        <div class="container">
            <div class="wrapper">
                <div id="canvasBlock">
                    <div id='canvasFrame'>
                        <canvas id='canvasPaper' width='576' height='640'>
                            Your browser does not support Canvas!
                        </canvas>
                    </div>
                </div>
            </div>
            <div id="optionBlock" style="display: none;">
                <dl>
                    <dt>Font</dt>
                    <dd>:
                        <select id='font' onchange='onDrawReceipt(); refocusFontSelectbox();'>
                            <option>Arial</option>
                            <option>Cambria</option>
                            <option>Comic Sans MS</option>
                            <option>Constantia</option>
                            <option>Gabriola</option>
                            <option>Georgia</option>
                            <option>Segoe UI</option>
                            <option>Fixedsys</option>
                            <option>MS Serif</option>
                            <option>Lato</option>
                            <option>Roboto</option>
                            <option selected='selected'>RawengulkLight</option>
                        </select>
                    </dd>
                </dl>
                <dl>
                    <dt>Paper Width</dt>
                    <dd>:
                        <select id='paperWidth' onchange='onResizeCanvas(); refocusWidthSelectbox();'>
                            <option value='inch2'>2 Inch</option>
                            <option value='inch3'selected='selected'>3 Inch</option>
                            <option value='inch4'>4 Inch</option>
                        </select>
                    </dd>
                </dl>
            </div>
            <footer style="display: none;">
                <dl style="display: none;">
                    <dt>URL</dt>
                    <dd>:
                        <input id="url" type="text" value="http://localhost:8001/StarWebPRNT/SendMessage" /></dd>
                </dl>
                <d1>
                    <dt>Paper Type</dt>
                    <dd>:
                        <select id='papertype'>
                            <option value='' selected='selected'>-</option>
                            <option value='normal'>Normal</option>
                            <option value='black_mark'>Black Mark</option>
                            <option value='black_mark_and_detect_at_power_on'>Black Mark and Detect at Power On</option>
                        </select>
                    </dd>
                    </dl>
                    <d1>
                        <dt>Black Mark Sensor</dt>
                        <dd>:
                            <select id='blackmark_sensor'>
                                <option value='front_side' selected='selected'>Front side</option>
                                <option value='back_side'>Back side</option>
                                <option value='hole_or_gap'>Hole or Gap</option>
                            </select>
                        </dd>
                    </d1>

            </footer>
            <div class="col-sm-5" id="foooter">
                <input id="sendBtn" class="btn btn-primary btn-block btn-lg" type="button" value="Print" onclick="onSendMessage()" />
            </div>

        </div>
    </form>

@endsection