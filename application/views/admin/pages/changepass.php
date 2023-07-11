<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>cPass</title>
</head>

<body>
    <?php
        if($this->session->flashdata('success') == 'ok'){
            echo '<p>Successfully updated user\'s password<?p>';
        }else if($this->session->flashdata('success') == 'fail'){
            echo '<p>Failed to update user\'s password<?p>';

        }
            
    ?>

    <?php echo form_open('change_password');?>
    username: <input type="text" name="cpass_username"> <br>
    new pass: <input type="password" name="cpass_password"> <br>
    <button type="submit">Submit</button>
    </form>
</body>

</html>