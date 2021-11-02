var Card = function (paymentMethodId, method, cardHolder, cardNumber, expMonth, expYear) {
    this.paymentMethodId = paymentMethodId;
    this.method = method;
    this.cardHolder = cardHolder;
    this.cardNumber = cardNumber;
    this.expMonth = expMonth;
    this.expYear = expYear;
};

Card.prototype = {
    setId: function (paymentMethod) {
        this.paymentMethodId = paymentMethodId;
    },
    getHtml: function () {
        var html = null;

        if(this.method == 'visa'){
          html = `
          <div class="debit-card mb-3 mt-3">
              <div class="d-flex flex-column h-100"> <label class="d-block">
                      <div class="d-flex position-relative">
                          <div> <img src="https://www.freepnglogos.com/uploads/visa-inc-logo-png-11.png"
                                  class="visa" alt="">
                              <p class="mt-2 mb-4 text-white fw-bold">${this.cardHolder}</p>
                          </div>
                          <div class="input">
                            <input type="radio" name="card" class="cardSelectedPM" data-cardid="${this.paymentMethodId}" data-cardnumber="${this.cardNumber}">
                          </div>
                      </div>
                  </label>
                  <div class="mt-auto fw-bold d-flex align-items-center justify-content-between">
                      <p>${this.cardNumber}</p>
                      <p>${this.expMonth}/${this.expYear}</p>
                  </div>
              </div>
          </div>
          `;
        } else {
          html = `
          <div class="debit-card card-2 mb-3 mt-3">
              <div class="d-flex flex-column h-100"> <label class="d-block">
                      <div class="d-flex position-relative">
                          <div> <img
                                  src="https://www.freepnglogos.com/uploads/mastercard-png/mastercard-logo-png-transparent-svg-vector-bie-supply-0.png"
                                  alt="master" class="master">
                              <p class="text-white fw-bold">${this.cardHolder}</p>
                          </div>
                          <div class="input">
                            <input type="radio" name="card" class="cardSelectedPM" data-cardId="${this.paymentMethodId}" data-cardnumber="${this.cardNumber}">
                          </div>
                      </div>
                  </label>
                  <div class="mt-auto fw-bold d-flex align-items-center justify-content-between">
                    <p>${this.cardNumber}</p>
                    <p>${this.expMonth}/${this.expYear}</p>
                  </div>
              </div>
          </div>
          `;
        }

        return html;
    }
};
