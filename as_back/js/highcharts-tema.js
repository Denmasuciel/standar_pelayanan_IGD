/*
Tema utk highcharts
by hendra
*/
$(document).ready(function(){
   Highcharts.setOptions({
      colors: ['#058DC7', '#50B432', '#ED561B', '#DDDF00', '#24CBE5', '#64E572', '#FF9655', '#FFF263', '#6AF9C4'],
      chart: {
        style: {
            fontFamily: 'Roboto'
        }
      }
   });
   // Radialize the colors
   Highcharts.getOptions().colors = Highcharts.map(Highcharts.getOptions().colors, function (color) {
      return {
         radialGradient: {
            cx: 0.8,
            cy: 0.5,
            r: 0.9
         },
         stops: [
            [0, color],
            [1, Highcharts.Color(color).brighten(-0.3).get('rgb')] // darken
         ]
      };
   });
});