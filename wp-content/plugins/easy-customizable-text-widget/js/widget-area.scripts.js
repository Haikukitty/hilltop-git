jQuery(document).ready(function($){
  
  $('div[id*="wps_gfwidget"]', '#widget-list').each(function(i, item){
    $(item).addClass('wps-gfw-widget-highlight');
  });  
  
  $('div[id*="wps_gfwidget"]', '#widgets-right').each(function(i, item){
    $(item).addClass('wps-gfw-widget-highlight');
  });
  
});