<h1>Twitter app</h1>
<h2>Set up DB variables in .env file</h2>

<code>
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=twitter
DB_USERNAME=root
DB_PASSWORD=root
</code>
<h2>Runn Migration</h2>
<code>php artisan migrate </code>
<h2>Start server</h2>
<code>php artisan serve </code>
