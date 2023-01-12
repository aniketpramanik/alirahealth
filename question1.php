<!DOCTYPE html>

<head>
	<title>Energy Calculator</title>
   <!-- CSS for the page -->
   <style>
         
        #page-wrap{
            color:red;
            font-family: "Times New Roman", Times, serif;
        }
        
        input[type=number] {
                padding: 10px;
                padding:10px;
                border:0;
                box-shadow:0 0 15px 4px rgba(0,0,0,0.06);
        }
        #total_units{
            appearance:none;
            -webkit-appearance:none;
            padding:10px;
            border:none;
            background-color:#3F51B5;
            color:#fff;
            font-weight:600;
            border-radius:5px;
          
        }
        #lb{
            
            color: blue;
            padding: 18px;

        }

        #result{
            font-size:20px;
        }
    </style>
</head>

<?php
$result_str = $result = '';
if (isset($_POST['total_units'])) {
    $units = $_POST['units'];
    if (!empty($units)) {
        $result = calculate_bill($units);
        $result_str = 'Total amount of ' . $units . ' units -  AUD $' . $result;
    }
}
/**
 * To calculate energy bill for unit used
 */
function calculate_bill($units) {
    $unit_slab_1 =  0.20;    //For first 50 units 
    $unit_slab_2 = 0.50;   // For next 100 units
    $unit_slab_3 = 0.70;    // For next 100 units 
    $unit_slab_4 = 0.90;   // For units above 250

    if($units <= 50) {                  // condition for first 50 units
        $bill = $units * $unit_slab_1;
    }
    else if($units > 50 && $units <= 100) {   //condition for next 100 units
        $temp = 50 * $unit_slab_1;
        $remaining_units = $units - 50;
        $bill = $temp + ($remaining_units * $unit_slab_2);
    }
    else if($units > 100 && $units <= 250) {       // condition for next 100 units
        $temp = (50 * 3.5) + (100 * $unit_slab_2);
        $remaining_units = $units - 150;
        $bill = $temp + ($remaining_units * $unit_slab_3);
    }
    else {                                         // condition for units above 250
        $temp = (50 * 0.2) + (100 * $unit_slab_2) + (100 * $unit_slab_3);
        $remaining_units = $units - 250;
        $bill = $temp + ($remaining_units * $unit_slab_4);
    }
    return number_format((float)$bill, 2, '.', ''); //Return the final result to the function
}

?>

<body>
    <center>
	<div id="page-wrap">
		<h1 id=head1 >Energy Calculator</h1>

		<form action="" method="post" id="quiz-form">
                <label id="lb"> Please enter no. of Units Used: </label><br><br>
            	<input type="number" name="units" id="units" placeholder= "units"/><br><br>
            	<input type="submit" name="total_units" id="total_units" value="Submit" />
		</form>

		<div id=result> 
		    <?php echo '<br /><br />' . $result_str; ?>
		</div>
	</div>
</center>
</body>
</html>