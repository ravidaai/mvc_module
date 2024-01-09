<html>
<head>
    <title>Invoice</title>

    <style>
        table td, table th {
            padding: 0 10px; /* 'cellpadding' equivalent */
        }

        table {
            width: 100%;
            border-collapse: collapse !important;
            border-spacing: 0px;
            border: none;
        }

        table.border_less {
            border: none;
        }

        table.with_border {
            border: solid 1px #CCC;
        }

        td, th {
            height: 35px;
            min-height: 100px;
            border-spacing: 0px;
        }

        h2 {
            padding: 5px;
            margin: 0;
            font-size: 17px;
        }

        h1 {
            padding: 5px;
            margin: 0;
            font-size: 20px;
        }
    </style>
</head>

<body>

<table style="border:none;">
    <tbody>
    <tr>
        <td colspan="2">

            <img src="<?php echo site_url('assets/site/img/logo.png') ?>" alt="logo" class="img-responsive"
                 style="padding: 10px;">

            <!--            <img src="http://ukesh.com/globcons/assets/site/img/logo.png" alt="logo" class="img-responsive" style="padding: 10px;">-->
        </td>
        <td colspan="3" style="text-align: right; font-family: 'Open Sans', sans-serif;">

            <h1>Globcons</h1>
            <p style="padding: 0 10px;">
                66 Phoenix House, London, United Kingdom<br>
                <a href="mailto: info@globcons.com">info@globcons.com</a>
            </p>

        </td>
    </tr>


    <tr>
        <td colspan="5">
            <p>
                &nbsp;
            </p>


        </td>
    </tr>


    </tbody>
</table>

<table class="with_border">


    <tbody>

    <tr>
        <td style="padding: 10px;border: solid 1px #CCC;font-family: 'Open Sans', sans-serif;"><strong>Student
                ID</strong></td>
        <td style="padding: 10px;border: solid 1px #CCC;font-family: 'Open Sans', sans-serif;"><?php echo $user_id; ?></td>
    </tr>

    <tr>
        <td style="padding: 10px;border: solid 1px #CCC;font-family: 'Open Sans', sans-serif;"><strong>Name</strong>
        </td>
        <td style="padding: 10px;border: solid 1px #CCC;font-family: 'Open Sans', sans-serif;"><?php echo $full_name; ?></td>

    </tr>

    <tr>
        <td style="padding: 10px;border: solid 1px #CCC;font-family: 'Open Sans', sans-serif;"><strong>Email</strong>
        </td>
        <td style="padding: 10px;border: solid 1px #CCC;font-family: 'Open Sans', sans-serif;"><?php echo $email; ?></td>
    </tr>

    <tr>
        <td style="padding: 10px;border: solid 1px #CCC;font-family: 'Open Sans', sans-serif;"><strong>Phone</strong>
        </td>
        <td style="padding: 10px;border: solid 1px #CCC;font-family: 'Open Sans', sans-serif;"><?php echo $phone; ?></td>
    </tr>
    <tr>
        <td style="padding: 10px;border: solid 1px #CCC;font-family: 'Open Sans', sans-serif;"><strong>Country</strong>
        </td>
        <td style="padding: 10px;border: solid 1px #CCC;font-family: 'Open Sans', sans-serif;"><?php echo $country; ?></td>
    </tr>
    <tr>
        <td style="padding: 10px;border: solid 1px #CCC;font-family: 'Open Sans', sans-serif;"><strong>City</strong>
        </td>
        <td style="padding: 10px;border: solid 1px #CCC;font-family: 'Open Sans', sans-serif;"><?php echo $city; ?></td>
    </tr>
    <tr>
        <td style="padding: 10px;border: solid 1px #CCC;font-family: 'Open Sans', sans-serif;"><strong>State</strong>
        </td>
        <td style="padding: 10px;border: solid 1px #CCC;font-family: 'Open Sans', sans-serif;"><?php echo $state; ?></td>
    </tr>
    <tr>
        <td style="padding: 10px;border: solid 1px #CCC;font-family: 'Open Sans', sans-serif;"><strong>Address</strong>
        </td>
        <td style="padding: 10px;border: solid 1px #CCC;font-family: 'Open Sans', sans-serif;"><?php echo $address; ?></td>
    </tr>
    <tr>
        <td style="padding: 10px;border: solid 1px #CCC;font-family: 'Open Sans', sans-serif;"><strong>Preferred College</strong>
        </td>
        <td style="padding: 10px;border: solid 1px #CCC;font-family: 'Open Sans', sans-serif;"><?php echo $pre_college; ?></td>
    </tr>
    <tr>
        <td style="padding: 10px;border: solid 1px #CCC;font-family: 'Open Sans', sans-serif;"><strong>Preferred Country</strong>
        </td>
        <td style="padding: 10px;border: solid 1px #CCC;font-family: 'Open Sans', sans-serif;"><?php echo $pre_country; ?></td>
    </tr>

    </tbody>
</table>


</body>
</html>
