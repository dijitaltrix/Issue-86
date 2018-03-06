result of phpunit:
PHPUnit 7.0.1 by Sebastian Bergmann and contributors.

...............................................................  63 / 164 ( 38%)
............................................................... 126 / 164 ( 76%)
......................................                          164 / 164 (100%)

Time: 4.04 seconds, Memory: 16.00MB

OK (164 tests, 497 assertions)


## Steps required to reproduce my issue

create mysql db named 'testing' with user named 'test' and password 'test'
```
composer update
vendor/bin/phinx migrate
vendor/bin/atlas-skeleton.php --full --conn=db/conn.php --dir=src --table=parents Test\\Parent
vendor/bin/atlas-skeleton.php --full --conn=db/conn.php --dir=src --table=parent_children Test\\Child
composer update

php tests/create.php
```