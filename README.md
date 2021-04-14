# Simple PHP MVC framework
Simple custom PHP MVC framework

## Core Package
> https://github.com/akandeBolaji/simple-php-mvc-core

----
## Installation

1. Clone the project using git
2. Create `.env` file from `.env.example` file and set database parameters and App Key
3. Run `composer install`
4. Run `php migrations.php` top migrate tables
5. Go to the `public` folder 
6. Start php server by running command `php -S 127.0.0.1:8080` 
7. Open in browser http://127.0.0.1:8080


## API Endpoints

## GET
Logout > http://127.0.0.1:8080/api/v1/logout

## POST
Register > http://127.0.0.1:8080/api/v1/register

Login > http://127.0.0.1:8080/api/v1/login
___

### GET Logout
Logout an Authenticated User

**Parameters**

|          Name | Required |  Type   | Description                                                                                                                                                           |
| -------------:|:--------:|:-------:| --------------------------------------------------------------------------------------------------------------------------------------------------------------------- |
|     `Authorization` | required | Bearer Token  | Auth user bearer token.                                                                     |

**Response**

```
// Sample Error 
Status Code - 400
{
    "message": "Logout failed",
    "data": {
        "errors": [
            "Invalid Authorization token"
        ]
    }
}

// Sample Success 
Status Code- 200
{
    "message": "Logout Successful",
}
```
___

___

### POST Register
Register a new user

**Parameters**

|          Name | Required |  Type   | Description                                                                                                                                                           |
| -------------:|:--------:|:-------:| --------------------------------------------------------------------------------------------------------------------------------------------------------------------- |
|     `firstname` | required | string  | user first name.           |
|     `lastname` | required | string  | user last name.           |
|     `email` | required | string  | user unique email name.           |
|     `password` | required | string  | Minimum of 8 characters           |
|     `passwordConfirm` | required | string  | password confirmation          |

**Response**

```
// Sample Error 
Status Code - 400
{
    "message": "Register failed",
    "data": {
        "errors": {
            "email": [
                "Record with this email already exists"
            ]
        }
    }
}

// Sample Success 
Status Code- 201
{
    "message": "Register Successful"
}
```
___
___

### POST Login
Login an existing user

**Parameters**

|          Name | Required |  Type   | Description                                                                                                                                                           |
| -------------:|:--------:|:-------:| --------------------------------------------------------------------------------------------------------------------------------------------------------------------- |
|     `email` | required | string  | user unique email name.           |
|     `password` | required | string  | Minimum of 8 characters           |

**Response**

```
// Sample Error 
Status Code - 400
{
    "message": "Login failed",
    "data": {
        "errors": {
            "password": [
                "Incorrect email or password"
            ]
        }
    }
}

// Sample Success 
Status Code- 200
{
    "message": "Login Successful",
    "data": {
        "Bearer Token": "YTQyMTVjMzJiOThjMzFhMmViODM1ODY0MTUyYjVmNjJiY2EzZTgzZjI4YTU1MTcxMDBkMmMxNDM3YWY0OWI1MzIwNjAxNmViZmRjOTczNDkxYTgyODI0NjUxNzExNGE5YzhiZjhjNjU0NzQ0ZTJiYjk1YTRkYWNlODQwM2IxMWXWn9FSp1XcfGuy01JWVHsxfEru1GbBpnfSRTAPlYcV62882cwk2aK1v7==",
        "Expires at": "2021-04-19T09:03:48.868379Z",
        "User": {
            "First name": "bolaji",
            "Last name": "akande",
            "email": "test@test.com"
        }
    }
}
```
___

