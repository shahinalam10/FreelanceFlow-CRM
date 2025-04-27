# FreelanceFlow CRM

🎯 A professional, lightweight **Client Management System (Mini-CRM)** built with **Laravel** for freelancers, small agencies, and businesses to manage clients, projects, interactions, and reminders efficiently.

---

## 🚀 Features

- **Client Profile Management**  
  Manage client details including Name, Email, Phone, Company, and Notes.

- **Project Management**  
  Create and track projects with budgets, deadlines, and status (Pending, Ongoing, Completed, Cancelled).

- **Interaction Logs**  
  Record and organize client interactions like calls, emails, and meetings.

- **Reminders System**  
  Smart reminders for follow-ups, meetings, and important tasks.

- **PDF Report Generation**  
  Generate and download detailed PDF reports for each client.

- **Search & Filter**  
  Dynamic search by client name, email, project title, and filter by interaction types.

- **User-Specific Data Protection**  
  Each user can view and manage only their own clients, projects, and logs.

- **Modern UI**  
  Responsive and clean design using Bootstrap 5 and Blade templates.

---

## 🛠 Tech Stack

- **Backend:** Laravel 11 (PHP Framework)
- **Frontend:** Bootstrap 5, Blade Templates
- **Database:** MySQL
- **PDF Generator:** DomPDF Package
- **Authentication:** Laravel Breeze (if applicable)

---

## ⚙️ Installation

1. Clone the repository:
   ```bash
   git clone https://github.com/your-username/freelanceflow-crm.git
2. Navigate to the project directory:
   ```bash
   cd freelanceflow-crm
3. Install dependencies:
   ```bash
   composer install
   npm install
   npm run dev
4. Configure environment:
   ```bash
   cp .env.example .env
   php artisan key:generate
5 Set up database:
- **Create a new MySQL database.
- **Update your .env file with database credentials.
  
6. Run migrations:
  ```bash
  php artisan migrate

🤝 Contributing
Contributions, issues, and feature requests are welcome!
Feel free to fork the repository and submit a pull request. 🚀

📜 License
This project is open-sourced under the MIT license.


