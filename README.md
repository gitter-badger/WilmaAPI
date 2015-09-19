# WilmaAPI
Simple Wilma API
# Example
Get upcoming exams page
```php
include_once('api.php');
$wilma = new Wilma("wilma.city.fi");
$wilma->connect();
$wilma->login("first.second", "password");
echo $wilma->getPage("/exams/calendar");
$wilma->end();
```
