D5. Design Group6 07/24/2020

1.Description: Our project is to build an e-commerce store. By using our software, sellers can create their own web pages and manage their own web pages very easily. Sellers can add more than one administrator. Every administrator can edit the web pages. For example, putting new items on the web pages or hiding existing items, adding descriptions to items, and categorizing items already on the web pages. Managers can also upload pictures of goods so that consumers can shop more conveniently. Consumers can shop freely through our website. Add your favorite items to your shopping cart and change the number of products in the shopping cart. Our e-commerce store can provide a takeaway website for some small businesses. And some new brands can use our e-store to set up their own official websites. Our aim is to provide convenience for entrepreneurs, as our e-store is a free service. Link: GitHub: https://github.com/YHL555/CS386 Trello: https://trello.com/b/GwJDNydU/cs386-group6

2.Architecture
![Image](https://github.com/YHL555/CS386/blob/master/D51.png)

Class Diagram

4.Sequence diagram

Use Case: shopping Actor: the customer Description: The user can shopping on website freely Pre-Conditions: Consumers want to buy Post-Conditions: Consumers have patience to wait for delivery Main Flow & Alternative Flows : Consumers are required to register an account if they make their first purchase on this website. The consumer already has an account, logs in, and starts shopping. Add your favorite items to your shopping cart. Select the shipping address and pay. Consumers can also view their shopping history and update their personal information.

Use Case: manage a website Actor: the manager Description: The manager edit items on the website and review orders. Pre-Conditions: Consumers placed an order Post-Conditions: Customers didn’t cancel it. And items in stock. Main Flow & Alternative Flows : Managers edit websites that sell goods. View consumer completed orders.

5.Design Patterns

Link: https://github.com/YHL555/CS386/blob/master/ecom/public/login.php

Link: https://github.com/YHL555/CS386/blob/master/ecom/public/item.php

6.Design Principles

Single responsibility principle: link Only the customer landing page is displayed. Open/closed principle Liskov substitution principle :link It can be used on any web page Interface segregation principle Dependency inversion principle
