$(document).ready(() => {

  var userId = String($(".sesion").val());
  var currentChat = null;

  $('#formMessageInput').hide();

  getPreviewsMessages();

  $(document).on('click','.preview-message', function(){
     currentChat = $(this).data("conversationid");

     if(currentChat != null) {
       $('#formMessageInput').show();
     } else {
       $('#formMessageInput').hide();
     }

     getChatMessages();
 })

  $(".publicar-btn").on('click', (event) => {
    event.preventDefault();
    var content = $('#contentMessage').val();

    if(content != ''){
        createMessage(content, userId, currentChat);
        $('#contentMessage').val('');
    }

  });

  $('#InputSearchUser').keyup( () => {
      getSearchUsers($('#InputSearchUser').val());
  });

  function getChatMessages() {
    var messageData = {
        vAction: 'SA',
        InputIdEmmiter: userId,
        InputIdReceiver: currentChat
    };

    $.ajax({
       url: "../controllers/chat.php",
       type: "POST",
       data: messageData,
       dataType: 'json',
        success: function(data) {
          if(data)
            $('.global').empty();

          data.forEach(message => {
              var newMessage = new Message(message.MESSAGE_ID, message.ID_EMMITER, message.CONTENT, message.CREATION_DATE,
                                            message.VIEWED, message.FIRST_NAME, message.LAST_NAME, message.USER_ID);
              $('.global').append(newMessage.getHtml(userId));
          });

          $('.global').scrollTop( $('.global').prop('scrollHeight') );
       },
       error: function(XMLHttpRequest, textStatus, errorThrown) {
            alert("Status: " + textStatus); alert("Error: " + errorThrown);
        }
    });
  }

  function createMessage(content, idEmmiter, idReceiver) {
    var messageData = {
        vAction: 'I',
        InputContentMessage: content,
        InputIdEmmiter: idEmmiter,
        InputIdReceiver: idReceiver
    };

    $.ajax({
       url: "../controllers/chat.php",
       type: "POST",
       data: messageData,
       dataType: 'json',
        success: function(data) {
           if(currentChat) {
             getChatMessages();
             getPreviewsMessages();
           }
       },
       error: function(XMLHttpRequest, textStatus, errorThrown) {
            alert("Status: " + textStatus); alert("Error: " + errorThrown);
        }
    });
  }

  function getPreviewsMessages() {
    var messageData = {
        vAction: 'SP',
        InputUserId: userId
    };

    $.ajax({
       url: "../controllers/chat.php",
       type: "POST",
       data: messageData,
       dataType: 'json',
        success: function(data) {
          if(data)
            $('.previewMessages').empty();

          data.forEach(previewMessage => {
              var newPreviewMessage = new MessagePreview(previewMessage.USER_ID_EMMITER, previewMessage.USER_ID_RECEIVER,
                                                        previewMessage.FIRST_NAME_EMMITER, previewMessage.LAST_NAME_EMMITER,
                                                        previewMessage.FIRST_NAME_RECEIVER, previewMessage.LAST_NAME_RECEIVER,
                                                        previewMessage.CONTENT);
              $('.previewMessages').append(newPreviewMessage.getHtml(userId));
          });
       },
       error: function(XMLHttpRequest, textStatus, errorThrown) {
            alert("Status: " + textStatus); alert("Error: " + errorThrown);
        }
    });
  }

  function getSearchUsers(searchText) {
    var messageData = {
        vAction: 'SU',
        InputSearchText: searchText,
        InputUserId: userId
    };

    $.ajax({
       url: "../controllers/chat.php",
       type: "POST",
       data: messageData,
       dataType: 'json',
        success: function(data) {
          if(data)
            $('.previewMessages').empty();

          data.forEach(previewMessage => {
            if(previewMessage.USER_ID_EMMITER) {
              var newPreviewMessage = new MessagePreview(previewMessage.USER_ID_EMMITER, previewMessage.USER_ID_RECEIVER,
                                                        previewMessage.FIRST_NAME_EMMITER, previewMessage.LAST_NAME_EMMITER,
                                                        previewMessage.FIRST_NAME_RECEIVER, previewMessage.LAST_NAME_RECEIVER,
                                                        previewMessage.CONTENT);
              $('.previewMessages').append(newPreviewMessage.getHtml(userId));
            } else {
              var newUserChat = new UserPreviewSearch(previewMessage.USER_ID, previewMessage.FIRST_NAME, previewMessage.LAST_NAME);
              $('.previewMessages').append(newUserChat.getHtml());
            }
          });
       },
       error: function(XMLHttpRequest, textStatus, errorThrown) {
            alert("Status: " + textStatus); alert("Error: " + errorThrown);
        }
    });
  }
});
