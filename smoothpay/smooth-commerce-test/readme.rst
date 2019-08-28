In this directory you can find All files regarding given tasks (/smooth-commerce-test)

This RESTful Api created in PHP's codeigniter framework.

Below is the list of APIs which perform given task to Add/Update/Delete operations in Products and Categories

1.Task:list all products
URL: /smooth-commerce-test/api/Products/
Method: GET

2.Task:retrieve a single product
URL: /smooth-commerce-test/api/Products/getSingleProduct
Method: POST
Parameters:
{
	"product_id":9
}

3.Task:create a product
URL: /smooth-commerce-test/api/Products/add
Method: POST
Parameters:
{
	"name":Muo Guo",
	"category":"Potato",
	"sku":"CC",
	"price":"20.25"
}

4.Task:Delete a product
URL: /smooth-commerce-test/api/Products/delete
Method: POST
Parameters:
{
	"product_id":8
}

5.Task: Allow the API users to update one or more attributes of a product at once
  Task: Allow the API users to update all attributes of a product at once (i.e., replace a product)

URL: /smooth-commerce-test/api/Products/update
Method: POST
Parameters:
{
	"name":"Guo",
	"category":"Ethiopia,Meat",
	"sku":"AA"
	"price":"10.25","product_id":9
}

6.Task:list all product categories

URL: /smooth-commerce-test/api/Category/
Method: GET
Parameters:
