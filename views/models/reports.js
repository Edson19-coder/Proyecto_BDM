var Report1 = function (courseId, title, students, lessonsMostComplete, sales) {
    this.courseId = courseId;
    this.title = title;
    this.students = students
    this.lessonsMostComplete = lessonsMostComplete;
    this.sales = sales;
};

Report1.prototype = {
    getHtml: function () {
        var html = null;

          html = `
          <tr>
              <th scope="row"><a href="course.php?course=${this.courseId}">${this.title}</a></th>
              <td>${this.students}</td>
              <td>${this.lessonsMostComplete}</td>
              <td>$${this.sales}</td>
          </tr>
          `;

        return html;
    }
};

var Report2 = function (firstName, lastName, pComplete, totalSpent, paymentMethod) {
    this.firstName = firstName;
    this.lastName = lastName;
    this.pComplete = pComplete
    this.totalSpent = totalSpent;
    this.paymentMethod = paymentMethod;
    this.enrollment = null;
};

Report2.prototype = {
  setEnrollment: function (enrollment) {
      this.enrollment = enrollment;
  },
    getHtml: function () {
        var html = null;

          html = `
          <tr>
              <th scope="row"><a href="#">${this.firstName} ${this.lastName}</a></th>
              <td>${this.enrollment}</td>
              <td>${this.pComplete}%</td>
              <td>$${this.totalSpent}</td>
              <td>${this.paymentMethod}</td>
          </tr>
          `;

        return html;
    }
};
