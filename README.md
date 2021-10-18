# Real Digital Systems

## Introduction
A shop's order and voucher creation system needs to be moved from monolithic approach to a distributed approach. 
For example Microservice

## Running the System

### Prerequisites
* Docker

### Endpoint
* http://real.digital/api/v1/order?email=rooshan@elakiri.com&value=300

## Chosen solution
![](https://i.imgur.com/GOH8AO5.png)
* Docker container for each functions
    * Redis container for Queue
    * API Gateway container (Lumen)
    * Order Container (Lumen)
        * Order DB instance (MySQL)
    * Voucher Container (Lumen)
        * Voucher DB instance (MySQL)

User sends an order request to api gateway. Api gateway creates a job to create the order and push into the queue.
Then, Order instance, listen for the queue (orders). Then, after verifying the order and adding it to the database.
another job is created for a voucher instance (Failed jobs of orders are put back into the queue for retrying).  

### Deployment
* Each container can be different,
    * Kubernetes pods in a cloud with auto-scaling option
    * EC2(AWS), ComputeEngine (GCloud) instances with advanced configuration for auto-scaling

### Improvements
* Redis instance can be replaced with a SQS kind of solution for managed approach
* Communication (Email, SMS) can be in a separate container(module) for more controller approach
* Authentication and Authorization mechanism
* Instead of Redis queue powerful service like rabbitMQ, Kafka
* Pub/Sub method for frontend if the voucher is sent to website's inbox or as a notification
* Unit Test cases, API test cases

## Other Solution
### Full Cloud Architecture
![](https://i.imgur.com/T4lzmYS.png)

* concept based on fully cloud architecture (AWS is used but GCloud, Azure are supported as well)
* This is basic idea and lacks several components. (Authentication, frontend, etc)
* Main advantage being, never have to worry about the scaling.
* Precise logs (Cloud Watch), zero downtime, fully managed and hassle-free solution
* Main disadvantage is the bills can be enormous depending on the load
