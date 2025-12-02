<h1 align="center" id="title">MIKCONF</h1>

<p align="center"><img src="https://socialify.git.ci/InsoniacX/mikrotik-configuration-web/image?language=1&amp;owner=1&amp;name=1&amp;stargazers=1&amp;theme=Light" alt="project-image"></p>

<h2>🛠️ Installation Steps:</h2>

<p>1. Cloning</p>

```
git clone https://github.com/InsoniacX/mikrotik-configuration-web.git
```

<p>2. Change Directory</p>

```
cd mikrotik-configuration-web
```

<p>3. Install Composer Depedencies</p>

```
composer run dev 
```

<p>4. Install npm</p>

```
npm install
```
<p>
<h2>How To Use</h2>
<p>1. Run Build</p>

```
npm run build
```

<p>2. Open Dashboard Controller and Find line </p>

```
$ip = '<your-router-ip>'; -> by Mikrotik default configuration it will use "192.168.88.1"
$username = '<your-username>'; -> by Mikrotik default configuration it will use "admin"
$password = '<your-password>'; -> by Mikrotik default configuration it will use nothing
```

<p>2. Run Locally</p>

```
composer run dev
```
or

```
php artisan serve 
```
and 
```
npm run dev
```
<p></p>
<h2>💻 Built with</h2>

Technologies used in the project:

*   Laravel 12.x
*   Livewire Starter Kit
*   RouterOS-API
*   Blade