# Book Review

Welcome to the Book Review System project! This system allows users to log in/out,insert book in book listing, review books, and perform other related actions.

## Features
- User authentication: Users can register, log in, and log out securely.
- Book review: Users can read and write reviews for books.
- Book rating: Users can rate books.
- Book search: Users can search for books by isbn.
- User profile: Users can view and update their few profile information.

## Technologies Used
- PHP: Backend development
- MySQL: Database management
- Statefull Token: Authentication mechanism

## Getting Started

### Installation
1. Clone the repository:
```bash
    git clone github.com/iamgak/bookreview
```

2. Navigate to the project directory:
```bash
    cd bookreview
```

3. Set up the database:
    - Create a MySQL database named `bookreview`.
    - Import the database schema from `database/schema.sql`.


6. Run the server:

```bash
    php -S localhost:8080 .index.php
```

7. Access the application:
    Open your web browser and navigate to `https://localhost:8000`.

### Usage
- Register a new user account `https://localhost:8000/register/`.
- Validate account `https://localhost:8000/user/activation/activation-token/` activation-token is in user table after registration in activation_token attribute.
- Login/Logout in with existing credentials `https://localhost:8000/login` / `https://localhost:8000/logout`.
- Contact us By GetMethod `https://localhost:8000/review/contact_us/`. 
- and so on.

## Contributing
Contributions are welcome! If you'd like to contribute to this project, please fork the repository and submit a pull request with your changes.

