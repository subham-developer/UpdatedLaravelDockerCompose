<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Nimap Infotech</title>

    <!-- Font Icon -->
    <link rel="stylesheet" href="{{ asset('open/fonts/material-icon/css/material-design-iconic-font.min.css') }}">
    <link rel="stylesheet" href="{{ asset('open/vendor/nouislider/nouislider.min.css') }}">

    <!-- Main css -->
    <link rel="stylesheet" href="{{ asset('open/css/style.css') }}">
    <style type="text/css">
        h2{
            color: #000;
            font-weight: 600;
        }

        .signup-img{
            width: 440px;
        }

        .signup-img-content{
            top: 30%;
        }

        .logo{
            width: 150px;
            padding-bottom: 15px;
        }

        form{
            padding: 45px 5% !important;
        }

        #submit{
            background: #60baec !important;
        }

        input:focus{
            border: 1px solid #60baec !important;
        }

        input{
            padding: 10px 20px !important;
        }

        .container{
            width: 100% !important;
        }

        .register-div-scroll::-webkit-scrollbar
        {
            width: 5px;
            background-color: #F5F5F5;
        }

        .register-div-scroll::-webkit-scrollbar-thumb
        {
            border-radius: 10px;
            -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,.3);
            background-color: #555;
        }

        body{
            padding: 0px !important;
        }

        .captcha-style input{
            display: inline;
            width: 50%;
        }

        .captcha-style img{
            margin: -12px 15px;
        }
    </style>
</head>
<body>

    <div class="main">

        <div class="container">
            <div class="signup-content">
                <div class="signup-img">
                    <img src="{{ asset('open/images/form-img.png') }}" class="left-side-image" alt="">
                    <div class="signup-img-content">
                        <img src="http://127.0.0.1:8000/docs/logo.png" class="logo">
                        <h2>Client Register Form</h2>
                        <!-- <p>while seats are available !</p> -->
                    </div>
                </div>
                <div class="signup-form register-div-scroll" style="overflow: auto;">
                    <form onsubmit="return false" id="registerFrom">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">

                        <div class="form-row">
                            <div class="form-group">
                                <div class="form-input">
                                    <label for="chequeno">Company Name</label>
                                    <input type="text" id="chequeno" name="company_name" isrequired="required|maxlength:50"/>
                                </div>
                                <div class="form-input">
                                    <label for="chequeno">Finance Email</label>
                                    <input type="text" id="chequeno" name="finance_email" isrequired="required|email|maxlength:50"/>
                                </div>
                                <div class="form-input">
                                    <label for="chequeno">Billing Address</label>
                                    <input type="text" id="chequeno" name="address" isrequired="required|maxlength:250"/>
                                </div>
                                <div class="form-input">
                                    <label for="chequeno">PAN Number</label>
                                    <input type="text" id="chequeno" name="pan" isrequired="required|pan"/>
                                </div>
                                <div class="form-input captcha-style">
                                    <label for="chequeno">Captcha</label>
                                    <input type="text" id="chequeno" name="captcha" isrequired="required|maxlength:5" />
                                    {!! captcha_img() !!}
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="form-input">
                                    <label for="chequeno">Finance Name</label>
                                    <input type="text" id="chequeno" name="finance_name" isrequired="required|maxlength:50"/>
                                </div>
                                <div class="form-input">
                                    <label for="chequeno">Finance Contact Number</label>
                                    <input type="text" id="chequeno" name="finance_contact_number" isrequired="required|phone"/>
                                </div>
                                <div class="form-input">
                                    <label for="chequeno">TAN Number</label>
                                    <input type="text" id="chequeno" name="tan" isrequired="required|maxlength:20"/>
                                </div>
                                <div class="form-input">
                                    <label for="chequeno">GST Number</label>
                                    <input type="text" id="chequeno" name="gst" isrequired="required|gst"/>
                                </div>
                                <div class="form-input">
                                    
                                </div>
                            </div>
                        </div>
                        <div class="form-submit">
                            <!-- <p id="ErrorId" style="color: red"><strong></strong></p> -->

                            <input type="button" value="Submit" class="submit" id="submit" name="submit" onclick="submitForm(this, 'registerFrom', '{{ route('submit-register') }}', 'afterAddForm')"/>
                            <!-- <input type="submit" value="Reset" class="submit" id="reset" name="reset" /> -->
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>

    <!-- JS -->
    <script src="{{ asset('open/vendor/jquery/jquery.min.js')}}"></script>
    <script src="{{ asset('open/vendor/nouislider/nouislider.min.js') }}"></script>
    <script src="{{ asset('open/vendor/wnumb/wNumb.js') }}"></script>
    <script src="{{ asset('open/vendor/jquery-validation/dist/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('open/vendor/jquery-validation/dist/additional-methods.min.js') }}"></script>
    <script src="{{ asset('open/js/main.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/submitForm.js')}}"></script>
    <script type="text/javascript">
        function afterAddForm(jsonData){
            alert(jsonData.message);
            location.reload();
        }
    </script>

    <script type="text/javascript">

        $(window).ready(function(){
            imageResize();
        });

        $(window).resize(function(){
            imageResize();
        });
        function imageResize(){
            let windowHeight = $(window).height();
            let height = $(".left-side-image").height();

            console.log(windowHeight);
            console.log(height);

            if((windowHeight < height) && windowHeight > 0 && height > 0){
                $(".signup-img").css('height',windowHeight+'px');
                $(".signup-form").css('height',windowHeight+'px');
                $(".signup-content").css('height',windowHeight+'px');
            }
            else if(windowHeight > 0 && height > 0){
                $(".signup-img").css('height',height+'px');
                $(".signup-form").css('height',height+'px');
                $(".signup-content").css('height',height+'px');
            }
        }
    </script>
</body>
</html>