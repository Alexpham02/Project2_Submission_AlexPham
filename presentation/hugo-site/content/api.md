---
title: "API Endpoints"
---

##authentication

- `POST /api/auth/login`  
  Body: `{"email": "...", "password": "..."}`  
  Returns: `access_token`, `refresh_token`.

- `POST /api/auth/refresh`  
  Uses a refresh token in the `Authorization: Bearer` header to issue a new access token.

##books requires access token

- `GET /api/books` – list all books  
- `POST /api/books` – create a new book  
- `GET /api/books/{id}` – get a specific book  
- `PUT /api/books/{id}` – update a book  
- `DELETE /api/books/{id}` – delete a book  
- `GET /api/books/search?title=...` – search by title or author  
- `GET /api/books/borrowed` – list books borrowed by the current user

##borrowing

- `POST /api/borrow/{book}` – borrow a book  
- `DELETE /api/return/{book}` – return a borrowed book
