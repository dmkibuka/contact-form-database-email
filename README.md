# contact-form-database-email
Responsive Contact form that submits to database and sends email. Customer information is captured and stored in the database plus an option to be added to the mailing list. NOTE: Email messages are not stored in the database but sent out as emails

# index.html
Bootstrap/4.0.0-alpha.6. Any changes in names or fields must also be done in the process.php

# config.php
Enter your correct database credentials. username, host, password and server if neccessary.

# process.php
This is the form processing script. Change your email addresss in 4 instances in the lower half of the script

# mydemo
Use this sql file to create your database and tables. change your database name matches the name in your config file. if you renmae the tables make sure you rename the corresponding fields in the process.php file. If your remane the table fields them make sure to change the corresponding fileds in the process.php

# form.js
Only edit this if you have changed the form id on index.html or else its OKAY. ("#contactForm") to new name ("#mychangedname").