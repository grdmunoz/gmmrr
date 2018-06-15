# gmmrr
Gerard's mighty morphing router ranger

# Simple demonstration of a routing class. 

This demo allows you to dynamically create and test nested and unested RESTful routes

This demo requires that Composer is installed and assumes that PHP is correctly configured

the *PatientsController* and *PatientsMetricsController* classes and functions have been added manually for demonstration purposes, the controllers are not automatically generated

Run "composer install" in the root directory

Run the server localy with "php -S localhost:8000 index.php" from the root directory
Use a tool like Postman or Curl to submit posts to the server using the segments listed below and look at the app.log file for verification that the controller functions where reached with the appropriate parameters 

# Generate routes
in index.php the routes are instantiated as follows

$router->resource('Patients')

$router->resource('Patients.Metrics');

# Router match function

router match function passes in the URL segment and matches it against the defined routes, if the route matches either resource and required parameters, it will write the successful function call to the app.log file at the root of the application
 
$router->match($_SERVER);


## Unnested routes 

| Method | Segment      | Controller class name | Controller method | Parameters                                                      |
| ------ | ------------ | --------------------- | ----------------- | --------------------------------------------------------------- |
| GET    | /patients    | PatientsController    | index             | none                                                            |
| GET    | /patients/2  | PatientsController    | get               | this should invoke `get($patientId)` where $patientId = 2       |
| POST   | /patients    | PatientsController    | create            | none (extra credit for handling the request body)               |
| PATCH  | /patients/2  | PatientsController    | update            | `update($patientId)`                                            | 
| DELETE | /patients/2  | PatientsController    | delete            | `delete($patientId)`                                            |


## Nested routes

| Method | Segment                    | Controller class name         | Controller method name | Parameters                           |
|------- | -------------------------- | ----------------------------- | ---------------------- | ------------------------------------ |
| GET    | /patients/2/metrics        | PatientsMetricsController     | index                  | `index($patientId)`                  |
| GET    | /patients/2/metrics/abc    | PatientsMetricsController     | get                    | `get($patientId, $metricId)`         |
| POST   | /patients/2/metrics        | PatientsMetricsController     | create                 | `create($patientId)`                 |
| PATCH  | /patients/2/metrics/abc    | PatientsMetricsController     | update                 | `update($patientId, $metricId)`      | 
| DELETE | /patients/2/metrics/abc    | PatientsMetricsController     | delete                 | `delete($patientId, $metricId)`      |
