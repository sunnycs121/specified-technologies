# specified-technologies
 
Hi,

Please follow below steps to run the application:

1. Clone into to your local
2. Create DB table `specified-technologies`
3. Modify `.env` file to connect to DB
4. Run migrations `php artisan migrate`
5. As there needs to be atleast one user to test the application so please do either of following:
    - Create a new user by visiting `[BASE_URL]/register`
    
        OR
    - Run database seeder `php artisan db:seed`, it will create 2 dummy users, please get email from DB table users and password should be 12345678
6. Login
7. Go to `[BASE_URL]/tasklists` page

ISSUES and path I followed:
1. Due to lack of inertiaJs knowledge (as I mentioned in our call) first I was create api routes for CRUD in routes/api.php and API controller which wasted a lot of time 
2. Secondly I found out when PUT or DELETE request is sent to update task list or delete I am getting 303 status code back and upon some research I found out there needs to be 303 response code set with the redirect after PUT or DELETE per doc here: https://inertiajs.com/redirects#303-response-code but that did not work for me
3. After more research I went towards the direction of upgrading InertiaJs per github issues discussion here: https://github.com/laravel/jetstream/issues/351 following doc here: https://inertiajs.com/upgrade-guide but that messed up my application :( SORRY!
Jetstream installed inertia and its middleware automatically, I tried removing the middleware jetstream created and reinstalled inertia middleware `php artisan inertia:middleware` but that messed up things more.
