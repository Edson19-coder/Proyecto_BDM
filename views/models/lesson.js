var Lesson = function (lessonTitle, lessonDescription, lessonPrice, lessonVideo, lessonImage, lessonFile) {
    this.id = 0;
    this.lessonTitle = lessonTitle;
    this.lessonDescription = lessonDescription;
    this.lessonPrice = lessonPrice;
    this.lessonVideo = lessonVideo;
    this.lessonImage = lessonImage;
    this.lessonFile = lessonFile;
};

Lesson.prototype = {
    setId: function (id) {
        this.id = id;
    },
    getHtml: function () {
        var html = '<tr>';
            html += '<th scope="row" class="rowLesson">'+ this.id +'</th>';
            html += '<td class="titleCol">'+ this.lessonTitle +'</td>';
            html += '<td>';
            html += '<button type="button" style="margin-right: 5px;" class="btn btn-edit-lesson btn-primary btn-sm px-3" data-bs-toggle="modal"';
            html += 'data-bs-target="#editLesson">';
            html += '<i class="fas fa-edit"></i>';
            html += '</button>';
            html += '<button type="button" class="btn btn-danger btn-delete-lesson btn-sm px-3">'
            html += '<i class="fas fa-times"></i>'
            html += '</button>';
            html += '</td>';
            html += '</tr>';
        return html;
    }
};

var LessonUpdate = function (lessonId, lessonTitle, lessonDescription, lessonPrice, lessonVideo, lessonImage, lessonFile) {
    this.id = 0;
    this.lessonId = lessonId;
    this.lessonTitle = lessonTitle;
    this.lessonDescription = lessonDescription;
    this.lessonPrice = lessonPrice;
    this.lessonVideo = lessonVideo;
    this.lessonImage = lessonImage;
    this.lessonFile = lessonFile;
};

LessonUpdate.prototype = {
    setId: function (id) {
        this.id = id;
    },
    getHtml: function () {
        var html = '<tr>';
            html += '<th scope="row" class="rowLesson">'+ this.id +'</th>';
            html += '<td class="titleCol">'+ this.lessonTitle +'</td>';
            html += '<td>';
            html += '<button type="button" style="margin-right: 5px;" class="btn btn-edit-lesson btn-primary btn-sm px-3" data-bs-toggle="modal"';
            html += 'data-bs-target="#editLesson" data-lessonCurrentId="'+this.lessonId+'">';
            html += '<i class="fas fa-edit"></i>';
            html += '</button>';
            html += '</td>';
            html += '</tr>';
        return html;
    }
};
