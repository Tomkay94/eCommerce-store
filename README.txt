Students:
Sunny Li              g3sunny
Thanasi Karachotzitis g3karach

*** AMI ID ***
ami-f04dde98

*** Source Location ***
/var/www/html/estore

*** Setup Instructions ***
// Recursively change the image permissions to allow for upload
chmod 777 -R /var/www/html/estore/images/product

// Start apache
sudo service apache2 restart

Goto localhost in the browser

*** Side Notes ***
-Be sure to open all the required ports for MySQL and SMTP
-The the EC2 ip address may be blocked from sending email, if this
 is the case, please retry on another server with different ip address.

*** Browser Details ***
Please use Google Chrome or Firefox

*** How It Works ***

Controllers:
-Cart
-Checkout
-Order
-Store
-User

Cart:
Cart is simply a built-in PHP library which handles quantities, 
pricing and sessions right out of the box. It required very little 
configuration. It come with several methods which caluclates several 
useful functions such as total cost of all the cart items, the number 
of items in the cart, and each items price and quantity. The cart is 
destroyed on user logout. For any user who  visits the site when they
 are not signed in, the cart creates a session, this way when the user 
 chooses to make an account, the cart persists once the user logs on 
 and they can go directly to checkout to complete their order.

Checkout:
The Checkout controller simply handles taking in the Cart session 
data and taking in user credit card information (and validating it)
 in order to perform a valid transaction. Afterwhich, the checkout 
 controller sends an email to the user with a receipt of their order 
 contents, users can also view their receipt from the checkout view 
 after the order has been finalized.

Order:
The Order controller creates order objects and allows typical CRUD 
manipulation. Each order contains details about items, prices, total 
prices, the date and time the order was created on, as well as the 
customer who completed this order. The Order controller also sends 
the user their order details in the form of a receipt after their 
order has been finalized and recorded in the database. The order 
controller also creates a route to view a printable source of the 
receipt on checkout.

Store: 
The store controller is a typical CRUD controller which allows Users 
to browse the store products and create a shopping cart of the items 
they may wish to purchase. Each product within the store has its own 
view, and can be updated or deleted only by the admin user.

User:
The User controller is composed entirely of session handling actions. 
When a user is created, the user object is stored in a session, and 
destroyed when the user logs out. The admin user has all fields called
 'admin', and is the only user with the ability to delete all users 
 and orders. Admins however, cannot checkout items, though they can
  edit and delete them from the product list.

**About the Admin**
To access the abilities of the admin user, please create an account 
with all fields called admin (the email can be admin@something.com).
 As the admin, when you visit the products page, you can also choose 
 to delete products and edit them. You can also view a list of all 
 users (accessible via an added link in the navbar), where you can 
 view and delete user records if you wish, or all of them at once. 
 Orders are similar, you can view all orders via the Orders List 
 link in the navbar, and perform a deletion of all records, or single
  records. As an admin, you can also add products to the store.

*** Custom Configurations ***
If you wish to use your own email to send purchase receipts, please 
goto /var/www/estore/application/controllers/order.php and 
/var/www/estore/application/config/email.php to edit the $config 
array with your email providers necessary protocol details and login
 information.