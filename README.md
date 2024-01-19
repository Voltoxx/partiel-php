# Escape Game NWS

Bienvenue dans le projet Escape Game NWS ! Ce projet est un mini-jeu d'énigmes où les utilisateurs peuvent ajouter, répondre et supprimer des questions. Les statistiques de réussite sont également suivies.

## Installation

1. Clonez le dépôt vers votre machine locale :

    ```bash
    git clone https://github.com/votre-utilisateur/escape-game-nws.git
    ```

2. Assurez-vous que vous avez un serveur PHP et une base de données MySQL installés.

3. Importez la base de données à partir du fichier SQL fourni (`escape_game.sql`) qui se situe dans le dossier /bdd.

4. Mettez à jour le fichier `config.json` dans le répertoire racine avec les détails de votre base de données.

## Configuration

Assurez-vous de configurer correctement le fichier `config.json` avec les détails de votre base de données.

```json
{
  "host": "localhost",
  "username": "votre_utilisateur",
  "password": "votre_mot_de_passe",
  "database": "escape_game"
}
```

## UTILISATION 

1. Accédez à votre application via le navigateur web.

2. Ajoutez des questions, répondez-y et suivez vos statistiques de réussite.

3. Profitez du jeu et partagez-le avec vos amis !

## FONCTIONNALITÉS

- Ajout de questions

- Réponse aux questions

- Suppression de questions

- Suivi des statistiques de réussite