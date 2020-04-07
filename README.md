#DOCKER COMPOSE for WORDPRESS

## Installation
```
docker-compose up -d
```

## Document
PATH
```
http://localhost:8585/ 
```

PhpMyadmin
```
http://localhost:8686/ 
```

Delete Custom Post and Meta
```
delete
p,pm
from dx36fd_posts p
join dx36fd_postmeta pm on pm.post_id = p.id
where p.post_type = 'shelter'
```