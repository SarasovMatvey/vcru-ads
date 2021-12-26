### Install project:

1. git clone https://github.com/SarasovMatvey/vcru-ads.git vcruads
2. cd vcruads/
3. composer install
4. docker-compose up -d
5. docker ps -a
6. docker exec -it <app_container_id> /bin/bash
7. make migrations-migrate 
8. exit
9. done :)

### Usage:

Add - POST http://localhost:8080/ads  
Update - POST http://localhost:8080/ads/1  
Get relevant - GET http://localhost:8080/ads/relevant