## Laravel Blog Project ##

Built using DevMarketer's "How to Build a Blog With Laravel" series as a guide! Access it here:

https://www.youtube.com/playlist?list=PLwAKR305CRO-Q90J---jXVzbOd4CDRbVx

______________________________________

This blog was created following DevMarketer's tutorials for the purpose of learning Laravel. The finished product, however, is very much usable!
It works as a CMS where a user can register and login to insert posts, create tags and categories, and where a non-logged user can visualize the blog posts and comment.

______________________________________

Requirements:

This project was built using Laravel 5.7, PHP 7.2 and mySQL 5.7.2, and it's recommended that the user configures the enviroment to use the same versions.

How to Use:

1. Clone the folder through git;
2. Use "composer install" in the blog folder to add the necessary files;
3. Configure the database info on the .env file, and the mail driver should the mail funcionality be tested too;
4. Use "php artisan migrate" to create the tables, and "php artisan db:seed" to populate them.
5. Generate the key with "php artisan key:generate";

After the proper setup, you can access the login with the credentials admin@gmail.com / 123456.
The seeds will create 10 random blogposts, with a few comments and an image on each.