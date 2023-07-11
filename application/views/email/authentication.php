<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Authentication</title>

    <style>
    .content {
        width: 500px;
        margin: auto;
    }

    .artwork {
        width: 100%;
    }

    .par_1 {
        font-weight: bold;
        font-size: 20px;
        text-align: center;
    }

    .par_2 {
        text-align: center;
    }

    .par_3 {
        text-align: center;
    }

    .v_code {
        font-weight: bolder;
        font-size: 40px;
        /* background: #FF5B91; */
        padding: 10px;
        color: #e4000f;
        text-align: center;
    }
    </style>
</head>

<body>
    <div class="container">
        <div class="content">
            <!-- <div class="row">
                <div class="col-lg-12">
                    <img src="<?= base_url() ?>assets/img/authentication-email-artwork.png" alt="" class="artwork">
                </div>
            </div> -->
            <div class="row">
                <div class="col-lg-12 text-center">
                    <p class="par_1">Hi <?= $member_username ?>,</p>
                    <p class="par_2">Here is your unique login code to access your AVIA International Holders account:
                    </p>
                    <p>
                    <h3 class="v_code"><?= $auth_code ?></h3>
                    </p>
                </div>
            </div>
        </div>
    </div>

</body>

</html>