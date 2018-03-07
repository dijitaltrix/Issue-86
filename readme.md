### The issue

When inserting data in a loop using transactions, if the related child operation fails *on any transaction after the first*, then the parent is still created.

### Setup test environment 

create sqlite or mysql db on 'localhost' named 'testing' with user named 'test' and password 'test'
or edit PDO in tests/mysql_test.php and phinx.yml to perform migration 


```
composer update

vendor/bin/phinx migrate

```


I've created four files (sorry!), two for MySQL and two for Sqlite as I assumed the issue only occured with MySQL, however the problem occurs in both MySQL and Sqlite.

This only occurs when looping data.

In *fail_first the first transaction will fail and the rollback will perform correctly.

In *fail_after the previous transactions will complete successfully and the final transaction will fail, however if you check the database the parent record is created ([id] => 3)


I have run xdebug and it seems that the problem *may* lie in aura/sql/src/ExtendedPDO.php line 691 when $result = $this->pdo->inTransaction(); returns falsy.

Maybe it's the way I'm calling transactions, should there be a reset anywhere?