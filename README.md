# template backend API - phalcon - php7

basic api structure with phalcon micro framework

user registration, login added (needs users table in DB - see user model for columns)

simple ACL

versioning - folder for each version of the API in app folder.

Potential structure:
```
www/
    projectName/
        app/
            v1/
            v2/
            v3/
            .
            .
            .
```
to add a new vesion just copy a folder of a version you want to have as starting point

**on first setup of a new project search for "ekranj" in all folders and replace with new projcet name, set config files in te etc folder, create users table**

