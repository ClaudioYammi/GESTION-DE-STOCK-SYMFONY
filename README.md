# Application web de gestion de stock

![Symfony](https://img.shields.io/badge/symfony-%23000000.svg?style=for-the-badge&logo=symfony&logoColor=white)
![PHP](https://img.shields.io/badge/php-%23777BB4.svg?style=for-the-badge&logo=php&logoColor=white)

![HTML5](https://img.shields.io/badge/html5-%23E34F26.svg?style=for-the-badge&logo=html5&logoColor=white)
![CSS3](https://img.shields.io/badge/css3-%231572B6.svg?style=for-the-badge&logo=css3&logoColor=white)
![Bootstrap](https://img.shields.io/static/v1?style=for-the-badge&message=Bootstrap&color=7952B3&logo=Bootstrap&logoColor=FFFFFF&label=)
![Laragon](https://img.shields.io/static/v1?style=for-the-badge&message=Laragon&color=0E83CD&logo=Laragon&logoColor=FFFFFF&label=)
![MySQL](https://img.shields.io/static/v1?style=for-the-badge&message=MySQL&color=4479A1&logo=MySQL&logoColor=FFFFFF&label=)
![Composer](https://img.shields.io/static/v1?style=for-the-badge&message=Composer&color=885630&logo=Composer&logoColor=FFFFFF&label=)

Symfony Project stock management 
(Created by Claudio Yammi)
Install requirement 
```
- composer install
- composer update
```
Migrate database
```
- symfony console make:migration
- symfony console doctrine:migrations:migrate
```

To Run Server
```
- symfony serve -d
```

To Stop Server
```
- symfony server:stop
```

Add Account administrator (ratovondriakakygo@gmail.com) (password: administrateur2024)
```
- composer require --dev doctrine/doctrine-fixtures-bundle
- symfony console doctrine:fixtures:load
```



