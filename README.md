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
![screenshot](/images/joinery-logo.png)

Joinery provides services for CiviCRM including custom extension development, training, data migrations, and more. We aim to keep this extension in good working order, and will do our best to respond appropriately to issues reported on its [github issue queue](https://github.com/twomice/com.joineryhq.emaildouble/issues). In addition, if you require urgent or highly customized improvements to this extension, we may suggest conducting a fee-based project under our standard commercial terms.  In any case, the place to start is the [github issue queue](https://github.com/twomice/com.joineryhq.emaildouble/issues) -- let us hear what you need and we'll be glad to help however we can.

And, if you need help with any other aspect of CiviCRM -- from hosting to custom development to strategic consultation and more -- please contact us directly via https://joineryhq.com
