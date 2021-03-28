# Cinema ticket reservation

This application was created using modular monolith approach.

There are three modules: \
Cinema is simple CRUD to manage cinema halls. \
Schedule is module responsible for planning cinema shows. \
Reservation is module responsible for reservation of seats for a selected show.

### How to run on Linux
To run application you need docker and docker-compose.\
At first run:
```
bash bin/env.sh
```
and complete .env file. \
Next run:
```
bash bin/build.sh
```
### How to run test
```
bash bin/test.sh
```
### How to run static code analyse
```
bash bin/analyzse.sh
```