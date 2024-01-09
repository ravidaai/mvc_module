<html>
<head>
    <title>Invoice</title>

    <style>
        table td, table th
        {
            padding: 0 10px; /* 'cellpadding' equivalent */
        }
        table{width: 100%; border-collapse: collapse!important; border-spacing: 0px;border: none;}

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


        h2{padding: 5px; margin: 0; font-size: 17px;}
        h1{padding: 5px; margin: 0; font-size: 20px;}
    </style>
</head>

<body>

<table style="border:none;">
    <tbody>
    <tr>
        <td colspan="2">

            <img src="<?php echo site_url('assets/site/img/logo.png') ?>" alt="logo" class="img-responsive" style="padding: 10px;">

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

    <tr>

        <td colspan="2">
            <h1 style="text-decoration: underline; margin-left: 15px; font-family: 'Open Sans', sans-serif;">Bill To</h1>
            <p style="margin-left: 18px; font-family: 'Open Sans', sans-serif;">
                <?php echo $bill_to; ?> <br>
                <?php echo $address; ?><br>
                <?php echo $email; ?><br>
                Student ID: <?php echo $user_id; ?><br>

            </p>
        </td>
        <td colspan="3" style="text-align: left;">
            <h1 style="text-decoration: underline;font-family: 'Open Sans', sans-serif;">Details</h1>
            <p style="font-family: 'Open Sans', sans-serif;">
                <strong>Date of issue:</strong> <?php echo date('F j, Y', strtotime($created)); ?> <br>
                <strong>Invoice ID:</strong> <?php echo $invoice_id; ?>
            </p> </td>
    </tr>

    </tbody>
</table>

<h1 style="text-align: center; padding: 15px; font-family: 'Open Sans', sans-serif;  font-size: 25px;">INVOICE</h1>

<table class="with_border">
    <tbody>


    <tr>
        <th style="text-align: left; width: 5%; padding: 10px; border: solid 1px #CCC;font-family: 'Open Sans', sans-serif;">SN</th>
        <th style="text-align: left; width: 30%; padding: 10px; border: solid 1px #CCC;font-family: 'Open Sans', sans-serif;">Particular</th>
        <th style="text-align: left; width: 5%; padding: 10px; border: solid 1px #CCC;font-family: 'Open Sans', sans-serif;">Quantity</th>
        <th style="text-align: left; width: 10%; padding: 10px; border: solid 1px #CCC;font-family: 'Open Sans', sans-serif;">Rate (USD)</th>
        <th style="text-align: left; width: 10%; padding: 10px; border: solid 1px #CCC;font-family: 'Open Sans', sans-serif;">total (USD)</th>
    </tr>

            <tr>
                <td style="padding: 10px;border: solid 1px #CCC;font-family: 'Open Sans', sans-serif;">1</td>
                <td style="padding: 10px;border: solid 1px #CCC;font-family: 'Open Sans', sans-serif;"><?php echo $particular; ?></td>
                <td style="padding: 10px;border: solid 1px #CCC;font-family: 'Open Sans', sans-serif;"><?php echo 1; ?></td>
                <td style="padding: 10px;border: solid 1px #CCC;font-family: 'Open Sans', sans-serif;"><?php echo $amount; ?></td>
                <td style="padding: 10px;border: solid 1px #CCC;font-family: 'Open Sans', sans-serif;"><?php echo $amount; ?></td>
            </tr>





        <tr>
            <td colspan="4" style="font-weight: bold; text-align: right; padding: 10px;border: solid 1px #CCC;font-family: 'Open Sans', sans-serif;">Total in USD :</td>
            <td style="padding: 10px;border: solid 1px #CCC;font-family: 'Open Sans', sans-serif;"><?php echo $amount; ?></td>
        </tr>

    </tbody>
</table>



</body>
</html>
