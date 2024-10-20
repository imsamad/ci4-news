### Three prereq pkgs for ci4
sudo apt install php-mbstring
sudo apt install php-intl

this-> forge => Database class to interact with db for CRUDing tables metadata

/opt/lampp/bin/mysql -u root -p

code /opt/lampp/etc/php.ini
extension=mbstring

/opt/lampp/bin/php -m | grep mbstring

/opt/lampp/bin/php -v
php --ini

### Map routes
code /opt/lampp/etc/httpd.conf

### Imp php spark cmds
php spark make:controller AuthController
php spark make:migration create_user_table
php spark migrate
php spark make:seeder UserSeeder
php spark db:seed UserSeeder
php spark make:filter AuthFilter and set alias in Filters file

### For log
log_message('info', 'AuthFilter arguments: ' . print_r($arguments, true));


<?php $validation = \Config\Services::validation(); ?> in login.php view

### Extends helpers 
protected $helpers = ["url", "form"];
set_value("login");

### Form validation

<?php $validation = \Config\Services::validation() ?>

<?php if ($validation->getError('name')): ?>
<span class="text-red-500 text-sm"><?= $validation->getError('name') ?></span>
<?php endif; ?>
$isValid = $this->validate([
"email" => [
"rules" => "required|valid_email|is_not_unique[users.email]",
"errors" => [
"is_not_unique" => "Email does not exist!"
]
],
"password" => "required|min_length[5]|max_length[45]"
]);


"validation" => $this->validator
$this->validator->setError('email', 'Email has been blocked by admin');
