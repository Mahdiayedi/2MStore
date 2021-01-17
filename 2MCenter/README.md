# 2M MEDICAL CENTER

### Introduction

Aim of project is to develop a medical website which could operate for the
analysis of symptoms seen in patient (user); moreover it is also helpful to get
information about diseases and their respective medicines, with help of which
user can get knowledge of medicines about when and at what situation it can be
used.

For the development of this project languages used are:

* PHP
* HTML
* AJAX
* JAVASCRIPT
* CSS (Designing)

Front-hand is handled using html and JavaScript, by the use of which userinterface is handled like navigation bar for navigating between different
webpages, content handling and its display is also done by same. Creating popup forms, validation and different functions and are handled by JavaScript and
php. Ajax is used for search implementation and hints provided during
searching. Database is managed by MySQL using php commands. Data fetching
and storing and handling of data is done by php commands. Firstly navigation bar contains’ Diseases’,’ Medicines’ pages for information,
quizzes, home and symptom checker for analysing symptoms. Information of
medicines and diseases are stored in table in database from which it is fetched
and displayed, specifically in these two pages vertical navigation is given to
navigate between stack of medicines and diseases. Other than these’ Quizzes’
are just for enhancing the interaction with user by showing score and knowledge
awareness of particular information. As commonly followed ‘About us‘ page is
also included which gives overall short introduction of ours and our specialities.
In ‘Home’ page also our extra features like BMI calculation and symptoms
checking are mentioned which are designed by css. Apart from these for
‘Symptom checking’ page is operated by image mapping concept, which is
helpful for searching for diseases and connected to database accordingly.


### Software Requirements

For the development of this project languages used are:

* **PHP:** Used as a Server Side Scripting Language.
* **HTML:** Used to make the Body of the Web Page.
* **AJAX:** Prevent Re-loading of the page and saves time by showing
output on the same page.
* **JAVASCRIPT:** Used to make web pages dynamic, often used to
validate forms.
* **CSS (Designing):** Used to Design the Web Page.
* **XAMPP:** Used as an alternative to Apache Server and MySQL
database for accessing PHP scripts.
* **MySQL DATABASE:** Used to store information in forms of table as a
relational model, accessed by SQL Queries.

#
1. **HOME-PAGE:**

Starting with the Home Page, we included two CSS file named ‘Header.css’
and ‘homepage.css’ these files contain the code for the styling of the page’s
top. Class ‘border’ defines border, ID ‘hints’ is used for the Search
implementation that becomes visible when the user type something on the
Search bar, ‘medictab’ defines the MedicInfo’s header, then the classes
‘dropdown’, ‘dropbtn’, ‘dropctn’ are all used to perform hover over the tabs.

![Home Page](homepage.png)

2. **SEARCH IMPLEMENTATION:**

```
<form action="SearchResults.php" method="GET" autocomplete="off">
<input type="text" name="search" placeholder="Search Diseases..." size="30" onkeyup="showHints(this.value)"/>
<input type="submit" value="Search" />
</form>
```



3. **DISEASE PAGE:**

Disease page deals with the 10 diseases listed on the page and using a frame for
displaying the result marking/highlighting the disease that is being displayed on the frame. This is done using the frame name and 10 HTML pages that are all
linked to the frame as a target through its name. When someone clicks the
vertical tabs, it links that page being called and displayed on the frame rather
loading a new page. The tabs on the left side gets highlighted showing the
current frame that is displaying on the page. This is done with the help of java
script that changes color when a link a pressed and keep all other thing same as
before. So for doing this it requires 10 such cases where this changes happens
therefore 10 times we have copy each thing then only changing the required link
color. This same goes for the Medicines page. 


4. **SYMPTOM CHECKER:**

In symptom checker page concept of image mapping is applied. Image of
human body is shown and link is created to body’s each part like head, legs, etc.
So user clicks on the part in which user has suffering, this makes site more
interactive and does less tedious work. After this each & every link is connected
to database of information of diseases and symptoms of that part of body which
is displayed when user clicks body part.



### Conclusion

Project was successfully completed with proper implementation of languages
like php, JavaScript, html and css. By the means of this project we came to
know many new concepts and ideas i.e. implementing search by ajax, using
imagemapping concept for recognizing and analysing symptoms of user.

