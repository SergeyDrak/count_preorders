## CONTENTS OF THIS FILE


* Introduction
* Requirements
* Installation
* Configuration


## INTRODUCTION


The One Punch counting module is a program for counting the number of preorders of a set of N elements for small N.
For example, consider a set of 3 elements A={1, 2, 3}.
From this set, 29 sub-orders can be made.
The functionality is implemented in two ways:
1. Creating a Drupal(drush) console command, when launched, the possible number of preorders of a given set is displayed in the console.
2. Creating a Drupal block. Which can be displayed on any page. And by selecting the required set, get the result according to the selected set.

## MAIN FILE WITH LOGIC.
**`onePushTrait.php`**


## REQUIREMENTS


No special requirements


## INSTALLATION


Install as you would normally install a contributed Drupal module. Visit
https://www.drupal.org/docs/8/extending-drupal-8/overview for further
information.


## CONFIGURATION

1 Option
To run in the console version, run the command drush in the console
drush one_punch_counting:count-preorders
Option 2
On the block administration page (_`/admin/structure/block`_) display the Counting one push block in the region and pages where it is necessary. Go to the selected page.
And select the required option in the form. And through the Ajax request below you will see the result for the selected option.
