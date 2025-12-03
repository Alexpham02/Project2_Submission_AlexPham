---
title: "Deployment Instructions"
---

## Local Development

From `code/library-api` run:

    ./run.sh

This script creates `.env`, generates the app key, installs Composer dependencies, runs migrations and seeds the database, and starts the Laravel API on port 8080.

## Docker Deployment

From `code/library-api` run:

    ./setup.sh

This builds the Docker image, starts the Laravel app and MySQL containers, runs migrations, and seeds the database automatically.

## Test Login

From any terminal (while the app is running):

    curl -X POST http://127.0.0.1:8080/api/auth/login \
      -H "Content-Type: application/json" \
      -d '{"email":"phama2@mymail.nku.edu","password":"Library123!"}'

