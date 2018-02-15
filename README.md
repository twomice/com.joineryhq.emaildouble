# CiviCRM Email Doublecheck

Especially where CiviCRM profiles are used for creating new CMS user accounts, it can be useful to ask the user to enter the email address twice, aiming to help reduce error on this important bit of information.

This extension uses JavaScript to create a duplicate email address field and to ensure that the user enters the same email address twice. This functionality is enabled on a per-profile basis.

##Usage##
* Install as for any CiviCRM extension.
* Edit Settings for any profile; under the _Advanced Settings_ section, find the checkbox labeled "Require double-entry of primary email address (if field exists)?" Check this box to enable the Email Doublecheck functionality on this profile.

##Improvements##
This extension could benefit from the following improvements (among others that you may think of).

* Support for non-JavaScript functionality, i.e., server-side validation.
* Configurable error messages (but not that String Replacements can help with this).

##Support##
Please submit issues at https://github.com/twomice/com.joineryhq.emaildouble/issues/. Paid support is available; unpaid issues will be handled as time and interest allow.
