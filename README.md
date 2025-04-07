# Laravel GraphQL Learning Project

This is a hobby project for learning and experimenting with GraphQL using the Laravel framework and the [Lighthouse PHP package](https://lighthouse-php.com/).

## About the Project

This project is built with Laravel and integrates GraphQL capabilities using Lighthouse. It serves as a playground to explore GraphQL concepts, schema design, and query execution in a Laravel environment.

### Key Features

- **GraphQL API**: Built using the Lighthouse PHP package.
- **Laravel Framework**: Provides a robust backend foundation.
- **Custom Resolvers**: Learn how to implement custom GraphQL resolvers.
- **Schema Directives**: Experiment with schema directives for advanced GraphQL features.

## Getting Started

Follow these steps to set up the project locally:

### Prerequisites

- PHP >= 8.0
- Composer
- Node.js and npm
- A database (e.g., MySQL, SQLite)

### Installation

1. Clone the repository:
   ```bash
   git clone https://github.com/anisAronno/GraphQL-from-Laravel
   cd GraphQL-from-Laravel
   ```

2. Install PHP dependencies:
   ```bash
   composer install
   ```

3. Install JavaScript dependencies:
   ```bash
   npm install
   ```

4. Copy the `.env.example` file to `.env` and configure your environment variables:
   ```bash
   cp .env.example .env
   ```

5. Generate the application key:
   ```bash
   php artisan key:generate
   ```

6. Run database migrations:
   ```bash
   php artisan migrate
   ```

7. Start the development server:
   ```bash
   php artisan serve
   ```

8. Compile frontend assets (if applicable):
   ```bash
   npm run dev
   ```

### GraphQL Playground

Lighthouse provides a GraphQL Playground for testing queries and mutations. Once the server is running, you can access it at:
```
http://localhost:8000/graphiql
```

## Learning Resources

- [Laravel Documentation](https://laravel.com/docs)
- [Lighthouse PHP Documentation](https://lighthouse-php.com/)
- [GraphQL Documentation](https://graphql.org/learn/)

## Contributing

This is a personal learning project, but contributions are welcome. Feel free to fork the repository and submit pull requests.

## License

This project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).