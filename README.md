# 🎉 Event Management System using PHP

A web-based application designed to manage and organize events like conferences, workshops, and cultural activities. This system enables event organizers to efficiently create, manage, and monitor events, while allowing users to register and participate seamlessly.

## 📌 Features

- 🧑‍💼 Admin Panel for managing events
- 🗓️ Event creation, updating, and deletion
- 📝 User registration for events
- 📧 Email notification system (optional)
- 🔐 Secure login/logout for admin and users
- 📊 Dashboard to view event statistics
- 🗃️ MySQL Database integration
- 🎨 Clean and responsive UI using HTML/CSS/Bootstrap

## 🛠️ Technologies Used

- **Frontend**: HTML, CSS, JavaScript, Bootstrap
- **Backend**: PHP
- **Database**: MySQL
- **Tools**: XAMPP / MAMP / WAMP (for local server)

## 📂 Folder Structure

/event-management-system/
│
├── config/
│ └── db.php # Database connection file
│
├── admin/
│ ├── dashboard.php # Admin dashboard
│ ├── create_event.php # Create new event
│ ├── edit_event.php # Edit event
│ └── delete_event.php # Delete event
│
├── user/
│ ├── register.php # Event registration page
│ ├── login.php # User login page
│ └── logout.php # User logout
│
├── assets/
│ ├── css/
│ └── js/
│
├── index.php # Home page
├── events.php # Event listing
├── login.php # Admin/User login
└── README.md # Project documentation

bash
Copy code

## 🚀 Getting Started

1. **Clone the repository**
   ```bash
   git clone https://github.com/your-username/event-management-system.git
   cd event-management-system
Set up the environment

Install XAMPP/WAMP and start Apache and MySQL.

Place the project folder in htdocs (for XAMPP).

Import the SQL file into phpMyAdmin.

Configure Database

Update config/db.php with your database credentials.

Run the Project

Navigate to http://localhost/event-management-system/ in your browser.


📄 License
This project is open-source and available under the MIT License.
