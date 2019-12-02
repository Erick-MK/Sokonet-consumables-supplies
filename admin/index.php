<?php



require '../config/requirements.php';


require '../config/bootstrap.php';


if (!isset($_SESSION['email']) & empty($_SESSION['email'])) {
    header('location: login.php');
}

/**
 * Load the template files.
 */
include ADMIN_INC . 'header.php';
?>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
google.charts.load('current', {'packages':['corechart']});
google.charts.setOnLoadCallback(drawChart);
google.charts.setOnLoadCallback(drawChart1);

function drawChart() {
    var data = google.visualization.arrayToDataTable([
        ['Year', 'Sales', 'Expenses'],
        ['2016',  1500,      600],
        ['2017',  1000,      600],
        ['2018',  700,       1300],
        ['2019',  1200,      400]
    ]);

    var options = {
        title: 'Weekly Revenue',
        curveType: 'function',
        legend: { position: 'bottom-centre' }
    };

    var chart = new google.visualization.LineChart(document.getElementById('curve_chart'));

    chart.draw(data, options);
}
// function drawChart1() {
//     var data = google.visualization.arrayToDataTable([
//         ['Year', 'Sales', 'Expenses'],
//         ['2016',  1000,      400],
//         ['2017',  1170,      460],
//         ['2018',  660,       1120],
//         ['2019',  1030,      540]
//     ]);

//     var options = {
//         title: 'Weekly Orders',
//         curveType: 'function',
//         legend: { position: 'bottom' }
//     };

//     var chart = new google.visualization.LineChart(document.getElementById('curve_chart1'));

//     chart.draw(data, options);
// }
</script>

<?php include ADMIN_INC . 'nav.php'; ?>

<!-- SHOP CONTENT -->
<section id="content">
    <div class="content-blog">
        <div class="container">
            <div class="row">
                <div class="page_header text-center">
                    <h2>Dashboard</h2>
                    <p>Navigate to manage Sokonet</p>
                </div>
                <div class="col-md-6">
                    <div class="row">
                        <div id="curve_chart" style="width: 550px; height: 300px"></div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="row">
                        <div id="curve_chart1" style="width: 550px; height: 300px"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

