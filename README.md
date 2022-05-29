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
