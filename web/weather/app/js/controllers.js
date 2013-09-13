'use strict';

/* Controllers */

function WeatherCtrl($scope, $location, WeatherData) {
    $scope.startDate = new Date(); 
    $scope.startDate.setMonth($scope.startDate.getMonth()-1);
    $scope.endDate = new Date(); 

    var d1 = [];
    var d2 = [];
    var d3 = [];
    var d4 = [];
    var d5 = [];
    var d6 = [];
    var d7 = [];
    var d8 = [];
    var d9 = [];
    
    var options1 = {
        chart: {
            renderTo: 'chart1',
            type: 'spline'
        },
        title: {
            text: 'Temperature (degC)'
        },
        xAxis: {
            title: {
                text: 'Date/Time'
            },
            type: 'datetime'
        },
        yAxis: {
            title: {
                text: 'degC'
            }
        },
        plotOptions: {
            spline: {
                marker: {
                    enabled: false
                }
            }
        },
        series: [{
            data: d1,
            name: 'Indoor Temperature',
            type: 'spline'
        }, {
            data: d2,
            name: 'Outdoor Temperature',
            type: 'spline'
        }, {
            data: d3,
            name: 'Dew Point',
            type: 'spline'
        }, {
            data: d4,
            name: 'Wind Chill',
            type: 'spline'
        }]
    };
    
    var options2 = {
        chart: {
            renderTo: 'chart2',
            type: 'spline'
        },
        title: {
            text: 'Humidity'
        },
        xAxis: {
            title: {
                text: 'Date/Time'
            },
            type: 'datetime'
        },
        yAxis: {
            title: {
                text: 'Humidity (%)'
            }
        },
        plotOptions: {
            spline: {
                marker: {
                    enabled: false
                }
            }
        },
        series: [{
            data: d5,
            name: 'Indoor Humidity',
            type: 'spline'
        }, {
            data: d6,
            name: 'Outdoor Humidity',
            type: 'spline'
        }]
    };
    
    var options3 = {
        chart: {
            renderTo: 'chart3',
            type: 'spline'
        },
        title: {
            text: 'Pressure'
        },
        xAxis: {
            title: {
                text: 'Date/Time'
            },
            type: 'datetime'
        },
        yAxis: {
            title: {
                text: 'Pressure'
            }
        },
        plotOptions: {
            spline: {
                marker: {
                    enabled: false
                }
            }
        },
        series: [{
            data: d7,
            name: 'Pressure',
            type: 'spline'
        }]
    };

    var options4 = {
        chart: {
            renderTo: 'chart4',
            type: 'spline'
        },
        title: {
            text: 'Wind Speed'
        },
        xAxis: {
            title: {
                text: 'Date/Time'
            },
            type: 'datetime'
        },
        yAxis: {
            title: {
                text: 'Wind Speed'
            }
        },
        plotOptions: {
            spline: {
                marker: {
                    enabled: false
                }
            }
        },
        series: [{
            data: d8,
            name: 'Wind Speed',
            type: 'spline'
        }]
    };

    var options5 = {
        chart: {
            renderTo: 'chart5',
            type: 'column'
        },
        title: {
            text: 'Rain Fall'
        },
        xAxis: {
            title: {
                text: 'Date/Time'
            },
            type: 'datetime'
        },
        yAxis: {
            title: {
                text: 'Rain Fall'
            }
        },
        plotOptions: {
            //bar: {
            //    marker: {
            //        enabled: false
            //    }
            //}
	    column: {
		pointWidth: 10
	    }
        },
        series: [{
            data: d9,
            name: 'Rain Fall'
            //type: 'spline'
        }]
    };

    $scope.reload = function (startDate, endDate) {
        $scope.weather = WeatherData.getCurrent();
        $scope.weatherMin = WeatherData.getDayMin(function() {$scope.weatherMin.Outdoor_Temp = $scope.weatherMin.Outdoor_Temp.toFixed(1)});
        $scope.weatherMax = WeatherData.getDayMax(function() {$scope.weatherMax.Outdoor_Temp = $scope.weatherMax.Outdoor_Temp.toFixed(1)});

//        var tempHistory = WeatherData.getTempHistory({startDate:$scope.startDate.toISOString(), endDate:$scope.endDate.toISOString()}, function() {
        var tempHistory = WeatherData.getTempHistory({startDate:startDate.toISOString(), endDate:endDate.toISOString()}, function() {

            d1.length = 0;
            d2.length = 0;
            d3.length = 0;
            d4.length = 0;
            d5.length = 0;
            d6.length = 0;
            d7.length = 0;
            d8.length = 0;
            d9.length = 0;
            
            for (var i = 0; i < tempHistory.length; i++) {
                d1.push([Date.parse(tempHistory[i].Recorded), tempHistory[i].Indoor_Temp]);
                d2.push([Date.parse(tempHistory[i].Recorded), tempHistory[i].Outdoor_Temp]);
                d3.push([Date.parse(tempHistory[i].Recorded), tempHistory[i].Dew_Point]);
                d4.push([Date.parse(tempHistory[i].Recorded), tempHistory[i].Wind_Chill]);
                d5.push([Date.parse(tempHistory[i].Recorded), tempHistory[i].Indoor_Humidity]);
                d6.push([Date.parse(tempHistory[i].Recorded), tempHistory[i].Outdoor_Humidity]);
                d7.push([Date.parse(tempHistory[i].Recorded), tempHistory[i].Abs_Pressure]);
                d8.push([Date.parse(tempHistory[i].Recorded), tempHistory[i].Wind_Avg]);
                d9.push([Date.parse(tempHistory[i].Recorded), tempHistory[i].Rain_Since_Last]);
            }
            
            var chart1 = new Highcharts.Chart(options1);
            var chart2 = new Highcharts.Chart(options2);
            var chart3 = new Highcharts.Chart(options3);
            var chart4 = new Highcharts.Chart(options4);
            var chart5 = new Highcharts.Chart(options5);
        });
    };
    
    $scope.reload($scope.startDate, $scope.endDate);
                    
    $scope.log = function (msg) {
        console.log(msg);
    }
                                    
    $scope.setPath = function (path) {
        $location.path(path);
    }

    $scope.alert = function (msg) {
        window.alert(msg);
    }
}

//WeatherCtrl.$inject = ['$scope', 'WeatherData'];
