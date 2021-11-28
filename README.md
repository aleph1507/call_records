## Setup

Clone, run `composer install`, `npm install` and serve

## "Features"

### Home
On the home screen you can upload a csv file containing call records.
If there are previous records, the new ones will be appended.  Right below the csv upload control, there is a "Erase all records" button which erases all records.
Following the mass deletion button there is a filter section where you can query the records using a combination of user, client and type of call.
Just below the filter section there is the call records table. The last column is a single record deletion button and the penultimate column holds a view/edit product details link.

### Records
Clicking the "Record" navigation bar button takes you to '/record/new' where you can manually add a single record.
Same view is used for viewing and editing record details at '/{product}'. At the bottom of the view/edit
screen there is the record's user name, the user's average score for valid calls, and that users 5 last calls
in the same format as found in the index page
