$(document).ready(() => {

  var course = null;

  var user = String($(".sesion").val());

  getReport1();
  getReport1C();
  getAllCourses();

  $('#InputCourses').click(() => {
      course = $('option:selected').val();
      getReport2();
  });

  function getReport1() {
      var reportData = {
          vAction: 'R1',
          userId: user
      };

      $.ajax({
         url: "../controllers/reports.php",
         type: "POST",
         data: reportData,
         dataType: 'json',
          success: function(data) {
            $('#tableBodyReport1').empty();

            data.forEach(rep => {
                var newRep = new Report1(rep.COURSE_ID, rep.TITLE, rep.PARTICIPANTS, rep.LESSON_MOST_COMPLETED, rep.SALES);

                $('#tableBodyReport1').append(newRep.getHtml());
            });
         },
         error: function(XMLHttpRequest, textStatus, errorThrown) {
              alert("Status: " + textStatus); alert("Error: " + errorThrown);
          }
      });
  }

  function getReport1C() {
      var reportData = {
          vAction: 'RC',
          userId: user
      };

      $.ajax({
         url: "../controllers/reports.php",
         type: "POST",
         data: reportData,
         dataType: 'json',
          success: function(data) {
            $('#visaTotal').append('$'+data.VISA);
            $('#masterCardTotal').append('$'+data.MASTERCARD);
            $('#totalMoney').append('$'+data.TOTAL);
         },
         error: function(XMLHttpRequest, textStatus, errorThrown) {
              alert("Status: " + textStatus); alert("Error: " + errorThrown);
          }
      });
  }

  function getAllCourses() {
      var reportData = {
          vAction: 'R2C',
          userId: user
      };

      $.ajax({
         url: "../controllers/reports.php",
         type: "POST",
         data: reportData,
         dataType: 'json',
          success: function(data) {
             data.forEach(course => {
                  $('#InputCourses').append($('<option>', {
                      value: course.COURSE_ID,
                      text: course.TITLE
                  }));
             });
             course = $('option:selected').val();
             getReport2();
         },
         error: function(XMLHttpRequest, textStatus, errorThrown) {
              alert("Status: " + textStatus); alert("Error: " + errorThrown);
          }
      });
  }

  function getReport2() {
      var reportData = {
          vAction: 'R2',
          courseId: course
      };

      $.ajax({
         url: "../controllers/reports.php",
         type: "POST",
         data: reportData,
         dataType: 'json',
         async: false,
          success: function(data) {
            var total = 0;

            $('#tableBodyReport2').empty();

            data.forEach(rep => {
                var newRep = new Report2(rep.FIRST_NAME, rep.LAST_NAME, rep.PERCENTAGE_COMPLETION, rep.TOTAL_SPENT, rep.PAYMENT_METHOD);
                var date = getReportEnDate(rep.USER_ID);
                newRep.setEnrollment(date);
                var moneyInt = parseInt(rep.TOTAL_SPENT, 10);
                total = total + moneyInt;
                $('#tableBodyReport2').append(newRep.getHtml());
            });
            $('#totalMoneyR2').empty();
            $('#totalMoneyR2').append('$'+total);
         },
         error: function(XMLHttpRequest, textStatus, errorThrown) {
              alert("Status: " + textStatus); alert("Error: " + errorThrown);
          }
      });
  }

  function getReportEnDate(userCurrentId) {
      var date;

      var reportData = {
          vAction: 'R2CC',
          courseId: course,
          userId: userCurrentId
      };

      $.ajax({
         url: "../controllers/reports.php",
         type: "POST",
         data: reportData,
         dataType: 'json',
         async: false,
          success: function(data) {
            date = data.ENROLLMENT_DATE;
         },
         error: function(XMLHttpRequest, textStatus, errorThrown) {
              alert("Status: " + textStatus); alert("Error: " + errorThrown);
          }
      });
      return date;
  }
})
