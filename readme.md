create mysql db named 'testing' with user named 'test' and password 'test'
composer update
vendor/bin/phinx migrate
vendor/bin/atlas-skeleton.php --full --conn=db/conn.php --dir=src --table=parents Test\\Parent
vendor/bin/atlas-skeleton.php --full --conn=db/conn.php --dir=src --table=parent_children Test\\Child
composer update

php tests/create.php
