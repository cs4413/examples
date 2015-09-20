# examples
Examples done in class for CS 4413

## formtest
This project has some examples of form-handling, with progressively more
complicated methods of registration handling (registration1.php - registration7.php).  

The project also introduces objects to hold the data from forms
(User and UserData) so that we can fill the form with old values when there is
an error.  

Finally, the project introduces the idea of internationalization by providing
a Message class and a text file (errors_English.txt) that contains errors.

## mvcdemo
This project is has the very stripped down structure of model-view-controller.
We will modify it in class.  

## mvctest
This holds a working MVC project with central controller and URL rewriting.

## mvcauto
This holds a working MVC project with central controller and URL rewriting. It also has some error-handling for models and autoloading. The controllers and views are wrapped in classes. However, no objects are being sent into the show methods of the views. Hence, when there is an error, the view blanks out all of the previous information.  This project is a good starting point for your lab 2.

## mvcform
This project starts with mvcauto and adds the correct form handling so that when a user makes an error, the message shows on the form and the form still has the values already typed.