# Integer-Spiral

The purpose of this project, Build an API which create layouts with spiral form, get layout and get value of layout's cell. Spiral form representative picture is given below.

![image](https://user-images.githubusercontent.com/61617734/170842611-ec5f6513-7e40-4665-a7d6-0207eda58184.png)

## About API

### api/createlayout
It creates a layout with spiral form. It uses POST method, takes 2 parameter and returns id of layout.
- x: Row Size.
- y: Column Size.
- layout_id(Return Value): Id of layout.

![image](https://user-images.githubusercontent.com/61617734/170872279-e0370d2b-23dd-4e1c-8890-04e3f0a51ef0.png)

### api/getlayouts
It uses GET method. It returns all layouts informations of layouts. These are described below.  
- layout_id(Return value): Unique id of layout.
- x_axis_size(Return value): Row size of layout.
- y_axis_size(Return value): Column size of layout.

![image](https://user-images.githubusercontent.com/61617734/170872257-bf01cd99-b939-4c9b-b890-309019f3f20d.png)

## api/getvalue
It uses GET method. It returns the cell value of the layout according to the entered id, x and y coordinate values.
- id: This represent to layout_id.
- x: This represent to x coordinate of layout.
- y: This represent to y coordinate of layout.
- value_of_given_coordinate(Return value): Proper cell value.

![image](https://user-images.githubusercontent.com/61617734/170872226-e40732b8-6d53-48d8-b0b6-cc7d5adf4218.png)

## api/documantation
It returns API document. It provides UI for request methods. You can test request methods here.

![image](https://user-images.githubusercontent.com/61617734/170890417-f15fa242-c84a-48cb-bc54-3f76160b880a.png)

- api/createlayout
Example UI looking is given below for createlayout method.
<p>
<img src="https://user-images.githubusercontent.com/61617734/170890497-21325c2b-d499-4213-8ab2-6494ea2060e1.png" width="45%">
<img src="https://user-images.githubusercontent.com/61617734/170890549-7f580755-3d87-4367-814a-8f2b143e866e.png" width="45%">
</p>

- api/getlayouts
Example UI looking is given below for getlayouts method.
<p>
<img src="https://user-images.githubusercontent.com/61617734/170890672-4c12d78c-a35e-465f-bc96-f58fc22f701c.png" width="45%">
<img src="https://user-images.githubusercontent.com/61617734/170890685-e35c0de4-10ca-4a1d-896e-4dd9049e4369.png" width="45%">
</p>

- api/getvalue
Example UI looking is given below for getvalue method.
<p>
<img src="https://user-images.githubusercontent.com/61617734/170890733-b80e8dbb-79b6-4684-ba76-7374f0dd4b80.png" width="45%">
<img src="https://user-images.githubusercontent.com/61617734/170890769-b255b1f1-3df4-4f79-aaec-272efbb7d9ec.png" width="45%">
</p>

## FOR LIVE DEMO
You can check https://mapintegerspiral.herokuapp.com

- https://mapintegerspiral.herokuapp.com/api/createlayout
You can access it with POST method. It Takes 2 parameter which are x and y. The Response will be id of layout. Example request is given below.

![image](https://user-images.githubusercontent.com/61617734/171026135-982abcb9-75fd-4e7e-9fca-823ad7f478ec.png)


- https://mapintegerspiral.herokuapp.com/api/getlayouts
You can access it with GET method. The Response will be all layouts in the database. Example request is given below.

![image](https://user-images.githubusercontent.com/61617734/171026614-fc40bdcc-3ba2-4e37-ae17-258822f2d9c9.png)


- https://mapintegerspiral.herokuapp.com/api/getvalue
You can access it with GET method. It takes 3 parameter which are id,x and y. The Response will be cell value of layout. Example request is given below.

![image](https://user-images.githubusercontent.com/61617734/171027171-418f9e9f-23eb-4a3e-af69-c20ab3b34521.png)
