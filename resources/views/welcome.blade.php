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

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 40px;

            }

            .title > b {
                font-weight: bold;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 12px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body>
        {{-- {{ $data["info"] }} --}}
        <div class="container-fluid">
            <div class="row full-height flex-center">
                <div class="col-md-6 text-center">
                    {
                        {{-- @foreach($message as $msg)
                            {{ $msg->message }}
                        @endforeach --}}
                            <div class="logo">
                                <img src="/uploads/spcf_logo.png" class="img img-circle" />
                            </div>
                            <div class="title">
                                <b>RFID</b>System
                            </div>

                            <form action="/" method="POST">
                                {{ csrf_field() }}

                                <input type="password" class="form-control" name="rfid" required autofocus maxlength="10" />
                                {{-- <input type="submit" value="Enter" class="btn btn-primary" /> --}}
                            </form>
                       
                </div>

                {{-- Information --}}
                <div class="col-md-6">
                   
                    <div class="row">
                   
                        <div class="col-md-12 col-md-offset-1">
                            <center>
                            <div class="title" style="font-size: 20px;">
                                
                                {{-- <b>Last Entry: {{ $lastentry }}</b> --}}
                                
                            </div>
                            @foreach($member as $row)
                            <div class="card" style="width: 20rem;">
                              <img class="card-img-top" src="{{ $row->image }}" alt="{{ $row->image}}">
                              {{-- <p>{{ $row->image }}</p> --}}
                              <div class="card-block">
                                <h4 class="card-title text-center"><b>{{ $row->firstname . ' ' . $row->lastname }}</b></h4>
                                <p class="card-text">
                                    <table class="table table-striped">
                                        <tbody>
                                            <tr>
                                                <td>Year</td>
                                                <td><b>{{ $row->year }}</b></td>
                                            </tr>
                                            <tr>
                                                <td>Section</td>
                                                <td>{{ $row->section }}</td>
                                            </tr>
                                            <tr>
                                                <td>Department</td>
                                                <td>{{ $row->department->description }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </p>
                              </div>
                            </div>
                            @endforeach  
                            </center> 
                        </div>
                      
                    </div>
                           
                </div> 
            </div>
        </div>
        <script type="text/javascript" src="js/bootstrap.js"></script>
        <script>
            
        </script>
    </body>
</html>
