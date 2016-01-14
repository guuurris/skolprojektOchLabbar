This little application is like a small clone of twitter where every post can be read by anyone. 
Each user can follow any other member using this app and there is some textual filtering available so that you can search for specific post.
The Application is built using HTML, with AngularJS (javascript) together with bootstrap to make a nice structure and interface to be presented to the user.
Login and the auto-registration for the user is obtained by login through the Oauth2.0 using specificly the Google+ API to acomplish this.
The server side is built with PHP and a MySQL database that stores userdata.

To make application runnable 
1a). You first need set up a MySQL-database by using the MySQL workbench file (.mwb).
1b). Then make changes to the PHP file so that it connects to your database.
2a). You need to register this application with googles developers console and specify on which URL it will run from
2b) Then put the URL string recieved in the controller.js and replace current value for property clientid 

Now you should be good to go.