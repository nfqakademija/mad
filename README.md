![](https://avatars0.githubusercontent.com/u/4995607?v=3&s=100)
![](http://i.imgur.com/ZX4ZuEJ.jpg)
# niam
#### .NFQ Academy 2017 spring

---

**Requirements**

* [docker: >=17.x-ce](https://docs.docker.com/engine/installation/)
* [docker-compose: >=1.8.1](https://github.com/docker/compose/releases)

**How to start project?**

1. Download [this folder](https://github.com/nfqakademija/kickstart/tree/master/.docker) to project directory
2. Create .env file and copy text from .env.dist
3. Run these commands in terminal:

```bash

docker-compose up -d
docker-compose exec fpm composer install --prefer-dist -n
docker-compose run npm npm install
docker-compose run npm gulp

```

4. Go to `http://127.0.0.1:8000` and you should see index page

---

#### Contributors

- [Dominykas Šeputis](https://github.com/dqmis/)
- [Martynas Pečkaitis](https://github.com/MPeckaitis)
- [Aistis Čekanauskis](https://github.com/AistisCekanauskis)
- Darius Pėža


 



 
