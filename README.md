# NuitInfo
Nuit de l'info 2022

# Sidamon
## Collectez-les toutes (no)

## Features

- Gagner des cartes pour chaques MST en répondant à des quizs
- Collectionner les cartes
- Echanger les cartes

## Installation

Migrer la base de donnée
```
php bin/console make:migration
php bin/console doctrine:migrations:migrate
```

Créer les ressources
```
php bin/console mst:create
php bin/console all:create
```
