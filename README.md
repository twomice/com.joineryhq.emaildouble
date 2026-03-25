# CiviCRM Email Double-Check

Especially where CiviCRM profiles are used for creating new CMS user accounts, it can be useful to ask the user to enter the email address twice, aiming to help reduce error on this important bit of information.

This extension uses JavaScript to create a duplicate email address field and to ensure that the user enters the same email address twice. This functionality is enabled on a per-profile basis.

## Usage
* Install as for any CiviCRM extension.
* Edit Settings for any profile; under the _Advanced Settings_ section, find the checkbox labeled "Require double-entry of primary email address (if field exists)?" Check this box to enable the Email Double-Check functionality on this profile.

## Improvements
This extension could benefit from the following improvements (among others that you may think of).

* Support for non-JavaScript functionality, i.e., server-side validation.
* Configurable error messages (but of course String Replacements can help with this).

## Support

Support for this package is handled under Joinery's ["Limited Support" policy](https://joineryhq.com/software-support-levels#limited-support).

Public issue queue for this package: https://github.com/twomice/com.joineryhq.emaildouble/issues
