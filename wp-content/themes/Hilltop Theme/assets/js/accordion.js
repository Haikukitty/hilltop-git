// JavaScript Document

$(document).ready(function(){
	$(".menu_body").hide();
	$(".menu_head:first-child").next(".menu_body").slideToggle(600); 
	//toggle the componenet with class menu_body
	$(".menu_head").click(function(){
		$(this).next(".menu_body").slideToggle(600); 
		var plusmin;
		plusmin = $(this).children(".plusminus").text();
 
		if( plusmin == '+')
		$(this).children(".plusminus").text('-');
		else
		$(this).children(".plusminus").text('+');
	});
});
