# Art-Store
Fundamentals of Web Development:<br>
PHP, SQL, State, Caching <br>
Release Date: December 1, 2021 <br>

@author Trong

------------------------------------------------------------------------
# Introduction

An introduction to server-side programming, using an Art Store template.

To get started, you need to have XAMPP up and running, and mainly 
written PHP code. You also need to have Apache and myPHPAdmin/MariaDB 
running, with the art database loaded, and a user account created, 
using the following credentials:

* Username: testuser
* Password: mypassword

------------------------------------------------------------------------
# Description

The program an online art store which allows users to search, browse, 
and select paintings filters by artist, museams, and shapes. The user
can navigate onto the single painting page to get more details on a 
specific painting. The user may also decide to add painting to a
favorites pages as well.

------------------------------------------------------------------------
# Requirements

This assignment requires the following XAMPP modules:

## Web solution stack
* XAMPP for Windows v7.4.25
* XAMPP Control Panel v3.3.0
	- [Download XAMPP Here](https://www.apachefriends.org/download.html)

## Web server
* Apache/2.4.51 (Win64) OpenSSL/1.1.1|PHP/7.4.25
* Database client version: libmysql - mysqlInd 7.4.25
* PHP extention: mysql, curl, mbstring
* PHP version: 7.4.25

## Database server
* Server: 127.0.0.1 via TCP/IP
* Server type: MariaDB
* Server version: 10.4.21-MariaDB - mariadb.org binary distribution
* Protocol version: 10
* User: root@localhost
* Server charset: UTF-8 Unicode (utf8mb4)

## Memcached
* php-7.4.x_memcache.dll
* memcached.exe
	- [Download Here](https://github.com/trong0dn/Art-Store/tree/main/external-dependencies)

------------------------------------------------------------------------
# Installation & Configuration

See reference documents:
* Software Installation.pdf (XAMPP Setup Instructions)
* Working with SQL.pdf (Setup MySQL and configurations)

Ensure that the web server and database server are running locally, the 
art database is loaded, and a user account with proper credentials 
exists.

Once XAMPP is downloaded unzip the repository files in "htdocs". 
Note: To activate Apache and MySQL. Access the landing page on the 
browser at:

http://localhost/art-store/browse-paintings.php

------------------------------------------------------------------------
# File Structure

<pre>
Assignment3.zip
├───css
│   ├───assets
│   │   └───fonts
│   ├───_styles.css
│   ├───icon.css
│   ├───semantics.css
│   ├───semantics.js
│   └───styles.css
├───images
│   └───art
│       └───works
│           ├───medium
│           ├───square-medium
│           └───square-small
├───includes
│   ├───class.inc.php
│   ├───config.inc.php
│   ├───database.inc.php
│   ├───functions.inc.php
│   ├───head.inc.php
│   ├───header.inc.php
│   ├───memcache.inc.php
│   └───session.inc.php
├───js
│   └───misc.js
├───addToFavorites.php
├───browse-paintings.php
├───detail.html
├───list.html
├───remove-favorites.php
├───single-paintings.php
└───view-favorites.php
</pre>
------------------------------------------------------------------------
## Step 1: PHP and SQL

### Overall Organization

1. Create PHP versions of the two supplied HTML files, named 
browse-paintings.php and single–painting.php, respectively for list.html
and detail.html. Extract the common header into a separate include file
named header.inc.php and extracted common head into a separate include
file called head.inc.php.

2. Generalize database retrieval code into separate classes, where 
functions.inc.php contains all the database queries function and some 
common functions used browse-paintings.php and single–painting.php.

3. The functions.inc.php require the include of database.inc.php which
contains the functions to connect to the data and close the database 
connection using PHP data objects approach. In otherwords, looping
through the result set and populating the appropriate objects upon 
query. Hence, letting an object populate itself.

4. The database.inc.php require the include of config.inc.php which 
has the defining connection details via constants.

5. The functions.inc.php also require the include of class.inc.php 
which contains the seperate classes for each result set query. 
Essentially each class object is created upon query to contain the
information for relevant rows in the database fields.

### Browse-painting Features

5.1. The user should be able to filter the list by specifying the 
artist or museum or shape in the three drop-down lists, populated from 
the Artists (sorted by last name), Museums (sorted by gallery name), 
and Shapes (sorted by shape name) tables. This was implemented by the 
querySelectFilter() method located in functions.inc.php via $_POST 
superglobal variables. The respective selection options is passed
directly into the SQL query.

5.2. Only display the top 20 matches for the filter. This is implement
with the outPainting() method.

5.3. Assume that the user will filter only by one of Artists, Museums, 
or Shapes.

5.4. Other features of the browse-painting can be found in the 
functions.inc.php file.

### Single-painting Features

6.1. Mostly all features of the single-painting can be found in the 
functions.inc.php file. This include query functions and output display
functions such as star ratings and related works.

6.2. This page needs to display data from some other tables (Galleries,
Genres, Subjects, and Reviews). The Frame, Glass, and Matt select lists
should be populated from the appropriate tables (TypesFrame, TypesGlass, 
TypesMatt). Single-painting.php should handle a missing or noninteger 
query string parameter by displaying a default painting for instance 
"Madonna Enthroned".

------------------------------------------------------------------------
## Step 2: State Management

### Adding Favorites to Sessions

1. Created addToFavorites.php such that when a used clicks on "Add to
Favorites" they get redirected to this page underneath a pretense of a
session using the $_SESSION superglobal variable.

2. Created session.inc.php which starts a new session, if a session does
not exist. This file is included in each .php document that uses or 
requres a session to be tracked such as browse-painting.php,
single-painting.php, view-favorites.php, addToFavorites.php, and 
remove-favorites.php.

3. Once the user clicks "Add to Favourites" in either 
browse-painting.php or single-painting.php it is redirected to 
addToFavorites.php which handle a GET request to add a painting to the 
favorites list. The addToFavorites.php also has another $_SESSION 
superglobal variable to keep track of the number of items in the 
favourites session array.

4. Immediately from the addToFavorites.php page, the user is redirected
to the view-favorites.php page which display all the favorites 
paintings stored in the current session. 

5. The assignment specification states to redirect from 
browse-painting.php or single-painting.php to addToFavorites.php which 
redirects to view-favorites.php. This is fairly cumbersome since each 
time the user adds to favorites they get redirected to
view-favorites.php page.

5. The view-favorites.php contains some simply html markup to display
the favorite paintings add by the user in the current session.

### Removing Favorites from Sessions

6. The user is able to remove single painting from favorites or the 
clear they entire favorite sessions. 

7. When a user clicks on "Remove" button in the view-favorite.php page,
they get redirected to the remove-favorites.php which handles the 
removal of one item in the favorites session or unset the entire 
favorite sesson thus clearing the session. The remove-favorites.php also
handles to decrement the $_SESSION counter.

8. From the remove-favorites.php, the user get redirected back to the 
remove-favorites.php page with the updated session.

9. The user can navigate to the view-favorite.php page via navigator 
menu bar in the header. 

10. Modified the header common to all files with markup to display a 
count of the items in the favorites list.

------------------------------------------------------------------------
## Step 3: Caching

1. Install memcache. Follow steps to test memcache outlined in 
Assignment3Handout.pdf.

2. Created memcache.inc.php which caches the browse-paintings.php as the
expected landing page. This includes headers, footers, markup, drop down
option selections for Artist, Museums, and Shapes. This also caches the
top 20 unfiltered paintings as well. Set this cache to store this
landing page information for 10 minutes.

3. The memcache.inc.php is included in the browse-painting.php since 
it is the page that we are attempting to cache.

4. Each time a user selects a filter option from the drop down menu 
which dynamically updates the page via a query search faciliated by 
functions directly to the database to updte the page. The updated 
content is cached for 1 minute.

5. The previously filtered images can be retrive via the cache
immediate rather that executing the database query.

6. The feature was tested but altering the database using the SQL inputs:

```sql
	alter table art.paintings rename to art.tmp
```

Previous filtered search options were available and displayed while 
new filters can not be display since it is not yet been cached.

7. By using the SQL query:

```sql
	alter table art.tmp rename as art.paintings 
```

It confirms that everything works again as expected.

------------------------------------------------------------------------
# Acknowledgement

Instructor of the course providing the starting materials and reference
documation to setup and configure XAMPP web stack. 

Connolly, R. & Hoar, R. (2018). Fundamentals of Web Development 
(2nd ed), Pearson Education.

The template Art database was from Connolly and Hoar.

------------------------------------------------------------------------
# Disclaimer

Copyright disclaimer under section 107 of the Copyright Act 1976, 
allowance is made for “fair use” for purposes such as criticism, 
comment, news reporting, teaching, scholarship, education and research.

Fair use is a use permitted by copyright statute that might otherwise 
be infringing.
