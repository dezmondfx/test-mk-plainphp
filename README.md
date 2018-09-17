### First Setup

- Open the project Directory
- ``php composer.phar install`` // Only at first setup
- ``php composer.phar run server`` &&  ``php composer.phar run api`` 
- Make a DB ``` ./vendor/bin/phinx migrate ``` 
- Open ``` sqlite3 ``` inside ``` data ``` folder and select the DB ``` motork_dev_test ```
- Make a new SQL Table

```
CREATE TABLE leads (
  id int PRIMARY KEY,
  firstname varchar(20),
  lastname varchar(20),
  email varchar(64),
  phone varchar(20),
  cap varchar(5),
  privacy boolean,
  carId int
);
```

- Remember that you need to run server and api in order to work

    ``php composer.phar run server`` &&  ``php composer.phar run api`` 
    
    - Visit [http://localhost:8888](http://localhost:8888/)

### Tests

To run unit tests use this command:

```
$ composer run test
```

### Documentation

**Detail Page**
- I had configured the detail route to pass the carId (from the link path) to CarController
- CarController retreive current car details and store in a variable
- CarController include the detail page view that can now retrive details from the previous variable

**Form Implementation**
- In the form included in detail's view, I've implemented an action (`/newLead`) and an hidden parameter (carId)
- When the form is submitted, the new route retrive all POST parameters and pass them to `$leadController->sendLead($lead)` as an array
- In ``LeadController`` the Lead is stored in the DB (some validation process can be implemented in the future)
- After this action performing, the user will be redirect to `/successLead` that will show a custom view with a confirmation message

**Raccomendation Engine**
- When ``getDetail()`` is performed, a new function is called (`getSimilarCarsDetails`) that accept a `$carId` (the one of the current Car detail)
- The new function retrive all cars from DB and perform a very `rudimentary comparison` for all the tags suggested in the exercise description:
    - If the tag (Internal space, Segement, Fuel Type, etc...) of the current car is equal to the one of the compared car: `$affinityScore incremented by 1` else `do nothing`
    - This comparison is performed for every tag requested and is designed to give more importance to specific tags (example: the Fuel type can influence more than another tag, for this reason you can increment the $affinityScore by 2 insted of 1)
    - This will return an array [carId => affinityScore]
- Once that the comparison is done. The function sort the array (from most similar car to less similar car) and get the first `X` results
- For every ``$carId`` remained the function retrive all carsDetails and store them in a new array that will be processed in the detail view

**Bonus /showLeads**
- Visiting [http://localhost:8888/showLeads](http://localhost:8888/showLeads) you can check all leads sent by users (just for test purpose)