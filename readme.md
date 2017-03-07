# Test API

## Run on local machine with Docker

- Install [Docker Machine](https://docs.docker.com/machine/install-machine/) and [Docker Compose](https://docs.docker.com/compose/install/)
- Run next commands in terminal:

Create virtual machine
```bash
docker-machine create --driver virtualbox --virtualbox-hostonly-cidr "192.168.99.1/24" default
eval "$(docker-machine env default)"
```

Get VM IP
```
$ docker-machine ls
NAME    ACTIVE   DRIVER       STATE     URL                         SWARM
washe            virtualbox   Running   tcp://192.168.99.100:2376
```

And add this IP to your hosts file
```
192.168.99.100  api.knpst.dev
```

Run nginx container
```
docker run --name nginx-proxy --restart always -d -p 80:80 -p 443:443 -v /var/run/docker.sock:/tmp/docker.sock:ro dmitrymomot/nginx-proxy
```

Then run API:
```
docker-compose run -d api
```

Load dependencies
```
docker-compose run --rm deps
```

Migrations and seeds
```
docker-compose run --rm migrations
```

Done! API is availbale on this URL: http://api.knpst.dev


Run API tests
```
docker-compose run --rm tests
```

Artisan
```
docker-compose run --rm artisan
```

Composer
```
docker-compose run --rm composer
```

###PhpMyAdmin

Run PMA daemon
```
docker-compose run -d pma
```

And add new host into list
```
192.168.99.100  api.knpst.dev  pma.knpst.dev
```
Folow link [pma.knpst.dev](http://pma.knpst.dev)
Login: root
Password: root
