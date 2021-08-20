Fichier d'installation pour le projet HERITAGE

Préconditions : 

- Avoir un serveur local (ex: Wampserver)
- Avoir une version de PHP > 7.1 idéalement = 7.3
- Avoir Composer installé >= 2.0.13


Pour installer le projet, à la racine de celui ci, taper la commande suivante :
  ```sh
   $ composer install 
   ```

Puis rendre dans le fichier .env pour commencer la configuration : 

- Database variables
    - `DB_NAME` - Database name ('heritage')
    - `DB_USER` - Database user ('root')
    - `DB_PASSWORD` - Database password ('')
    - `DB_HOST` - Database host ('localhost')
    - Optionally, you can define `DATABASE_URL` for using a DSN instead of using the variables above (e.g. `mysql://user:password@127.0.0.1:3306/db_name`)
- `WP_ENV` - Set to environment (`development`, `staging`, `production`)
- `WP_HOME` - Full URL to WordPress home ('http://localhost/heritage/web')
- `WP_SITEURL` - Full URL to WordPress including subdirectory ('${WP_HOME}/wp')
- `AUTH_KEY`, `SECURE_AUTH_KEY`, `LOGGED_IN_KEY`, `NONCE_KEY`, `AUTH_SALT`, `SECURE_AUTH_SALT`, `LOGGED_IN_SALT`, `NONCE_SALT`
    - Generate with [wp-cli-dotenv-command](https://github.com/aaemnnosttv/wp-cli-dotenv-command)
    - Generate with [our WordPress salts generator](https://roots.io/salts.html)
    

Importer le dump sql (heritage.sql) dans la base de données renseignée dans le fichier .env (ici 'heritage')
Pour se faire, se rendre sur la database puis cliquer sur Importer.

La base de données contient les url commencant par "http://localhost/heritage/web", il est impératif que ce nommage soit respecté pour que le site fonctionne convenablement.
