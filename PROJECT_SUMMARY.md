# Gescadmec - Language Academy Management System

## Project Overview
Gescadmec is a comprehensive management system for language academies built with Laravel. The application provides tools to manage students, courses, enrollments, payments, and student needs in an educational setting.

## Key Features

### 1. Student Management
- Create, view, edit, and delete student records
- Store student information including name, contact details, and address
- Search functionality to quickly find students

### 2. Course Management
- Manage language courses offered by the academy
- Store course details and descriptions

### 3. Enrollment System
- Enroll students in courses with specific levels (A1, A2, B1, B2, C1, C2)
- Set enrollment periods with start and end dates
- Track total amounts due for each enrollment

### 4. Payment Tracking
- Record payments made by students
- Support for multiple payment methods (cash, bank transfer, check)
- Generate printable receipts for payments
- Track payment status (paid, partial, unpaid)

### 5. Student Needs Management
- Record and track specific needs or requests from students
- Associate needs with specific enrollments
- Track status of needs (open, in progress, resolved)

### 6. Dashboard & Reporting
- Financial overview showing total payments received and outstanding balances
- Statistics on total students and enrollments
- Payment summaries by course level
- Active enrollment details with remaining days

## Technical Architecture

### Core Components
- **Framework**: Laravel 12.x
- **Database**: MySQL with Eloquent ORM
- **Frontend**: Blade templates with Bootstrap styling
- **Authentication**: Built-in Laravel authentication system

### Data Models
1. **Student** - Represents a student with personal information
2. **Course** - Language courses offered by the academy
3. **Enrollment** - Links students to courses with enrollment details
4. **Payment** - Records of payments made by students
5. **Need** - Student requests or special needs
6. **User** - System users (administrators/instructors)

### Key Relationships
- Students can have multiple enrollments
- Each enrollment belongs to one student and one course
- Enrollments can have multiple payments
- Students can have multiple needs/requests

## User Interface
The application features a responsive web interface with:
- Dashboard for quick overview of key metrics
- Separate sections for managing students, enrollments, payments, and needs
- Filtering and search capabilities in all listing pages
- Forms for creating new records with validation
- Printable receipts for payments

## Business Logic
- Automatic calculation of remaining balances for enrollments
- Status tracking for payment completion (paid, partial, unpaid)
- Date-based tracking of enrollment periods with remaining days calculation
- Pricing structure based on course levels

## Setup & Deployment
- Standard Laravel application setup
- Database migrations for schema management
- Environment-based configuration
- Composer for PHP dependency management
- NPM for frontend asset management

## Target Users
- Language academy administrators
- Enrollment coordinators
- Financial staff handling payments
- Academic advisors tracking student needs

This system streamlines the administrative tasks of language academies, providing a centralized platform for managing all student-related information and financial transactions.