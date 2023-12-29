# Hi

## Setting up

Please make a copy from `.env.exmple` and remove it's suffix then Just run the sail package!

## brief
*I wrote two commands to cache the data of two of the most used tables just to show the importance of speed in fetching information and in this sample code there is no specific amount of data caching:
- CacheAccountNumbersCommand::class
- CacheCartNumbersCommand::class

* sanctum package in implemented on all routes.
* In the SMS Service with the factory design , I made it possible to add different providers, currently only the program is connected to Kaveh Negar. It is possible to switch between providers through the value I set in the Env file (SMS_PROVIDER_SLUG),the value of sender numbers is put within env file as well.
* to fetch data from tables I find that it is better to fetch data from Cache at the first time and if data data does not exist, system will check data base rows.
* if you cant receive top message please use `3333` integer value for  your `verification_code`, I have set hard code value for it.
* I have used DB Transaction and Cache lock to avoid concurrency
* there is a json file in root of the project to import to the postman (Snapp!.postman_collection.json)
* I made some feature tests for project to get familiar  with my testing method.

best regards in advance :)

