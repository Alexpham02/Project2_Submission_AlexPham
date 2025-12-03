---
title: "Deployment Instructions"
---

## Local Development

From `code/library-api`:

    ./run.sh

This script:

1.creates `.env`
2.generates the app key
3.installs Composer dependencies
4.runs migrations and seeds the database
5.starts the Laravel API on port 8080

##docker deployment

From `code/library-api`:

    ./setup.sh

This will:

1.build the Docker image
2.start the Laravel app and MySQL containers
3.run migrations and seed automatically

## Test Login

From any terminal on your machine (while the app is running):

    curl -X POST http://127.0.0.1:8080/api/auth/login \
      -H "Content-Type: application/json" \
      -d '{"email":"phama2@mymail.nku.edu","password":"Library123!"}'

