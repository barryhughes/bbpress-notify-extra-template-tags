# Extend bbPress Notify

Extends [bbPress Notify](https://wordpress.org/plugins/bbpress-notify/), making it possible to 
use the `[topic-author]` "shortcode" or template tag from within the new reply email subject 
and body fields.

### Backgound

[bbPress Notify](https://wordpress.org/plugins/bbpress-notify/) is a handy plugin that can help 
[bbPress](https://bbpress.org) forum admins to customize and control the notification emails 
that are dispatched when new topics or replies are created, etc.

At time of writing however [bbPress Notify](https://wordpress.org/plugins/bbpress-notify/) has
not been updated for ~3 years and, though it remains both functional and useful, there are a few 
oddities (one can't for example include a reference to the topic author from the new reply email). 
This plugin adds that functionality.

### Misc

* Writing this was a fun exercise, inspired by a 
[question in the bbPress forums](https://bbpress.org/forums/topic/add-tags-to-bbpress-notify/).
* Minimum requirements: PHP 7.1, WP 5.1 and bbPress 2.5.
* Do what you want with it! Extend it some more, even. It _probably_ will not be developed any 
further, however (it was written on a whim/out of curiosity, more than anything).
* Note that if you try to verify things using an email logging plugin such as 
[Sudar's excellent Email Log](https://wordpress.org/plugins/email-log/) it _may_ appear that 
this plugin is not working...if so:
    * Check it is activated!
    * Remember that plugins like Email Log build on top of the same hooks this plugin uses&mdash;so
even if this plugin is doing its job correctly, the results may not be visible to the logger
