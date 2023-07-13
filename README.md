# munch munch
Restaurant Managment Web Application


This is a Restaurant Management System that i built with Laravel
Website can be Used Entirly by Guest or Users
A User he can opt to create a new account or login to his account(custom Built login and registration system without using Breeze Package).
if user creates a new account he is sent an email with details about this project and also a verification link(which i custom built) to the email he registered with.

All the User Account CRUD operations (editing of email, name, address, etc..).
Email is checked with AJAX to make sure it's not taken.
User is able to Place an order through the menu, alternativly user can opt to reserve a table.
They will Recieve an email with the corridponding details about the order.

The user is able to see all active orders, they can be cancelled both from user's side or resturant's side and user is refunded(No Payment Gateways in the APP it's free to user), Orders that are ready for pickup(both by curior for delivery or pick-up) cannot be cancelled. If the order has been picked up by the Client, the restaurant can Mark the order as complete and it is processed to the completed orders section!. alternativly If Pickup by delivery curour, once the order is delivered the curor marks it as Deliverd and order is procedd to Completed Orders section, which then user can Rate the Order after that. 
If the user Decided to rate, the comment is gone directly to the home page (bottom section) in the "Featured" comments section, only if it has a rating of 4+

Either way if a user Reserves a table Through the website he is sent a resvation code on his email, he can also see Upcoming Reservations and past Reservations.
User can opt to cancel the reservation as needed, restaurant will be informed and moved to past reservation(Cancelled by User section). Alternativly Reservation can be cancelled by restaurant and moved to cancelled by resturant section, once a reservation is complete it's moved to the past reservations (Completed section), or if the guests are a no show, it can be moved to no show section 

All said above can Done By a Guest and sent to the email he enters either at checkout of order or Reservation.


You Can also register as a staff(staff has Roles )
-Manager
-supervisor
-FoodRunner
-Chefs

Managers have the highest Role, They can ediit menu items, Delete them, put them out of stock and vice-versa, and also create new ones,
they can also see all active and incative staff accounts, all active and inactive user accounts, all Upcoming or past reservations, and all Active and Complete Orders. Managaers are also able to edit staff and user account details if need be. he can deactive or reactive accounts both for user and staff accounts
hence giving them the highest Role

Supervisor has all the fetaures of a manager with being able to  edit account details for staff and users, also this role cannot delete menu items and deactive or reactive accounts


Continue Staff Section mention menu active user staff, markout of stock, Staff roles, editing menu , user accounts, 

