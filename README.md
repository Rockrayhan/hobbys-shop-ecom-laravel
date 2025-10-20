### database diagram 

1. categories
- id, name , slug


2. Products
- id, category_id (FK), name, slug, image, description, Current_price,  previous_price, isOnSale 


3. users
- id, name, role, phone, email, password, address


<!-- 4. carts
- id, user_id (FK)


5. cart_items
- id, cart_id (FK), product_id (FK), quantity, unit_price -->



# orders 
- id, user_name, phone, address, is_inside_dhaka, delivery_charge, order_status, subtotal , grand_total


# order_items
- id, order_id (FK), product_id (FK), quantity, unit_price , total_price


8. reviews 
- id, user_id(fk), product_id(fk), rating, comment, status, 





user -> product -> add to cart -> checkout page
                -> buy now     -> checkout page



+------------+
|  payments  |
+------------+
| id (PK)    |
| order_id   |
| method     |
| status     |
| paid_at    |
+------------+


+-------------+ 
|   orders    |
+--------------+
| id (PK)      |
| name         |
| email        |
| password     |
| address...   |
+--------------+


=================================

+-------------+----- 
|   orders         |
+------------------+
| id (PK)          |
| name             |
| email            |
| total_amount     |
| payment_method   |
| payment_status   |
| payment_txn_id   |
| order_status     |
+------------------+


