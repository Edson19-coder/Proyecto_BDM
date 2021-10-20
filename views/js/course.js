$(document).ready(() => {
	var userId = $("#InputUserIdHidden").val();
	var courseId = $("#InputCourseIdHidden").val();
});

function checkprice(){
	var cant = $(":checkbox:checked").length;
	var price = $("#IndividualLessonPrice").val();
	price = parseInt(price, 10);
	var total = price * cant;
	$("#LessonsPrice").text(total);
};