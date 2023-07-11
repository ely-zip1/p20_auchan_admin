<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Latest compiled and minified CSS -->
    <title>Welcome</title>

    <style>
    body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        text-align: center !important;
    }

    .content {
        width: 500px;
        margin: auto;
        /* background: #c63c96; */
        padding-bottom: 20px;
    }

    .artwork {
        width: 100%;
    }

    .content-row {
        padding: 20px;
    }

    .welcome {
        color: black !important;
        font-weight: bolder;
        text-align: center;
        font-size: 70px;
        line-height: 0px;
    }

    .thanks {
        color: white;
        font-size: 20px;
        font-weight: bold;
        text-align: center;
        /* line-height: 0px; */
    }

    .name {
        color: black;
        font-weight: bold;
        text-align: center;
        font-size: 30px;
        /* line-height: 0px; */
    }

    .par_2 {
        color: white;
        text-align: center;
    }

    .area-v-code {
        background-color: #000;
        /* width: 300px; */
        color: white;
        padding: 10px;
        height: 130px;
    }

    .v_code {
        font-weight: bolder;
        font-size: 40px;
        margin-top: 20px;
        color: #fff;
        text-align: center;
    }
    </style>
</head>

<body>
    <div class="container">
        <div class="content">
            <!-- <div class="col-lg-12">
                <img src="<?= base_url() ?>assets/img/email-welcome-header-small.png" alt="" class="artwork">
            </div> -->
            <div class="content-row">
                <div class="col-lg-12">
                    <p class="welcome">WELCOME</p>
                    <p class="thanks">THANKS FOR SIGNING UP</p>

                    <p class="name"><?= $member_name ?>,</p>

                    <p class="par_2">
                        Having you means a lot to us. <br>
                        We hope you'll make the best use of your <br>
                        skills and knowledge and make sure <br>
                        something great is achieved!
                    </p>

                    <div class="area-v-code">
                        <p class="par_2">
                            Here is your verification code. <br>
                            Please do not share this with anyone.
                            <br>
                            <span class="v_code"><?= $verification_code ?></span>

                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>

</html>