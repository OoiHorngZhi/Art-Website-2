<?php
$link = mysqli_connect("localhost", "root", "");
mysqli_select_db($link, "artweb_db");

$test = array();

$count = 0;
$res = mysqli_query($link, "SELECT * FROM orders");

while ($row = mysqli_fetch_array($res)) {
    $type = $row["placed_on"];
    $price = $row["total_price"];

    if (isset($test[$type])) {
        // If the type already exists in the $test array, add the price to it
        $test[$type]["y"] += $price;
    } else {
        // If it's a new type, create a new entry in the $test array
        $test[$type] = array("label" => $type, "y" => $price);
    }
}

// Convert the associative array back to a numerical indexed array
$test = array_values($test);

?>
<?php include('includes/header.php'); ?>
 
    
    <script>
        window.onload = function() {
        
        var chart = new CanvasJS.Chart("chartContainer", {
            animationEnabled: true,
            theme: "light2",
            title:{
                text: "Total Art Sales"
            },
            axisY: {
                title: "Total Sales (RM)"
            },
            axisX: {
                title: "Date of Sales"
            },
            data: [{
                type: "column",
                yValueFormatString: "RM#,##0.## ",
                dataPoints: <?php echo json_encode($test, JSON_NUMERIC_CHECK); ?>
            }]
        });
        chart.render();
        
        }

        
    </script>
    
</head>

  <body>
  



                                        <tbody>
                                       
                                            </tbody>
                                        
                                    </table>
                                    <div style="margin-top:3%">

                                        <div id="chartContainer" style="height: 500px; width: 95%; margin-left:2%"></div>
                                        <script src="https://cdn.canvasjs.com/canvasjs.min.js"></script>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                </div>
                <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
                <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
                <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
                <script>
                    $(document).ready(function () {
                        $('#example').DataTable();
                    });
                </script>
            </div>
        </div>
      </div>   
</div>

<?php include('includes/footer.php'); ?>
