# Integer-Spiral

The purpose of this project, Build an API which create layouts with spiral form, get layout and get value of layout's cell. Spiral form representative picture is given below.

![image](https://user-images.githubusercontent.com/61617734/170842611-ec5f6513-7e40-4665-a7d6-0207eda58184.png)

## About API

### api/createlayout
It creates a layout with spiral form. It uses POST method, takes 2 parameter and returns id of layout.
- x: Row Size.
- y: Column Size.
- layout_id(Return Value): Id of layout.

![image](https://user-images.githubusercontent.com/61617734/170871266-9040f6c1-070f-4a48-b89a-166088a2c4c6.png)

### api/getlayouts
It uses GET method. It returns all layouts informations of layouts. These are described below.  
- layout_id(Return value): Unique id of layout.
- x_axis_size(Return value): Row size of layout.
- y_axis_size(Return value): Column size of layout.

![image](https://user-images.githubusercontent.com/61617734/170871291-2790d912-a6db-484b-8e91-d8e4060a5459.png)

## api/getvalue
It uses GET method. It returns the cell value of the layout according to the entered id, x and y coordinate values.
- id: This represent to layout_id.
- x: This represent to x coordinate of layout.
- y: This represent to y coordinate of layout.
- value_of_given_coordinate(Return value): Proper cell value.

![image](https://user-images.githubusercontent.com/61617734/170871309-74228404-e65b-49d8-a262-8a46d62e6482.png)
