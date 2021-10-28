var Message = function (id, idEmmiter, content, creationDate, viewed, firstName, lastName, userId) {
    this.id = id;
    this.idEmmiter = idEmmiter;
    this.content = content;
    this.creationDate = creationDate;
    this.viewed = viewed;
    this.firstName = firstName;
    this.lastName = lastName;
    this.userId = userId;
};

var MessagePreview = function (userIdEmmiter, userIdReceiver, firstNameEmmiter, lastNameEmmiter, firstNameReceiver, lastNameReceiver, content) {
    this.userIdEmmiter = userIdEmmiter;
    this.userIdReceiver = userIdReceiver;
    this.firstNameEmmiter = firstNameEmmiter;
    this.lastNameEmmiter = lastNameEmmiter;
    this.firstNameReceiver = firstNameReceiver;
    this.lastNameReceiver = lastNameReceiver;
    this.content = content;
};

var UserPreviewSearch = function (id, firstName, lastName) {
    this.id = id;
    this.firstName = firstName;
    this.lastName = lastName;
};

Message.prototype = {
    setId: function (id) {
        this.id = id;
    },
    getHtml: function (idS) {

      var html = null;

      if(idS == this.idEmmiter) {
          html = `
          <div class="card">
						<div class="card-header message-m">
							<div class="col-12" style="text-align: right;">
								${this.firstName} ${this.lastName}
							</div>
						</div>
						<div class="card-body">
							${this.content}
						</div>
            <div class="card-footer">
              ${this.creationDate}
            </div>
					</div>
          `;
      } else {
        html = `
        <div class="card">
          <div class="card-header message-f">
            <div class="col-12">
              ${this.firstName} ${this.lastName}
            </div>
          </div>
          <div class="card-body">
            ${this.content}
          </div>
          <div class="card-footer">
            ${this.creationDate}
          </div>
        </div>
        ` ;
      }

        return html;
    }
};

MessagePreview.prototype = {
    setId: function (id) {
        this.id = id;
    },
    getHtml: function (idS) {

      var html = null;

      if(idS == this.userIdEmmiter) {
          html = `
          <a class="preview-message" data-conversationId="${this.userIdReceiver}">
            <div class="card col-12 preview" style="padding: 8px;">
              <div class="row">
                <div class="col-12">
                  <div class="col-12 user_name">
                      <h5>${this.firstNameReceiver} ${this.lastNameReceiver}</h5>
                  </div>
                  <div class="col-12 text-muted">
                      Tu: ${this.content}
                  </div>
                </div>
              </div>
            </div>
          </a>
          `;
      } else {
        html = `
        <a class="preview-message" data-conversationId="${this.userIdEmmiter}">
          <div class="card col-12 preview" style="padding: 8px;">
            <div class="row">
              <div class="col-12">
                <div class="col-12 user_name">
                    <h5>${this.firstNameEmmiter} ${this.lastNameEmmiter}</h5>
                </div>
                <div class="col-12 text-muted">
                    ${this.content}
                </div>
              </div>
            </div>
          </div>
        </a>
        `;
      }

        return html;
    }
};

UserPreviewSearch.prototype = {
    setId: function (id) {
        this.id = id;
    },
    getHtml: function () {

      var html =  `
      <a class="preview-message" data-conversationId="${this.id}">
        <div class="card col-12 preview" style="padding: 8px;">
          <div class="row">
            <div class="col-12">
              <div class="col-12 user_name">
                  <h5>${this.firstName} ${this.lastName}</h5>
              </div>
            </div>
          </div>
        </div>
      </a>
      `;

        return html;
    }
};
