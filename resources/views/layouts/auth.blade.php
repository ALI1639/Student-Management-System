<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title')</title>


    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">


    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }


        body {

            min-height: 100vh;

            display: flex;

            justify-content: center;

            align-items: center;

            padding: 20px;

            overflow-x: hidden;

            background: linear-gradient(135deg, #667eea, #764ba2);

        }



        /* Background Animation */


        .circle {

            position: absolute;

            border-radius: 50%;

            background: rgba(255, 255, 255, .15);

            animation: float 8s infinite alternate;

        }


        .circle.one {

            width: 300px;

            height: 300px;

            top: -100px;

            left: -100px;

        }


        .circle.two {

            width: 250px;

            height: 250px;

            right: -80px;

            bottom: -80px;

        }



        @keyframes float {


            from {

                transform: translateY(0px);

            }


            to {

                transform: translateY(80px);

            }


        }




        .auth-card {


            width: 100%;

            max-width: 450px;

            background: #fff;

            padding: 35px;

            border-radius: 25px;

            position: relative;

            z-index: 1;

            box-shadow: 0 20px 50px rgba(0, 0, 0, .25);


            animation: cardShow .8s ease;


        }



        @keyframes cardShow {


            0% {

                opacity: 0;

                transform: translateY(80px) scale(.8);

            }


            100% {

                opacity: 1;

                transform: translateY(0) scale(1);

            }


        }





        .logo {


            width: 75px;

            height: 75px;

            background: #667eea;

            color: white;

            border-radius: 50%;

            display: flex;

            justify-content: center;

            align-items: center;

            font-size: 30px;

            margin: auto;


            animation: rotate 3s infinite linear;


        }




        @keyframes rotate {


            0% {

                transform: rotate(0deg);

            }


            100% {

                transform: rotate(360deg);

            }


        }





        .form-control,
        .form-select {


            height: 48px;

            border-radius: 12px;

            transition: .3s;


        }




        .form-control:focus,
        .form-select:focus {


            transform: translateY(-3px);

            box-shadow: 0 0 15px #667eea70;

        }




        .input-group-text {


            background: #667eea;

            color: white;

            border: none;

        }




        .btn {


            height: 48px;

            border-radius: 12px;

            font-weight: 600;

            transition: .3s;


        }



        .btn:hover {


            transform: translateY(-4px);

            box-shadow: 0 10px 20px rgba(0, 0, 0, .2);


        }




        /* Tablet */


        @media(max-width:768px) {


            .auth-card {

                max-width: 400px;

                padding: 30px;

            }


        }





        /* Mobile */


        @media(max-width:480px) {


            body {

                padding: 15px;

            }



            .auth-card {


                padding: 22px;

                border-radius: 18px;


            }



            .logo {

                width: 65px;

                height: 65px;

                font-size: 25px;

            }


            h2 {

                font-size: 22px;

            }



            .form-control,
            .form-select,
            .btn {


                height: 45px;


            }



        }
    </style>


</head>


<body>


    <div class="circle one"></div>

    <div class="circle two"></div>



    <div class="auth-card">


        @yield('content')


    </div>




    <script>
        document.getElementById('togglePassword').addEventListener('click', function() {

            let password = document.getElementById('password');
            let icon = this.querySelector('i');

            if (password.type === "password") {
                password.type = "text";

                icon.classList.remove("fa-eye");
                icon.classList.add("fa-eye-slash");
            } else {
                password.type = "password";

                icon.classList.remove("fa-eye-slash");
                icon.classList.add("fa-eye");
            }

        });



        document.getElementById('toggleConfirmPassword').addEventListener('click', function() {

            let password = document.getElementById('confirmPassword');
            let icon = this.querySelector('i');

            if (password.type === "password") {
                password.type = "text";

                icon.classList.remove("fa-eye");
                icon.classList.add("fa-eye-slash");
            } else {
                password.type = "password";

                icon.classList.remove("fa-eye-slash");
                icon.classList.add("fa-eye");
            }

        });
    </script>


</body>

</html>
