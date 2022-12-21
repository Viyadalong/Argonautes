# Needs
- PHP 7.4 ou 8.0+
- DDB MySQL 5.7+

# Instructions
- This project is a name's list of the Argonauts' crew member.
- You can add some names or see the other applicants if you are not the 1st member to enlist.
- For a better reading, the list is slipt into 3 columns with their names in alphabetical order.

# Installation
- Clone this project
- Do `composer install` (if PHP 7.4, then do `composer update`)
- Create an `.env.local` at the root of this project, add the variable `DATABASE_URL` and configure it depending your own local environment/database
- Do `php bin/console doctrine:database:create` then `php bin/console doctrine:schema:create`
- Do `php bin/console doctrine:fixtures:load` to initializing the DDB with some test datas.
- Do `yarn install` then `yarn encore dev --watch` to build Webpack Encore / Symfony UX.
- Launch a web server to link to the web app(do `symfony server:start` for the Symfony local server (or create a virtual host for example)
- The project is ready.