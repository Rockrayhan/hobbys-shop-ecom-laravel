### database diagram 

1. categories
- id, name , slug

2. Products
- id, category_id (FK), name, slug, image, description, price, stock

3. users
- id, name, phone, email, password, address

4. carts
- id, user_id (FK)

5. cart_items
- id, cart_id (FK), product_id (FK), quantity, unit_price

6. orders
- id, user_id (FK), total_amount, payment_method, payment_status, payment_txn_id, delivery charge, order_status , address, is_inside_dhaka, city, district

7. order_items
- id, order_id (FK), product_id (FK), quantity, unit_price 


8. reviews 
- id, user_id(fk), product_id(fk), rating, comment, status, 




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


