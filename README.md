# CodeIgniter 4 Project

## Setup Instructions

1. **Install Dependencies**
   ```bash
   cd app
   composer install
   ```

2. **Start Docker Containers**
   ```bash
   docker-compose up --build -d
   ```

3. **Access Application Container**
   ```bash
   docker exec -it app bash
   ```

4. **Run Development Server**
   ```bash
   php spark serve
   ```

## Troubleshooting Database Connections

If you encounter MySQL connection issues, you can use the database test file located at `public/test_db.php` to verify your connection.

This test file attempts to connect using the following environment variables (or defaults if not set):
- Hostname: `database.default.hostname` (default: 'db')
- Username: `database.default.username` (default: 'ci4_user')
- Password: `database.default.password` (default: 'ci4_password')
- Database: `database.default.database` (default: 'ci4')

The test script will display connection status and parameters used for debugging.