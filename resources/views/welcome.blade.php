<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        {{-- <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css"> --}}
        <link rel="stylesheet" href="/css/bootstrap.css"/>

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Raleway', sans-serif;
                font-weight: 100;
                height: 100vh;
                margin: 0;
            }

            .list-group input {
                font-size: 18px;
            }
        </style>
    </head>
<body>
        
    <div class="container pb-5">

        <div class="logo">
            <img src="/uploads/spcf_logo.png" height="80" class="img mx-auto d-block img-circle" />
        </div>
        <hr>
        <h2 class="text-center">Visitors Access</h2>

        <div class="row">
            <div class="col-sm-6 mt-5" style="margin: auto;">
                <div id="cam-wrapper">
                    <div id="my_camera"></div>
                    <form>
                        <input type=button value="Take Snapshot" class="btn btn-lg btn-primary mt-1" onClick="take_snapshot()">
                    </form>
                </div>
                
                <div id="bot">
                    <div id="results"></div>
                    <div id="btnReset"></div>
                </div>
                
            </div>

            <div class="col-sm-6 mt-5">
                <hr>    
                <form action="visitor" method="POST">
                    {{ csrf_field() }}
                    <input id="image_file" type="hidden" name="image_file" value=""/>
                    <ul class="list-group">
                        <li class="list-group-item">
                                <label for="firstname" class=" col-form-label"><h3 class="mb-0"><strong>Firstname: </strong></h3></label>
                                <input type="text" name="firstname" class="form-control" placeholder="Enter your firstname" id="firstname" value="" required>
                        </li>
                        <li class="list-group-item">
                                <label for="lastname" class=" col-form-label"><h3 class="mb-0"><strong>Lastname: </strong></h3></label>
                                <input type="text" name="lastname"  class="form-control" placeholder="Enter your lastname" id="lastname" value="" required>
                        </li>
                        <li class="list-group-item">
                                <label for="dept" class=" col-form-label"><h3 class="mb-0"><strong>Department to visit: </strong></h3></label>
                                <select name="department_id" id="" class="form-control form-control-lg" required>
                                    <option value="" selected disabled>Select a department</option>
                                    <option value="1">CCIS</option>
                                    <option value="2">COB</option>
                                    <option value="3">CASS</option>
                                </select>
                                <!-- <input type="text" name="dept"  class="form-control-plaintext" id="dept" value="CCIS" disabled> -->
                        </li>
                        <li class="list-group-item">
                                <label for="rfid" class=" col-form-label"><h3 class="mb-0"><strong>RFID: </strong></h3></label>
                                <input type="text" name="rfid"  class="form-control" placeholder="Enter your RFID" id="rfid" value="" required>
                        </li>
                        <button class="btn btn-lg btn-primary" type="submit">Submit</button>
                    </ul>
                </form>
            </div>

        </div>
    </div>
    

<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript" src="js/bootstrap.js"></script>
<script type="text/javascript" src="js/webcam.min.js"></script>
<script language="JavaScript">
    Webcam.set({
        // live preview size
                width: 520,
                height: 440,
                
                // device capture size
                dest_width: 520,
                dest_height: 420,

                // format and quality
                image_format: 'jpeg',
                jpeg_quality: 90,
                
                // flip horizontal (mirror mode)
                // flip_horiz: true
    });
    Webcam.attach( '#my_camera' );
</script>




<script language="JavaScript">
    var shutter = new Audio();
        shutter.autoplay = false;
        shutter.src = navigator.userAgent.match(/Firefox/) ? 'shutter.ogg' : 'shutter.mp3';

    function take_snapshot() {
        try { shutter.currentTime = 0; } catch(e) {;} // fails in IE
            shutter.play();
        // document.getElementById('myform').submit();

        Webcam.snap( function(data_uri) {
            // display results in page
            // take snapshot and get image data
            var raw_image_data = data_uri.replace(/^data\:image\/\w+\;base64\,/, '');
            
            document.getElementById('image_file').value = raw_image_data;
            document.getElementById('results').innerHTML = 
                // '<h2>Here is your image:</h2>' + 
                '<img src="'+data_uri+'"/>';
                document.getElementById('btnReset').innerHTML = '<button onclick="reset()" class="btn btn-primary mt-2">Reset</button>';
                $('#cam-wrapper').css('display', 'none');
                $('#bot').css('display', 'block');
        } );
    }

    function reset () {
        $('#cam-wrapper').css('display', 'block');
        $('#bot').css('display', 'none');
    }
</script>

    </body>
</html>
