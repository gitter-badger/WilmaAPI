# WilmaAPI

[![Join the chat at https://gitter.im/Elektroniikka/WilmaAPI](https://badges.gitter.im/Join%20Chat.svg)](https://gitter.im/Elektroniikka/WilmaAPI?utm_source=badge&utm_medium=badge&utm_campaign=pr-badge&utm_content=badge)
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
