result of phpunit:
```
PHPUnit 7.0.1 by Sebastian Bergmann and contributors.

...............................................................  63 / 164 ( 38%)
............................................................... 126 / 164 ( 76%)
......................................                          164 / 164 (100%)

Time: 4.04 seconds, Memory: 16.00MB

OK (164 tests, 497 assertions)
```

### The issue

When run against a MySQL (MariaDB 10.2.12) database the transaction fails with a row count mismatch regardless of whether the Exception is thrown in src/Child/ChildMapperEvents.php
When run against an sqlite file database the transaction performs correctly, regardless of whether the exepction is thrown. 

### Setup test environment 

create mysql db on 'localhost' named 'testing' with user named 'test' and password 'test'
or edit PDO in tests/mysql_test.php and phinx.yml to perform migration 


```
composer update

vendor/bin/phinx migrate

```

I've created two files, both identical apart from the connection used. The Sqlite backed store performs correctly.
The MySQL backed store does not.


### Output of sqlite_create.php no Exception thrown
```
> php tests/sqlite_create.php
Created record 1 ok
```


### Output of sqlite_create.php with Exception thrown beforeInsert of Child
```
> php tests/sqlite_create.php
The Transaction failed:
persist Test\Parent\ParentRecord via Test\Parent\ParentMapper threw exception Some error
```


### Output of mysql_create.php regardless of Exception thrown
```
> php tests/mysql_create.php 
The Transaction failed:
persist Test\Parent\ParentRecord via Test\Parent\ParentMapper threw exception Expected 1 row affected, actual 0.
```

