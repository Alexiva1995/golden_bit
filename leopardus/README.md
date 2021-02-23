## Leopardus
System made in PHP / Laravel for all types of use, CMS, ERP, ECOMMERCE, AIO. 

## Development rules
	+ Database
		+ All the names of the tables must be in English and separated by a hyphen under ("_").

## How to install
	Open the browser and then access the "/ install" path and follow the respective steps.

## Requeriments
	+ PHP >= 7.0.0
	+ OpenSSL PHP Extension
	+ PDO PHP Extension
	+ Mbstring PHP Extension
	+ Tokenizer PHP Extension
	+ XML PHP Extension

## Install composer.
It is important to have composer installed in our equipment and for this you must do it through its official site.
[Install Composer](https://getcomposer.org/doc/00-intro.md#installation-linux-unix-osx)

## First open the prompt of your operating system
	* If you use Windows, use cmd.exe
	* If you use Linux (Debian / Ubuntu) open your terminal

	Once the terminal is open, locate the place where we place the project. then execute the following command in your terminal
	$ git clone https://github.com/GALEJ/LEOPARDUS.git

## Install global dependencies

### Composer 

```
composer install
```

## If there is a problem
## Common mistakes:

### **First Run**

* **file_get_contents(): Filename cannot be empty**

	Check that the "**.env**" file located in the root of the project exists.
	If there is no **execute** the following command:

```
php -r "file_exists('.env') || copy('.env.example', '.env');"
```

* **No application encryption key has been specified.**
	
	**Execute** the following command:

```
php artisan key:generate
```

