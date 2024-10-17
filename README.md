# DB-project

## Contributors
- Mateo Pico (front end developer)
- Harishi Velavan (database developer)
- Nikolay Tsonev (back end developer)

This repo is for the documentation of our project and uploading the files for submission for Databases and Web services course


## Week 2

This week we have updated our ER model to more accurately and consisely show the model we plan to use for our databse. Additionally we have added the schema at test.sql that initializes our databse with all the entities and relationships displayed in our ER model. 

![image](https://github.com/user-attachments/assets/6d8b9725-39d1-459c-bf07-3e38ff4d385b)
<p align="center">figure 1: ER Model</p>

## Week 4

We have:
- created our CD along side images and logos for our frontend (All of this can be found under assignment_5) 
- Created the basic fronted in HTML (which can be found in the root directory of this repo index.html)
- hosted our fronted using github pages
<br>

Because of github pages, the index file must always be in the root of the directory or in the docs folder. Apart from the index file, every other frontend and backend file will be found in seperate folders. The website can be reached by visiting [findyourgspot.eu](http://findyourgspot.eu)

<br>

![image](./assignment_4/homepage_screenshot.png)
<p align="center">figure 2: Homepage</p>

for now the website looks like this but will be changed and improved on in future weeks by adding more features and interactions for the usrer. 

## Week 5

This week, the frontend form was implemented. Before the user even sees the form, they have an introductory text. For now it is very bare bones but will be improved in the future. After that a form is presented. All the error handling is done on the front end. If none of the inputs were modified, the user will be notified. Otherwise the data is converted to a JSON with it being:  
  
<div style="text-align: center;">
    <code>{ categorie: howImportantItIs }</code> 
</div> 
  
and sent to the php server using AJAX.

For now the server only responds with a success or failure and then notifies the user, but in the future the response will be the block that best suits the user and its attributes. 

<div style="text-align: center;">
    <video width="320" height="240" controls>
    <source src="./assignment_5/demo-of-ajax.mp4" type="video/mp4">
    Your browser does not support the video tag.
    </video>
</div>

<p align="center">figure 3: Homepage Demo Video</p>