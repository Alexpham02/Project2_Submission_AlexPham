---
title: "API Endpoints"
---

## Authentication

- `POST /api/auth/login`  
  Body: `{"email":"...","password":"..."}`  
  Returns: `access_token`, `refresh_token`.

- `POST /api/auth/refresh`  
  Uses a refresh token in the `Authorization: Bearer` header to issue a new access token.

## Books (require access token)

- `GET /api/books` – list all books  
- `POST /api/books` – create a book  
- `GET /api/books/{id}` – get a book  
- `PUT /api/books/{id}` – update a book  
- `DELETE /api/books/{id}` – delete a book  
- `GET /api/books/search?title=...` – search by title or author  
- `GET /api/books/borrowed` – list books borrowed by the current user

