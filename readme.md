# Nektcub



### Docker setup

*Assuming [docker](https://www.docker.com/) and [docker-compose](https://docs.docker.com/compose/) to be installed.*

1. Build and run the stack

```sh
$ docker-compose build
$ docker-compose up -d
```

2. Get the bridge IP address

```sh
$ docker network inspect bridge | grep Gateway | grep -o -E '[0-9\.]+'
# OR an alternative command
$ ifconfig docker0 | awk '/inet:/{ print substr($2,6); exit }'
```

3. Update the system's hosts file with the IP retrieved in **step 2**.

 ```sh
# nano /etc/hosts
```
> {IP_FROM_STEP_2} nektcub.local

* Get PHP internal bash: `docker-compose exec php bash`
* Drop : `docker-compose exec php bash`

### Execute all tests:
 `./vendor/bin/simple-phpunit`
 
### Case Use command line example:

* Symfony console:
 
help: `calculate-volume-intersection-of-2-cubes --help`

example command: `symfony app:calculate-volume-intersection-of-2-cubes 0 0 0 3 1 1 1 3`

### Endpoint rest example:

* HTTP client: http://nektcub.local/api/cube/volume?x1=0&y1=0&z1=0&edge1=3&x2=3&y2=0&z2=0&edge2=3


`
