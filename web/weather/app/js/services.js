'use strict';

/* Services */

var module = angular.module('weatherServices', ['ngResource']);

module.factory('WeatherData', ['$resource', function($resource){
    return $resource('/query.php', {}, {
      getCurrent: {method:'GET', params:{queryId:'current'}, isArray:false},
      getDayMin: {method:'GET', params:{queryId:'dayMin'}, isArray:false},
      getDayMax: {method:'GET', params:{queryId:'dayMax'}, isArray:false},
      getTempHistory: {method:'GET', params:{queryId:'tempHistory', startDate:'@startDate', endDate:'@endDate'}, isArray:true}
    });
  }]);
