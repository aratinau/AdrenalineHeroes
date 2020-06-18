Install
=======

`composer install`

`bin/console doctrine:migration:migrate`

`bin/console doctrine:fixtures:load`

"Careful, database will be purged."

answer `yes` 

Run the project
===============

if symfony is not installed : `curl -sS https://get.symfony.com/cli/installer | bash`

`symfony serve --no-tls`

La fixture va créer 5 produits, un avec 0 quantité, deux utilisés cette semaine et deux autres utilisés le mois prochain

Choices
======

J'ai choisi de créer une entité Product relié à une entité RentedProduct qui permet de gerer les dates de location du produit.

Si j'avais passé plus de temps j'aurais gérer les quantités.

J'aurais aimé également faire les calculs des promotions

Usage
=====

en POST sur `api/availability` avec comme body de la request :

```
{
	"rent_from": "2020-06-10",
	"rent_to": "2020-06-18"
}
```

Retourne les produits qui sont disponibles en dehors de ces dates, et qui sont en quantité supérieure à 0.
