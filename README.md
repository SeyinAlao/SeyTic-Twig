# SeyTic – Ticket Management Web App (Twig Version)

SeyTic is a lightweight **ticket management web application** built with **PHP and Twig**. This Twig implementation is part of a multi-framework project that also includes React and Vue.js versions. It allows users to **create, view, update, and delete tickets** with a responsive and user-friendly interface.

---

## **Features**

- Landing Page with hero section, SVG wave, and call-to-action buttons
- Secure Authentication using PHP sessions (`ticketapp_session`)
- Dashboard with **ticket statistics**: Total, Open, In Progress, Closed
- **Ticket Management (CRUD)**:
  - Create new tickets with form validation
  - View existing tickets
  - Update ticket details
  - Delete tickets with confirmation
- Responsive layout using **TailwindCSS**
- Icons powered by **Lucide**
- Accessible UI with semantic HTML, alt text, and focus states

---

## **Project Structure**

my-twig-project/
│
├── public/ # Public-facing files (web root)
│ ├── index.php # Landing page
│ ├── login.php
│ ├── register.php
│ ├── dashboard.php
│ ├── tickets.php
│ ├── create_ticket.php
│ └── logout.php
│
├── templates/ # Twig templates
│ ├── landing.twig
│ ├── login.twig
│ ├── register.twig
│ ├── dashboard.twig
│ └── tickets.twig
│
├── helpers/ # Helper scripts
│ └── session.php # Session management & authentication checks
│
├── vendor/ # Composer dependencies (Twig)
├── composer.json
└── README.md


---

## **Setup Instructions**

1. **Clone the repository:**
   ```bash
   git clone https://github.com/your-username/my-twig-project.git
   cd my-twig-project


Install dependencies:

composer install


Start a local server (XAMPP / MAMP / PHP built-in server):

php -S localhost:8000 -t public


Access the app:
Open your browser and go to http://localhost:8000

User Authentication

Authentication is simulated using PHP sessions and localStorage-style logic.

Session key: ticketapp_session

Protected routes: /dashboard.php, /tickets.php, /create_ticket.php

Logout clears the session and redirects to the landing page.

Ticket CRUD Rules

Required fields: title and status

Status values: open, in_progress, closed

Validation:

Inline error messages

User-friendly feedback for failed actions

Optional fields like description are validated for type/length if provided

Styling & Design

TailwindCSS for utility-based styling

Lucide Icons for consistent iconography

Dashboard cards:

open → green

in_progress → amber

closed → gray

Responsive layout:

Mobile: stacked layout

Tablet/Desktop: multi-column grid

Hero section includes SVG wave and decorative circles

Example Test User
Username	Password
testuser	password

These credentials are for demonstration purposes.

Switching Framework Versions

This project is part of a multi-framework challenge:

Twig → this version

React → see react/ folder

Vue.js → see vue/ folder

All versions share the same layout, design, and functionality.

Notes

Ensure public/ is the web root in your server

PHP version ≥ 7.4 recommended

Composer is required to install Twig

