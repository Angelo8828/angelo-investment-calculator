<?php

    /*
   |--------------------------------------------------------------------------
   | Investment Calculator
   |--------------------------------------------------------------------------
   |
   | References: http://www.investopedia.com/terms/e/exponential-growth.asp
   |
   | Formula: V = S * (1 + R) ^ T
   |
   | The current value, V, of an initial starting point subject to exponential growth can be determined by
   | multiplying the starting value, S, by the sum of one plus the rate of interest, R, raised to the power
   | of T, or the number of periods that have elapsed.
   |
   | @author Angelo Joseph M. Salvador
   | @date July 29, 2017
   */
?>

<html>
    <head>
        <title>Personal Investment Calculator</title>
        <link rel="stylesheet" type="text/css" href="assets/bootstrap.min.css">
    </head>
    <body>
        <div class="container">

            <h1>Personal Investment Calculator</h1>
            <br/>

            <form>

                <label class="col-xs-3">Monthly/Yearly Hulog:&nbsp;</label>
                <input type="number" name="S" value="<?php echo $_GET['S'] ? $_GET['S'] : '' ?>" /><br/>
                <div class="clearfix"></div>

                <label class="col-xs-3">Interest Rate:&nbsp;</label>
                <input type="number" name="R" value="<?php echo $_GET['R'] ? $_GET['R'] : '' ?>"/>%<br/>
                <div class="clearfix"></div>

                <label class="col-xs-3">Bilang ng Buwan o Taon na Maghuhulog&nbsp;</label>
                <input type="number" name="T" value="<?php echo $_GET['T'] ? $_GET['T'] : '' ?>"/><br/>
                <div class="clearfix"></div>

                <br/>
                <div class="col-xs-2">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>

            </form>

            <br/>
            <br/>

            <?php

                if ($_GET) {

                    $S = (float)$_GET['S'];
                    $R = (float)$_GET['R'] / 100;
                    $T = (float)$_GET['T'];

                    $yearlyChangeArray = [];
                    for ($i=1; $i <= $T; $i++) {
                        $yearlyChangeArray[] = $S * ((1 + $R) ** $i);
                    }

                    $yearlyChangeArray = array_reverse($yearlyChangeArray, true);

                    echo "
                    <table class='table table-condensed'>
                        <thead>
                        <tr>
                            <td>Year #</td>
                            <td>Hulog Kada Taon</td>
                            <td>Kabuuang Naihulog</td>
                            <td>Kinitang Interes</td>
                            <td class='text-right'>Kinitang Interes + Naihulog</td>
                        </tr>
                        </thead>
                    ";

                    $counter = 1;

                    foreach ($yearlyChangeArray as $key => $value) {

                        echo "
                        <tr>
                            <td>". $counter ."</td>
                            <td>". number_format($S) ."</td>
                            <td><strong>". number_format($S * ($counter)) ."</strong></td>
                            <td class='text-success'><strong>". number_format($value - $S) ."</strong></td>
                            <td class='text-success text-right'><strong>". number_format($value) ."</strong></td>
                        </tr>";

                        $counter++;
                    }

                    echo "
                        <tr>
                            <td colspan='4'></td>
                            <td class='text-success text-right'><strong>". number_format(array_sum($yearlyChangeArray)) ."</strong></td>
                        </tr>
                    </table>";
                }
            ?>
        </div>
    </body>
</html>
