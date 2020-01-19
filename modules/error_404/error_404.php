<!DOCTYPE html>
    <html>
    <head>
        <title>Sorry, page not found</title>
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

        <!-- Optional theme -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        
        <!-- Latest compiled and minified JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    </head>

    <style>
        body{
            background-color: #f4f6f8;
        }
        .text-middle{
            top: 45%;
        }

        .error{
            font-size: 150px;
            color: #1A237E;
            /*color: #00695C;*/
            padding: 0px;
            margin: 0px;
            border: 0px;
        }

        .error-msg{
            padding-top: 0px;
            padding-bottom: 10px;
            color: #2e6da4;
        }

        .btn-home{
            color: #1A237E;
            font-weight: bold;
            border-radius: 50px;
            border: 2px solid #1A237E;
            padding: 10px 30px 10px 30px;
        }

        .btn-home:hover{
            background-color: #eee;
            color: #1a237e ;
        }
        @media (max-width: 1600px) {
            .container-fluid{
                padding-left: 10px;
                padding-right: 10px;
            }
            p,h1,h2,h3,h4,h5,h6{
                padding-left: 15px;
                padding-right: 15px;
            }
            td{
                display:block;
            }
        }
    </style>

    <body>
    <div class="container-fluid" style="margin-top: 100px;">
        <div class="text-middle text-center">
            <h1 class="error hide">404</h1>
            <img src="<?php echo BASE; ?>/files/images/404.png" style="max-width: 100%;">
            <div class="error-msg">
                <h2 style="font-size: 22px;">The link you clicked may be broken or the page may have been removed.</h2>
                <p>PLEASE GO BACK TO HOME PAGE OR CONTACT US FOR REPORTING THE ISSUE</p>
            </div>
            <a class="btn btn-home" href="<?php echo $full_home_url; ?>">Home page</a>
        </div>
    </div>
    </body>
    </html>