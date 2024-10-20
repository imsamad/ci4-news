** 
## Set up guide


Clone this repo

```sh
docker compose up -d
``` 

##### Note:

MySQL may take about 30 seconds to start, so wait for it before running the next cmds

#### Migrate


```
docker exec -it app  php spark migrate
```

#### Seeders

```sh
docker exec -it app  php spark db:seed UserSeed

docker exec -it app  php spark db:seed PostSeed

```

The app will be accessible at http://localhost:8080

### Test user credentials
```js
Emails: 'user1@gmail.com,user2@gmail.com,user3@gmail.com, admin@gmail.com';
Password: '123456';
```

#### Issue: If getting any writable related error like this just set permissions and wwnership for the writable dir

![My Image](./image.png)

```sh
sudo chmod -R 755 app/writable && sudo chown -R www-data:www-data app/writable
```
**