## Laravel Microservice-app

Steps:
1) Install the fresh Laravel
    cmd : composer create-project laravel/laravel microservice-app

2) Set your db in .env file

3) Make a model with migration (Product)
    cmd : php artisan make:model Product -m

4) Add Columns to your migration table

5) Run the migration
    cmd : php artrisan migrate

6) Add fillable properties to the Product Model

7) Create a product Controller
    cmd : php artisan make:controller ProductController

8) Add the api routes
    - To add a single product
    - To add multiple products
    - To delete the single product
    - To delete the multiple products
    - To show a single product
    - To show all products

9) Create a middleware
    cmd : php artisan make:middleware ValidateProductRequest

10) Middleware : Define Validation rule to validate single/multiple products

11) Register middleware in kernel

12) Resource: Create a resource 
    cmd : php artisan make:resource ProductResource

13) Resource: Modify return in the ProductResource

14) Controller: Create a conrtoller
    cmd : php artisan make:controller ProductController

15) Add necessary methods to your controller

16) Run and test your application via Postman
    cmd : php artisan serve

## RDHD IT Services
Web : https://rdhd.com.au
Fb : https://www.facebook.com/profile.php?id=61550779501786
Youtube : https://www.youtube.com/@RDHDITSERVICES