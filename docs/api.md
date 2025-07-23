# PawPaluza API Documentation

## Auth
- `POST /api/register` — Register (owner/sitter)
- `POST /api/login` — Login
- `GET /api/user` — Get authenticated user (auth)

## Pets (Owner)
- `GET /api/pets` — List pets (auth, owner)
- `POST /api/pets` — Add pet (auth, owner)
- `GET /api/pets/{id}` — View pet (auth, owner)
- `PUT /api/pets/{id}` — Update pet (auth, owner)
- `DELETE /api/pets/{id}` — Delete pet (auth, owner)

## Sitters
- `GET /api/sitters/nearby?latitude=...&longitude=...&radius=...` — List sitters nearby (public)

## Listings (Sitter Services)
- `GET /api/listings` — List all listings (public)
- `GET /api/listings/{id}` — View a listing (public)
- `POST /api/listings` — Create listing (auth, sitter)
- `PUT /api/listings/{id}` — Update listing (auth, sitter, owner only)
- `DELETE /api/listings/{id}` — Delete listing (auth, sitter, owner only)

## Bookings
- `POST /api/bookings` — Create booking (auth, owner)
- `GET /api/bookings` — List bookings (auth, owner/sitter)
- `GET /api/bookings/{id}` — View booking (auth, owner/sitter)
- `PUT /api/bookings/{id}` — Update booking (auth, owner/sitter)
- `DELETE /api/bookings/{id}` — Cancel booking (auth, owner/sitter)

## Reviews
- `POST /api/reviews` — Add review (auth, owner)
- `GET /api/reviews?sitter_id=...` — List reviews for sitter (public)

## Availability (Sitter)
- `POST /api/availability` — Set availability (auth, sitter)
- `GET /api/availability` — View availability (auth, sitter)
- `PUT /api/availability/{id}` — Update availability (auth, sitter)
- `DELETE /api/availability/{id}` — Delete availability (auth, sitter)

---
- All endpoints requiring authentication use `auth:sanctum` middleware.
- Roles: owner = pet owner, sitter = service provider.
- For endpoints with (auth, owner/sitter), both roles can access if they are the resource owner.
- For endpoints with (auth, sitter), only sitters can access their own availability and listings.
- For endpoints with (auth, owner), only owners can manage their own pets and bookings. 