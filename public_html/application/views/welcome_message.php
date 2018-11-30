<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>IoT With NRF24L01</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/png" href="<?php echo base_url('assets/images/icon/favicon.ico')?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/bootstrap.min.css')?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/font-awesome.min.css')?>">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/themify-icons.css')?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/metisMenu.css')?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/owl.carousel.min.css')?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/slicknav.min.css')?>">
    <!-- amchart css -->
    <link rel="stylesheet" href="https://www.amcharts.com/lib/3/plugins/export/export.css" type="text/css" media="all" />
    <!-- others css -->
    <link rel="stylesheet" href="<?php echo base_url('assets/css/typography.css')?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/default-css.css')?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/styles.css')?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/responsive.css')?>">
    <!-- modernizr css -->
    <script src="<?php echo base_url('assets/js/vendor/modernizr-2.8.3.min.js')?>"></script>
	
	<script>
		var updateInterval = 1000;
		var temperatureData,humidityData,soilData;
		function getDatabase() {
			var d = new Date();
			var n = d.getSeconds();
			
			var getcekIdSlave = n%4;
			var params = getcekIdSlave+1;
			//document.getElementById('waktu').innerHTML = params;
			
			xhr = new XMLHttpRequest();
			xhr.open('POST' , '<?php echo site_url('welcome/getSensor/'); ?>'+params , true);
			xhr.setRequestHeader('content-type','application/x-www-form-urlencoded');
			xhr.send();
			xhr.onreadystatechange = function()
			{
				readXHR = xhr.responseText; 
				//document.getElementById('message').innerHTML = readXHR;
				
				objRead = JSON.parse(readXHR);
				temperatureData = objRead.temperature;
				humidityData = objRead.humidity;
				soilData = objRead.soil;
				if(params == 1)
				{
					document.getElementById('temp1').innerHTML = temperatureData+" C";
					document.getElementById('humi1').innerHTML = humidityData+" %";
					document.getElementById('soil1').innerHTML = soilData+" %";					
				}
				if(params == 2)
				{
					document.getElementById('temp2').innerHTML = temperatureData+" C";
					document.getElementById('humi2').innerHTML = humidityData+" %";
					document.getElementById('soil2').innerHTML = soilData+" %";
				}
				if(params == 3)
				{
					document.getElementById('temp3').innerHTML = temperatureData+" C";
					document.getElementById('humi3').innerHTML = humidityData+" %";
					document.getElementById('soil3').innerHTML = soilData+" %";
				}
				if(params == 4)
				{
					document.getElementById('temp4').innerHTML = temperatureData+" C";
					document.getElementById('humi4').innerHTML = humidityData+" %";
					document.getElementById('soil4').innerHTML = soilData+" %";
				}
				
			}
		}
		//setInterval(getDatabase, updateInterval);
		
		window.onload = function () {

			var tempDps = []; // dataPoints
			var soilDps = [];
			var humiDps = [];
			
			var tempDpsSlave1 = []; // dataPoints
			var soilDpsSlave1 = [];
			var humiDpsSlave1 = [];
			
			var tempDpsSlave2 = []; // dataPoints
			var soilDpsSlave2 = [];
			var humiDpsSlave2 = [];
			
			var tempDpsSlave3 = []; // dataPoints
			var soilDpsSlave3 = [];
			var humiDpsSlave3 = [];
			
			var chart = new CanvasJS.Chart("chartContainer", {
				title :{
					text: "Data Suhu, Kelembapan dan Soil"
				},
				axisY: {
					includeZero: false
				},      
				data: [
				{
					type: "line",
					dataPoints: tempDps
				},
				{
					type: "line",
					dataPoints: soilDps
				},
				{
					type: "line",
					dataPoints: humiDps
				}
				]
			});
			var chartSlave1 = new CanvasJS.Chart("chartContainerSlave1", {
				title :{
					text: "Data Suhu, Kelembapan dan Soil"
				},
				axisY: {
					includeZero: false
				},      
				data: [
				{
					type: "line",
					dataPoints: tempDpsSlave1
				},
				{
					type: "line",
					dataPoints: soilDpsSlave1
				},
				{
					type: "line",
					dataPoints: humiDpsSlave1
				}
				]
			});
			var chartSlave2 = new CanvasJS.Chart("chartContainerSlave2", {
				title :{
					text: "Data Suhu, Kelembapan dan Soil"
				},
				axisY: {
					includeZero: false
				},      
				data: [
				{
					type: "line",
					dataPoints: tempDpsSlave2
				},
				{
					type: "line",
					dataPoints: soilDpsSlave2
				},
				{
					type: "line",
					dataPoints: humiDpsSlave2
				}
				]
			});
			var chartSlave3 = new CanvasJS.Chart("chartContainerSlave3", {
				title :{
					text: "Data Suhu, Kelembapan dan Soil"
				},
				axisY: {
					includeZero: false
				},      
				data: [
				{
					type: "line",
					dataPoints: tempDpsSlave3
				},
				{
					type: "line",
					dataPoints: soilDpsSlave3
				},
				{
					type: "line",
					dataPoints: humiDpsSlave3
				}
				]
			});
			

			var xVal = 0;
			var yVal = 0; 
			var updateInterval = 1000;
			var dataLength = 20; // number of dataPoints visible at any point
			
			var node1Humi, node1Soil, node1Temp;
			var node2Humi, node2Soil, node2Temp;
			var node3Humi, node3Soil, node3Temp;
			var node4Humi, node4Soil, node4Temp;
			
			var updateChart = function (count) {
				
				var d = new Date();
				var n = d.getSeconds();
				
				var getcekIdSlave = n%4;
				var params = getcekIdSlave+1;
				//document.getElementById('waktu').innerHTML = params;
				
				xhr = new XMLHttpRequest();
				xhr.open('POST' , '<?php echo site_url('welcome/getSensor/'); ?>'+params , true);
				xhr.setRequestHeader('content-type','application/x-www-form-urlencoded');
				xhr.send();
				xhr.onreadystatechange = function()
				{
					readXHR = xhr.responseText; 
					//document.getElementById('message').innerHTML = readXHR;
					
					objRead = JSON.parse(readXHR);
					temperatureData = objRead.temperature;
					humidityData = objRead.humidity;
					soilData = objRead.soil;
				}
				
				if(params == 1)
				{
					document.getElementById('temp1').innerHTML = temperatureData+" C";
					document.getElementById('humi1').innerHTML = humidityData+" %";
					document.getElementById('soil1').innerHTML = soilData+" %";
					node1Temp = temperatureData;
					node1Humi = humidityData;
					node1Soil = soilData;
					
				}
				if(params == 2)
				{
					document.getElementById('temp2').innerHTML = temperatureData+" C";
					document.getElementById('humi2').innerHTML = humidityData+" %";
					document.getElementById('soil2').innerHTML = soilData+" %";
					node2Temp = temperatureData;
					node2Humi = humidityData;
					node2Soil = soilData;
				}
				if(params == 3)
				{
					document.getElementById('temp3').innerHTML = temperatureData+" C";
					document.getElementById('humi3').innerHTML = humidityData+" %";
					document.getElementById('soil3').innerHTML = soilData+" %";
					node3Temp = temperatureData;
					node3Humi = humidityData;
					node3Soil = soilData;
				}
				if(params == 4)
				{
					document.getElementById('temp4').innerHTML = temperatureData+" C";
					document.getElementById('humi4').innerHTML = humidityData+" %";
					document.getElementById('soil4').innerHTML = soilData+" %";
					node4Temp = temperatureData;
					node4Humi = humidityData;
					node4Soil = soilData;
				}
				
				
				count = count || 1;

				for (var j = 0; j < count; j++) {
					tempDps.push({
						x:xVal,
						y:parseInt(node1Temp)
					});
					humiDps.push({
						x: xVal,
						y: parseInt(node1Humi)
					});
					soilDps.push({
						x: xVal,
						y: parseInt(node1Soil)
					});
					
					tempDpsSlave1.push({
						x:xVal,
						y:parseInt(node2Temp)
					});
					humiDpsSlave1.push({
						x: xVal,
						y: parseInt(node2Humi)
					});
					soilDpsSlave1.push({
						x: xVal,
						y: parseInt(node2Soil)
					});
					
					tempDpsSlave2.push({
						x:xVal,
						y:parseInt(node3Temp)
					});
					humiDpsSlave2.push({
						x: xVal,
						y: parseInt(node3Humi)
					});
					soilDpsSlave2.push({
						x: xVal,
						y: parseInt(node3Soil)
					});
					
					tempDpsSlave3.push({
						x:xVal,
						y:parseInt(node4Temp)
					});
					humiDpsSlave3.push({
						x: xVal,
						y: parseInt(node4Humi)
					});
					soilDpsSlave3.push({
						x: xVal,
						y: parseInt(node4Soil)
					});
					
					xVal++;
				}

				if (tempDps.length > dataLength) {
					tempDps.shift();
					humiDps.shift();
					soilDps.shift();
					
					tempDpsSlave1.shift();
					humiDpsSlave1.shift();
					soilDpsSlave1.shift();
					
					tempDpsSlave2.shift();
					humiDpsSlave2.shift();
					soilDpsSlave2.shift();
					
					tempDpsSlave3.shift();
					humiDpsSlave3.shift();
					soilDpsSlave3.shift();
				}
				//document.getElementById('valueDatabase').innerHTML = yVal;
				chart.render();
				chartSlave1.render();
				chartSlave2.render();
				chartSlave3.render();
				
				
			};

			updateChart(dataLength);
			setInterval(function(){updateChart()}, updateInterval);

		}
	</script>
	
</head>

<body>
	<div id="message"></div>
	<div id="waktu"></div>
    <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
    <!-- preloader area start -->
    <div id="preloader">
        <div class="loader"></div>
    </div>
    <!-- preloader area end --> 
    <!-- page container area start -->
    <div class="page-container">
        <!-- sidebar menu area start -->
        <div class="sidebar-menu">
            <div class="sidebar-header">
                <div class="logo">
                    <a href="<?= site_url('welcome'); ?>"><img src="<?php echo base_url('assets/images/icon/logo.png')?>" alt="logo"></a>
                </div>
            </div>
            <div class="main-menu">
                <div class="menu-inner">
                    <nav>
                        <ul class="metismenu" id="menu">
                            <li class="active">
                                <a href="javascript:void(0)" aria-expanded="true"><i class="ti-dashboard"></i><span>dashboard</span></a>
                                <ul class="collapse">
                                    <li class="active"><a href="<?= site_url('welcome'); ?>">Dashboard</a></li>
                                    <li><a href="<?= site_url('report'); ?>">Report</a></li> 
                                </ul>
                            </li>
                            
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
        <!-- sidebar menu area end -->
        <!-- main content area start -->
        <div class="main-content">
            
            <!-- page title area start -->
            <div class="page-title-area">
                <div class="row align-items-center">
                    <div class="col-sm-6">
                        <div class="breadcrumbs-area clearfix">
                            <h4 class="page-title pull-left">Dashboard</h4>
                            <ul class="breadcrumbs pull-left">
                                <li><a href="index.html">Home</a></li>
                                <li><span>Dashboard</span></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-6 clearfix">
                        <div class="user-profile pull-right">
                            <img class="avatar user-thumb" src="<?php echo base_url('assets/images/author/avatar.png')?>" alt="avatar">
                            <h4 class="user-name dropdown-toggle" data-toggle="dropdown">Wahyu J <i class="fa fa-angle-down"></i></h4>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="#">Log Out</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- page title area end -->
            <div class="main-content-inner">
                <!-- sales report area start -->
                <div class="sales-report-area mt-5 mb-5">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="single-report mb-xs-30">
                                <div class="s-report-inner pr--20 pt--30 mb-3">
                                    <div class="icon"><i class="fas fa-user-astronaut">1</i></div>
                                    <div class="s-report-title d-flex justify-content-between">
                                        <h4 class="header-title mb-0">Temperature</h4>
                                        <p id="temp1">24 C</p>
                                    </div>
									<div class="s-report-title d-flex justify-content-between">
                                        <h4 class="header-title mb-0">Humidity</h4>
                                        <p id="humi1">24 %</p>
                                    </div>
									<div class="s-report-title d-flex justify-content-between">
                                        <h4 class="header-title mb-0">Soil</h4>
                                        <p id="soil1">24 %</p>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="single-report mb-xs-30">
                                <div class="s-report-inner pr--20 pt--30 mb-3">
                                  <div class="icon"><i class="fas fa-user-astronaut">2</i></div>
                                    <div class="s-report-title d-flex justify-content-between">
                                        <h4 class="header-title mb-0">Temperature</h4>
                                        <p id="temp2">24 C</p>
                                    </div>
									<div class="s-report-title d-flex justify-content-between">
                                        <h4 class="header-title mb-0">Humidity</h4>
                                        <p id="humi2">24 %</p>
                                    </div>
									<div class="s-report-title d-flex justify-content-between">
                                        <h4 class="header-title mb-0">Soil</h4>
                                        <p id="soil2">24 %</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="single-report">
                                <div class="s-report-inner pr--20 pt--30 mb-3">
                                    <div class="icon"><i class="fas fa-user-astronaut">3</i></div>
                                    <div class="s-report-title d-flex justify-content-between">
                                        <h4 class="header-title mb-0">Temperature</h4>
                                        <p id="temp3">24 C</p>
                                    </div>
									<div class="s-report-title d-flex justify-content-between">
                                        <h4 class="header-title mb-0">Humidity</h4>
                                        <p id="humi3">24 %</p>
                                    </div>
									<div class="s-report-title d-flex justify-content-between">
                                        <h4 class="header-title mb-0">Soil</h4>
                                        <p id="soil3">24 %</p>
                                    </div>
                                </div>
                            </div>
                        </div>
						<div class="col-md-3">
                            <div class="single-report">
                                <div class="s-report-inner pr--20 pt--30 mb-3">
                                    <div class="icon"><i class="fas fa-user-astronaut">4</i></div>
                                    <div class="s-report-title d-flex justify-content-between">
                                        <h4 class="header-title mb-0">Temperature</h4>
                                        <p id="temp4">24 C</p>
                                    </div>
									<div class="s-report-title d-flex justify-content-between">
                                        <h4 class="header-title mb-0">Humidity</h4>
                                        <p id="humi4">24 %</p>
                                    </div>
									<div class="s-report-title d-flex justify-content-between">
                                        <h4 class="header-title mb-0">Soil</h4>
                                        <p id="soil4">24 %</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- sales report area end -->
                <!-- overview area start -->
                <div class="row">
                    <div class="col-xl-6 col-lg-5">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">
                                    <h4 class="header-title mb-0">Node Master</h4>
                                    
                                </div>
                                <div id="chartContainer" style="height: 200px; width: 100%;"></div>
                            </div>
                        </div>
                    </div>
					<div class="col-xl-6 col-lg-5">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">
                                    <h4 class="header-title mb-0">Node Slave 1</h4>
                                    
                                </div>
                                <div id="chartContainerSlave1" style="height: 200px; width: 100%;"></div>
                            </div>
                        </div>
                    </div>
					<div class="col-xl-6 col-lg-5">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">
                                    <h4 class="header-title mb-0">Node Slave 2</h4>
                                    
                                </div>
                                <div id="chartContainerSlave2" style="height: 200px; width: 100%;"></div>
                            </div>
                        </div>
                    </div>
					<div class="col-xl-6 col-lg-5">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">
                                    <h4 class="header-title mb-0">Node Slave 3</h4>
                                    
                                </div>
                                <div id="chartContainerSlave3" style="height: 200px; width: 100%;"></div>
                            </div>
                        </div>
                    </div>
					
                   
                </div>

                <!-- overview area end -->
                
            </div>
        </div>
        <!-- main content area end -->
        <!-- footer area start-->
        <footer>
			
            <div class="footer-area">
                <p>© Copyright 2018. All right reserved. Template by <a href="yhoora.com/">Wahyu J</a>.</p>
            </div>
        </footer>
        <!-- footer area end-->
    </div>
    <!-- page container area end -->
    
    <!-- jquery latest version -->
    <script src="<?php echo base_url('assets/js/vendor/jquery-2.2.4.min.js')?>"></script>
    <!-- bootstrap 4 js -->
    <script src="<?php echo base_url('assets/js/popper.min.js')?>"></script>
    <script src="<?php echo base_url('assets/js/bootstrap.min.js')?>"></script>
    <script src="<?php echo base_url('assets/js/owl.carousel.min.js')?>"></script>
    <script src="<?php echo base_url('assets/js/metisMenu.min.js')?>"></script>
    <script src="<?php echo base_url('assets/js/jquery.slimscroll.min.js')?>"></script>
    <script src="<?php echo base_url('assets/js/jquery.slicknav.min.js')?>"></script>

    <!-- start chart js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.min.js"></script>
    <!-- start highcharts js -->
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <!-- start zingchart js -->
    <script src="https://cdn.zingchart.com/zingchart.min.js"></script>
    <script>
    zingchart.MODULESDIR = "https://cdn.zingchart.com/modules/";
    ZC.LICENSE = ["569d52cefae586f634c54f86dc99e6a9", "ee6b7db5b51705a13dc2339db3edaf6d"];
    </script>
    <!-- all line chart activation -->
    <script src="<?php echo base_url('assets/js/line-chart.js')?>"></script>
    <!-- all pie chart -->
    <script src="<?php echo base_url('assets/js/pie-chart.js')?>"></script>
    <!-- others plugins -->
    <script src="<?php echo base_url('assets/js/plugins.js')?>"></script>
    <script src="<?php echo base_url('assets/js/scripts.js')?>"></script>
	
	<!-- canvas JS untuk chart -->
	<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
</body>

</html>
