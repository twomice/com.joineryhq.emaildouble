(function($, ts) {
  // Has emaildouble ever had a value? (Helps to avoid needless error messages,
  // e.g., when the user hasn't even entered a value in the emaildouble field.)
  // Once true, this will never be false again.
  var emaildoubleHasValue = false;

  /**
   * Record that emaildouble has changed, then validate.
   */
  var emaildoubleEmailDoubleChange = function() {
    emaildoubleHasValue = Boolean(CRM.$('input#email-Primary-emaildouble').val());
    emaildoubleValidate();
  }

  /**
   * Event handler: validate.
   */
  var emaildoubleValidateEvent = function(e) {
    emaildoubleValidate();
  }

  /**
   * Handle validation on form submit.
   */
  var emaildoubleValidateOnSubmit = function emaildoubleValidateOnSubmit(e) {
    if (!emaildoubleValidate(true)) {
      CRM.alert(ts('Email addresses do not match'), ts('Error'), 'error');
      e.preventDefault();
    }
  }

  /**
   * Validate and show/hide error message.
   * @param Boolena force If true, test regardless of whether emaildouble has
   *  ever had a value; otherwise, return true if emaildouble has never had a value.
   * @returns {Boolean}
   */
  var emaildoubleValidate = function emaildoubleValidate(force) {
    if (typeof force == 'undefined') {
      force = false;
    }
    console.log('force', force);
    console.log('emaildoubleHasValue', emaildoubleHasValue);
    if (!force && !emaildoubleHasValue) {
      return true;
    }

    var isValid = emaildoubleIsValid();
    if (isValid) {
      emaildoubleSetError(false);
      return true;
    }
    else {
      emaildoubleSetError(true);
      return false;
    }
  }

  /**
   * Do actual comparison of field values.
   * @returns Boolean
   */
  var emaildoubleIsValid = function emaildoubleIsValid() {
    return (
      CRM.$('input#email-Primary-emaildouble').val()
      && (CRM.$('input#email-Primary').val() == CRM.$('input#email-Primary-emaildouble').val())
    );
  }

  /**
   * Show/hide error message.
   * @param Boolean isError If true, show error message; otherwise, hide it.
   */
  var emaildoubleSetError = function emaildoubleSetError(isError) {
    if (isError) {
      $('span#emaildouble-error').show();
    }
    else {
      $('span#emaildouble-error').hide();
    }
  }

  // Clone the "row" div for the primary email field.
  $tr_clone = CRM.$('input#email-Primary').closest('div.crm-section').clone();
  // Find the primary email field in that clone.
  $emaildouble = $tr_clone.find('input#email-Primary');
  // Find the label so we can modify it.
  $emaildouble_label = $tr_clone.find('label');
  // Find any "required" marker. After we modify the label, we'll need to re-insert
  // this marker.
  $emaildouble_label_required = $tr_clone.find('label span');
  // Modify the cloned email field to be our emaildouble field.
  $emaildouble.attr('id', 'email-Primary-emaildouble');
  $emaildouble.attr('name', 'email-Primary-emaildouble');
  // Adjust the label.
  $emaildouble_label.html(ts('Repeat email address to confirm'));
  $emaildouble_label.append($emaildouble_label_required);
  // Remove any error messages on our cloned field.
  $tr_clone.find('span.crm-error').remove();
  // Unset the value on our cloned field.
  $emaildouble.val('');

  // Insert error message to show/hide.
  $emaildouble.after('<span id="emaildouble-error" class="crm-error" style="display: none;">Email addresses do not match</span>')
  // Finally, insert our emaildouble field row in the right place.
  CRM.$('input#email-Primary').closest('div.crm-section').after($tr_clone);

  // Add submit handler.
  CRM.$('input#email-Primary').closest('form').submit(emaildoubleValidateOnSubmit);

  // Be sure to hide the error message on page load.
  emaildoubleSetError(false);

  // Define event handlers for email and emaildouble fields.
  $('input#email-Primary-emaildouble').change(emaildoubleEmailDoubleChange);
  $('input#email-Primary-emaildouble').keyup(emaildoubleValidateEvent);
  $('input#email-Primary').keyup(emaildoubleValidateEvent);

})(CRM.$, CRM.ts('com.joineryhq.emaildouble'));

