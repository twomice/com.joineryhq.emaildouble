CRM.$(function($) {
  // Add id attribute to bhfe table, so it's easy to reference later.
  CRM.$('input#is_emaildouble').closest('table').addClass('emaildouble-bhfe-table');

  CRM.$('div.crm-uf-advancesetting-form-block table tbody').append(CRM.$('input#is_emaildouble').closest('tr'));  
  
  // Remove the bhfe table, but only if it's empty.
  if ($('table.emaildouble-bhfe-table tr').length == 0) {
    $('table.emaildouble-bhfe-table').remove();
  }

});