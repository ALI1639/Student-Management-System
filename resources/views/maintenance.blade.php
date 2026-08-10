<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">


    <title>
        Maintenance Mode
    </title>


    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">


    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">


</head>



<body class="bg-light">


    <div class="container">


        <div class="row justify-content-center">


            <div class="col-md-6">


                <div class="card shadow border-0 mt-5">


                    <div class="card-body text-center p-5">



                        <i class="fas fa-tools fa-4x text-warning mb-3"></i>



                        <h2>

                            Website Under Maintenance

                        </h2>



                        <p class="text-muted mt-3">

                            We are currently improving our system.
                            Please try again later.

                        </p>



                        @if (isset($setting) && $setting->site_name)
                            <h5 class="mt-4">

                                {{ $setting->site_name }}

                            </h5>
                        @endif



                    </div>


                </div>


            </div>


        </div>


    </div>


</body>

</html>
