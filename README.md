#   Booking System PH

A sleek Laravel-based booking system for managing appointments and schedules with ease. Includes a dynamic calendar, user role control, admin dashboards, and Railway deployment.

---

##   Live Demo

  [finalproj-production-e11e.up.railway.app](https://finalproj-production-e11e.up.railway.app)

---

##   Tech Stack

- **Backend:** Laravel 10
- **Frontend:** Blade + Tailwind CSS
- **Calendar:** FullCalendar JS
- **Interactivity:** SweetAlert2
- **Auth:** Laravel Breeze
- **Deployment:** Railway.app
- **Database:** PostgreSQL (Railway)

---

##   Features

-   User login and registration
-   Interactive calendar for booking creation
-   Admin-only access to user & booking management
-   SweetAlert popups for feedback and booking forms
-   Dashboard with booking summaries
-   Slate-themed design for consistent UI
-   Role-based blade logic for permissions

---

##   Setup Instructions

### 1. Clone the repository

```bash
git clone https://github.com/your-username/booking-system-ph.git
cd booking-system-ph

2. Install dependencies
composer install
npm install

3. Configure .env
cp .env.example .env
php artisan key:generate

Update DB and app credentials inside .env:
DB_CONNECTION=mysql
DB_HOST=mysql.railway.internal
DB_PORT=3306
DB_DATABASE=railway
DB_USERNAME=root
DB_PASSWORD=stQuSHmkfzkTMjnprECduesxRufgPvxd

4. Migrate & seed
php artisan migrate --force
php artisan db:seed
5. Build assets
npm run build
________________________________________
 Railway Deployment Steps
1.	Go to Railway and create a new project.
2.	Deploy from GitHub or manually push code.
3.	Add PostgreSQL plugin and sync .env variables.
4.	Set Laravel’s start command:
php artisan serve --host=0.0.0.0 --port=$PORT
5.	Enable HTTPS and auto-deploy if desired.
________________________________________
 Roles & Access
Role	Permissions
Admin	Manage users/bookings
User	View & create bookings
 Admin currently hardcoded as user_id = 1 for simplicity.
________________________________________
 UI Overview
•	 Landing page with login/register modal
•	 Dashboard with booking summary cards
•	 FullCalendar view with booking interactivity
•	 Manage users table with role column
•	 Editable booking form with SweetAlert modal
________________________________________
 Booking Flow
1.	User logs in
2.	Selects date from calendar
3.	Fills modal form (title, time, duration, description)
4.	Booking is saved via AJAX
5.	Calendar auto-refreshes and reflects new event
________________________________________
 Credits
Built by Gabriel Cayabyab
Tagline: “Plan, schedule, and manage your bookings with ease.”

