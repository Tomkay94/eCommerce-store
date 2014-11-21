Students:
Sunny Li              g3sunny
Thanasi Karachotzitis g3karach

*** AMI ID ***

*** Source Location ***
/var/www/estore

*** Apache Instructions ***
// Make sure an email client is installed
sudo apt-get install postfix

// Start apache
sudo service apache2 restart

*** Browser Details ***
Please use Google Chrome

*** How It Works ***

Controllers:
-Cart
-Checkout
-Email
-Order
-Store
-User

Cart:
Cart is simply a built-in PHP library which handles quantities, pricing and sessions right out of the box. It required very little configuration. It come with several methods which caluclates several useful functions such as total cost of all the cart items, the number of items in the cart, and each items price and quantity. The cart is destroyed on user logout. For any user who visits the site when they are not signed in, the cart creates a session, this way when the user chooses to make an account, the cart persists once the user logs on and they can go directly to checkout to complete their order.

Checkout:
The Checkout controller simply handles taking in the Cart session data and taking in user credit card information (and validating it) in order to perform a valid transaction. Afterwhich, the checkout controller sends an email to the user with a receipt of their order contents.

Email:
The Email controllers purpose is to send the user their order details in the form of a receipt after their order has been finalized and recorded in the database.

Order:
The Order controller creates order objects and allows typical CRUD manipulation. Each order contains details about items, prices, total prices, the date and time the order was created on, as well as the customer who completed this order.

Store: 
The store controller is a typical CRUD controller which allows Users to browse the store products and create a shopping cart of the items they may wish to purchase. Each product within the store has its own view, and can be updated or deleted only by the admin user.

User:
The User controller is composed entirely of session handling actions. When a user is created, the user object is stored in a session, and destroyed when the user logs out. The admin user has all fields called 'admin', and is the only user with the ability to delete all users and orders. Admins however, cannot checkout items, though they can edit and delete them from the product list.

*** Custom Configurations ***
If you wish to use your own email to send purchase receipts, please goto /var/www/estore/application/controllers/email.php and edit the $config array with your email providers necessary protocol details.