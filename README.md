#  Escape Room

## <g-emoji class="g-emoji" alias="arrow_down" fallback-src="https://github.githubassets.com/images/icons/emoji/unicode/2b07.png">⬇️</g-emoji> Installation

This is a test app for just showing my code skills in laravel. Please clone the project and define a database and config it in .env file. Then run these commands listed below:

```bash
composer install
```
```bash
php artisan migrate
```
```bash
php artisan db:seed -> users table and rooms table and timeSlots table will be filled.
```
```bash
php artisan passport:install
```
```bash
php artisan key:generate
```
```bash
php artisan optimize
```
```bash
php artisan serve
```

There are 3 users seeded in database(test, navid and omid). You can login with each one using 12345678 password. I like to mention that today is test user birthday. Happy birthday to him!
I wrote a some tests for apis just as sample. You are welcome to run them by running <code>php artisan test</code> command

-----

## <g-emoji class="g-emoji" alias="book" fallback-src="https://github.githubassets.com/images/icons/emoji/unicode/1f4d6.png">📖</g-emoji> API's

### 1. api/login POST
```json
parameters:
    {
        "username":    "tes"
        "password": 12345678
    }

response:
    {
       "token_type": "Bearer",
       "expires_in": 172800,
       "access_token": "CJGREBNRFYMowA9vWuwfQFgkN_yaqVNMY-XecmQxXN-B6rw",
       "refresh_token": "CJGREBNRFYMowA9vWuwfQFgkN_yaqVNMY-XecmQxXN-B6rw",
       "user": {
          "username": "test",
          "birthday": "2023-06-07"
       }
    }
```

### 2. api/logout POST
```json
Response:
    {
      "message": "Successfully logged out!د"
    }
```

### 3. api/escape-rooms GET
```json
Response:
    {
        "data": [
            {
                "id": 1,
                "name": "Prison Break",
                "theme": "Red",
                "max_participants": 9,
                "price": 1000,
                "created_at": "2023-06-07T23:35:41.000000Z",
                "updated_at": "2023-06-07T23:35:41.000000Z",
                "deleted_at": null
            },
            {
                "id": 2,
                "name": "Enigma",
                "theme": "Blue",
                "max_participants": 6,
                "price": 2000,
                "created_at": "2023-06-07T23:35:41.000000Z",
                "updated_at": "2023-06-07T23:35:41.000000Z",
                "deleted_at": null
            },
            {
                "id": 3,
                "name": "Scary Lab",
                "theme": "White",
                "max_participants": 7,
                "price": 3000,
                "created_at": "2023-06-07T23:35:41.000000Z",
                "updated_at": "2023-06-07T23:35:41.000000Z",
                "deleted_at": null
            }
        ]
    }
```

### 4. api/escape-rooms/{id} Get
```json
Response:
    {
        "data": {
            "id": 1,
            "name": "Prison Break",
            "theme": "Red",
            "max_participants": 9,
            "price": 1000,
            "created_at": "2023-06-07T23:35:41.000000Z",
            "updated_at": "2023-06-07T23:35:41.000000Z",
            "deleted_at": null
        }
    }
```

### 5. api/escape-rooms/{id}/time-slots Get
```json
Response:
    {
        "data": [
            {
                "id": 1,
                "room_id": 1,
                "is_booked": 0,
                "start": "2023-06-05 09:00:00",
                "end": "2023-06-05 10:00:00"
            },
            {
                "id": 2,
                "room_id": 1,
                "is_booked": 0,
                "start": "2023-06-05 10:00:00",
                "end": "2023-06-05 11:00:00"
            },
            {
                "id": 3,
                "room_id": 1,
                "is_booked": 0,
                "start": "2023-06-05 11:00:00",
                "end": "2023-06-05 12:00:00"
            },
            {
                "id": 4,
                "room_id": 1,
                "is_booked": 0,
                "start": "2023-06-05 12:00:00",
                "end": "2023-06-05 13:00:00"
            }
        ]
    }
```

### 6. api/bookings  GET
```json
Response:
    {
        "data": [
            {
                "id": 1,
                "user_id": 1,
                "room_id": 3,
                "time_slot_id": 1,
                "birthday_discount": 1,
                "count": 3,
                "price": 8100,
                "created_at": "2023-06-07T23:59:02.000000Z",
                "updated_at": "2023-06-07T23:59:02.000000Z",
                "deleted_at": null
            },
            {
                "id": 2,
                "user_id": 1,
                "room_id": 2,
                "time_slot_id": 1,
                "birthday_discount": 0,
                "count": 3,
                "price": 6000,
                "created_at": "2023-06-08T00:01:26.000000Z",
                "updated_at": "2023-06-08T00:01:26.000000Z",
                "deleted_at": null
            }
        ]
    }
```

### 7. api/bookings    POST
```json
Parameters:
    {
        "timeSlot": "integer   >  min:1 max:500000  > required"
        "roomId":   "integer   >  min:1 max:500  > required "   
        "participants":   "integer  >  min:1 max:20  > required "   
    }

Response:
    {
        "data": {
            "user_id": 1,
            "room_id": 3,
            "time_slot_id": 1,
            "birthday_discount": true,
            "count": "3",
            "price": 8100,
            "updated_at": "2023-06-07T23:59:02.000000Z",
            "created_at": "2023-06-07T23:59:02.000000Z",
            "id": 1
        }
    }
```

### 8. api/bookings/{id}  DELETE
```json
Response:
{
    "data": "Booking with id 1 canceled successfully!"
}
```
