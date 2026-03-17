<!-- ### database diagram 

1. categories
- id, name , slug


2. Products
- id, category_id (FK), name, slug, image, description, Current_price,  previous_price, isOnSale 


3. users
- id, name, role, phone, email, password, address


4. carts
- id, user_id (FK)


5. cart_items
- id, cart_id (FK), product_id (FK), quantity, unit_price



6. orders 
- id, user_name, phone, address, is_inside_dhaka, delivery_charge, order_status, subtotal , grand_total


7. order_items
- id, order_id (FK), product_id (FK), quantity, unit_price , total_price


8. reviews 
- id, user_id(fk), product_id(fk), rating, comment, status, 





user -> product -> add to cart -> checkout page
                -> buy now     -> checkout page
 -->





## E commerce Website

A user friendly E-commerce website — built with **Laravel**, **MySQL** , **Bootstrap**

### Live link: https://hobbyshop.ektukhanitech.com/

#### ✨ Features :

* An eCommerce system with product listing, categories, product details, add-to-cart, and cash-on-delivery order functionality.
* An Admin panel to manage products, categories, and customer orders, improving overall store management efficiency.
* Order tracking, basic SEO setup, fully responsive UI improving user experience.


#### Admin Credentials: 
- https://hobbyshop.ektukhanitech.com/login
- email : admin@gmail.com
- password: 123456789




