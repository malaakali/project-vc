# Software Requirements Specification (SRS)

## Island Resort Management System

**Version 1.0**  
**Date: August 16, 2025**

---

## 1. Introduction

### 1.1 Purpose
This Software Requirements Specification (SRS) document describes the requirements for the Island Resort Management System, a comprehensive web application designed to manage hotel rooms, events, ferry schedules, and ticket bookings for an island resort.

### 1.2 Scope
The Island Resort Management System aims to provide a centralized platform for both resort staff and guests to manage various aspects of the resort experience. The system handles room bookings, event ticket purchases, ferry schedule management, and ferry ticket bookings, offering a seamless experience for all users.

### 1.3 Definitions, Acronyms, and Abbreviations
- **SRS**: Software Requirements Specification
- **IRMS**: Island Resort Management System
- **UI**: User Interface
- **API**: Application Programming Interface
- **CRUD**: Create, Read, Update, Delete

### 1.4 System Overview
The Island Resort Management System is a web-based application built using the Laravel PHP framework. It follows the MVC (Model-View-Controller) architecture and uses a relational database to store all data. The system provides a user-friendly interface for managing resort operations and customer bookings.

---

## 2. Overall Description

### 2.1 Product Perspective
The Island Resort Management System is a standalone web application that serves as the primary management tool for the resort. It interfaces with payment gateways, email services, and potentially other third-party systems to provide a comprehensive solution.

### 2.2 Product Functions
The main functions of the system include:
- User account management (registration, authentication, profile management)
- Room management and booking
- Event creation, management, and ticket sales
- Ferry schedule management and ticket booking
- Integrated booking system requiring hotel stay for ferry access

### 2.3 User Classes and Characteristics
1. **Guests/Customers**:
   - Browse available rooms, events, and ferry schedules
   - Make bookings and purchase tickets
   - View and manage their bookings and tickets
   - Update their profile information

2. **Resort Staff**:
   - Manage room inventory and availability
   - Create and manage events
   - Set up ferry schedules
   - View and manage all bookings and tickets
   - Generate reports

3. **System Administrators**:
   - Manage user accounts
   - Configure system settings
   - Monitor system performance
   - Backup and restore data

### 2.4 Operating Environment
- Web-based application accessible via modern web browsers
- Backend powered by Laravel PHP framework
- MySQL/MariaDB database for data storage
- Responsive design for desktop and mobile device access

### 2.5 Design and Implementation Constraints
- The system is built on the Laravel framework
- Follows RESTful API design principles
- Uses Blade templating engine for frontend views
- Implements Laravel's authentication system
- Database schema follows Laravel's migration and Eloquent ORM patterns

### 2.6 Assumptions and Dependencies
- Users have internet access and modern web browsers
- The system requires integration with email services for notifications
- Payment gateway integration for processing bookings and ticket purchases
- Sufficient server resources to handle the expected user load

---

## 3. System Features and Requirements

### 3.1 User Management

#### 3.1.1 User Registration and Authentication
- The system shall provide user registration functionality
- Users shall be able to log in using email and password
- The system shall support password reset functionality
- User sessions shall be managed securely

#### 3.1.2 User Profile Management
- Users shall be able to view and update their profile information
- Users shall be able to change their password
- Users shall be able to view their booking history

### 3.2 Room Management

#### 3.2.1 Room Inventory
- The system shall maintain an inventory of all rooms
- Each room shall have attributes including room type, max occupancy, price per night, description, amenities, and availability status
- Room details shall be editable by authorized staff

#### 3.2.2 Room Booking
- Users shall be able to search for available rooms based on date range and occupancy
- Users shall be able to view room details and pricing
- Users shall be able to book rooms for specific date ranges
- The system shall prevent double-booking of rooms
- Users shall receive confirmation of their booking
- Bookings shall have a unique confirmation code

### 3.3 Event Management

#### 3.3.1 Event Creation and Management
- Staff shall be able to create and manage events
- Events shall include name, description, type, location, start/end datetime, max participants, and price
- Events shall be categorizable by type (e.g., theme park, beach activities)

#### 3.3.2 Event Ticket Sales
- Users shall be able to purchase tickets for events
- Tickets shall be linked to a specific visit date
- Users shall be able to purchase multiple tickets in a single transaction
- The system shall track ticket availability based on event capacity
- Users shall receive a confirmation code for their ticket purchase

### 3.4 Ferry Management

#### 3.4.1 Ferry Schedule Management
- Staff shall be able to create and manage ferry schedules
- Schedules shall include departure time, arrival time, capacity, and ticket price
- Schedules can be marked as active or inactive

#### 3.4.2 Ferry Ticket Booking
- Users shall only be able to book ferry tickets if they have a valid room booking
- Users shall be able to select departure dates and number of passengers
- The system shall prevent overbooking based on ferry capacity
- Users shall receive a confirmation code for their ferry ticket booking

### 3.5 Booking and Reservation System

#### 3.5.1 Integrated Booking Process
- The system shall support an integrated booking flow where users can book rooms, event tickets, and ferry tickets
- The system shall enforce business rules (e.g., ferry tickets require room booking)
- Bookings shall include appropriate status tracking (confirmed, cancelled, etc.)

#### 3.5.2 Booking Management
- Users shall be able to view all their bookings
- Users shall be able to cancel bookings according to cancellation policies
- Staff shall be able to view and manage all bookings
- The system shall provide booking confirmation codes for all types of bookings

---

## 4. Database Requirements

### 4.1 Database Schema
The system shall use a relational database with the following key entities:

#### 4.1.1 Users
- Store user account information including name, email, and password
- Track email verification status
- Store remember token for persistent sessions

#### 4.1.2 Rooms
- Store room details including type, occupancy, price, description, and amenities
- Track room availability status
- Associate rooms with bookings

#### 4.1.3 Events
- Store event details including name, description, type, location, dates, and pricing
- Track maximum participants and current registration count
- Associate events with event tickets

#### 4.1.4 Bookings
- Store booking information linking users to rooms
- Track check-in/check-out dates, number of guests, and total price
- Include booking status and confirmation code
- Serve as a prerequisite for ferry ticket bookings

#### 4.1.5 Event Tickets
- Associate users with events
- Track purchase date, visit date, quantity, and total price
- Include ticket status and confirmation code

#### 4.1.6 Ferry Schedules
- Store ferry schedule information including departure/arrival times
- Track capacity, pricing, and active status

#### 4.1.7 Ferry Tickets
- Associate users with ferry schedules and their room bookings
- Track purchase date, departure date, number of passengers, and total price
- Include ticket status and confirmation code

### 4.2 Data Integrity
- The system shall enforce referential integrity through foreign key constraints
- Critical operations shall be wrapped in database transactions
- Appropriate indexes shall be created for performance optimization

---

## 5. External Interface Requirements

### 5.1 User Interfaces
- The system shall provide a responsive web interface accessible on desktop and mobile devices
- UI shall be intuitive and follow modern web design principles
- Key user interfaces include:
  - User registration and login
  - Room booking interface
  - Event browsing and ticket purchasing
  - Ferry schedule viewing and ticket booking
  - User profile and booking management
  - Admin dashboard for system management

### 5.2 Software Interfaces
- The system shall integrate with email services for notifications
- The system shall integrate with payment gateways for processing transactions
- The system may integrate with third-party APIs for additional functionality (e.g., weather forecasts, local attractions)

### 5.3 Communication Interfaces
- The system shall use secure HTTPS for all communications
- APIs shall follow RESTful design principles
- Authentication shall be handled via secure tokens

---

## 6. Non-Functional Requirements

### 6.1 Performance Requirements
- Page load times shall not exceed 3 seconds under normal load
- The system shall support at least 100 concurrent users
- Database queries shall be optimized for performance
- The system shall implement appropriate caching strategies

### 6.2 Security Requirements
- User passwords shall be hashed and stored securely
- User authentication shall be required for sensitive operations
- The system shall implement CSRF protection
- The system shall validate all user inputs
- The system shall implement rate limiting to prevent abuse

### 6.3 Software Quality Attributes
- The system shall be maintainable, with clean, well-documented code
- The system shall be extensible to accommodate future features
- The system shall be reliable, with appropriate error handling and logging
- The system shall be testable, with unit and integration tests

---

## 7. System Architecture

### 7.1 Architectural Design
The Island Resort Management System follows the Model-View-Controller (MVC) architecture of the Laravel framework:

- **Models**: Represent database entities and business logic
- **Views**: Handle presentation using Blade templates
- **Controllers**: Process user requests and coordinate system responses

### 7.2 Component Design
Key components include:
- **Authentication Component**: Handles user registration, login, and profile management
- **Booking Component**: Manages room bookings and availability
- **Event Component**: Handles event creation, management, and ticket sales
- **Ferry Component**: Manages ferry schedules and ticket bookings
- **Admin Component**: Provides administrative functions for system management

---

## 8. Implementation Plan

### 8.1 Development Methodology
The system shall be developed using an iterative approach:
1. Setup of core infrastructure and database schema
2. Implementation of user authentication and profile management
3. Development of room booking functionality
4. Implementation of event management and ticket sales
5. Development of ferry scheduling and ticket booking
6. Integration of all components and business rules
7. Testing and bug fixing
8. Deployment and post-deployment support

### 8.2 Development Tools and Technologies
- **Backend Framework**: Laravel (PHP)
- **Frontend**: HTML, CSS, JavaScript, Tailwind CSS
- **Database**: MySQL/MariaDB
- **Version Control**: Git
- **Deployment**: Docker, compose.yml for containerization
- **Testing**: PHPUnit for unit and integration tests

---

## 9. Use Cases

### 1. User Management

#### Use Case 1.1	Create User
**Goal in Context**	To allow users to be registered onto the website  
**Primary Actor**	Anonymous user  
**Secondary Actor**	None  
**Trigger**	User presses "Register" button  
**Typical Course of Events Actor Action**	**System Response**  
1. This use case begins when user wishes to book a ticket or room	
2. User presses the "Register" button	3. System shows the input form that includes name, email and password
4. User fills in the required information and presses the "SUBMIT" button	5. System validates the information and creates a new user account
 | 6. System sends a verification email to the user
 | 7. System redirects the user to the login page with a success message
**Alternative course of events**  
Line 4: a- If email already exists in the system, an error message will be displayed  
Line 4: b- If the password does not meet complexity requirements, an error message will be displayed  

#### Use Case 1.2	User Login
**Goal in Context**	To authenticate users and provide access to the system  
**Primary Actor**	Registered user  
**Secondary Actor**	None  
**Trigger**	User presses "Login" button  
**Typical Course of Events Actor Action**	**System Response**  
1. This use case begins when user wishes to access restricted features	
2. User presses the "Login" button	3. System displays the login form with email and password fields
4. User enters their credentials and presses the "LOGIN" button	5. System validates the credentials
 | 6. System creates a session for the user
 | 7. System redirects the user to the dashboard
**Alternative course of events**  
Line 4: a- If credentials are invalid, an error message will be displayed  
Line 4: b- If the account is not verified, a message prompting verification will be displayed  

#### Use Case 1.3	Manage User Profile
**Goal in Context**	To allow users to view and update their profile information  
**Primary Actor**	Authenticated user  
**Secondary Actor**	None  
**Trigger**	User navigates to the profile section  
**Typical Course of Events Actor Action**	**System Response**  
1. This use case begins when user wishes to view or update their profile	
2. User navigates to the profile section	3. System displays the user's current profile information
4. User modifies their information and submits the form	5. System validates and updates the user's profile
 | 6. System displays a success message
**Alternative course of events**  
Line 4: a- If the provided information is invalid, an error message will be displayed  

#### Use Case 1.4	Reset Password
**Goal in Context**	To allow users to reset their forgotten password  
**Primary Actor**	Registered user  
**Secondary Actor**	None  
**Trigger**	User presses "Forgot Password" link  
**Typical Course of Events Actor Action**	**System Response**  
1. This use case begins when user forgets their password	
2. User presses the "Forgot Password" link	3. System displays a form to enter email address
4. User enters their email and submits the form	5. System sends a password reset link to the provided email
 | 6. System displays a success message
**Alternative course of events**  
Line 4: a- If the email does not exist in the system, a generic message will still be displayed for security  

### 2. Room Management

#### Use Case 2.1	Search Available Rooms
**Goal in Context**	To allow users to search for available rooms based on criteria  
**Primary Actor**	User (authenticated or anonymous)  
**Secondary Actor**	None  
**Trigger**	User navigates to the room search page  
**Typical Course of Events Actor Action**	**System Response**  
1. This use case begins when user wishes to find available rooms	
2. User navigates to the room search page	3. System displays a search form with check-in date, check-out date, and number of guests
4. User enters search criteria and submits the form	5. System queries the database for available rooms matching the criteria
 | 6. System displays the list of available rooms with details
**Alternative course of events**  
Line 4: a- If no rooms are available for the selected dates, a message will be displayed  
Line 4: b- If the check-out date is before the check-in date, an error message will be displayed  

#### Use Case 2.2	Book a Room
**Goal in Context**	To allow users to book a room for a specific date range  
**Primary Actor**	Authenticated user  
**Secondary Actor**	None  
**Trigger**	User selects a room and presses "Book Now" button  
**Typical Course of Events Actor Action**	**System Response**  
1. This use case begins when user decides to book a room	
2. User selects a room and presses "Book Now" button	3. System displays a booking form with pre-filled dates and room information
4. User confirms the booking details and proceeds to payment	5. System processes the payment
 | 6. System creates a booking record with a unique confirmation code
 | 7. System sends a confirmation email to the user
 | 8. System displays a booking confirmation page
**Alternative course of events**  
Line 4: a- If the payment fails, an error message will be displayed  
Line 4: b- If the room becomes unavailable during the booking process, an error message will be displayed  

#### Use Case 2.3	View Room Details
**Goal in Context**	To allow users to view detailed information about a room  
**Primary Actor**	User (authenticated or anonymous)  
**Secondary Actor**	None  
**Trigger**	User clicks on a room from the search results  
**Typical Course of Events Actor Action**	**System Response**  
1. This use case begins when user wants to see more details about a room	
2. User clicks on a room from the search results	3. System retrieves the room details from the database
 | 4. System displays comprehensive information about the room including amenities, photos, and pricing
**Alternative course of events**  
Line 2: a- If the room information cannot be retrieved, an error message will be displayed  

#### Use Case 2.4	Manage Room Inventory (Admin)
**Goal in Context**	To allow administrators to manage the room inventory  
**Primary Actor**	Administrator  
**Secondary Actor**	None  
**Trigger**	Admin navigates to the room management section  
**Typical Course of Events Actor Action**	**System Response**  
1. This use case begins when admin needs to manage rooms	
2. Admin navigates to the room management section	3. System displays a list of all rooms
4. Admin selects to add a new room or edit an existing one	5. System displays the appropriate form
6. Admin enters/updates room details and submits the form	7. System validates and saves the room information
 | 8. System displays a success message
**Alternative course of events**  
Line 6: a- If the provided information is invalid, an error message will be displayed  

#### Use Case 2.5	View Room Bookings (Admin)
**Goal in Context**	To allow administrators to view all room bookings  
**Primary Actor**	Administrator  
**Secondary Actor**	None  
**Trigger**	Admin navigates to the bookings section  
**Typical Course of Events Actor Action**	**System Response**  
1. This use case begins when admin needs to view bookings	
2. Admin navigates to the bookings section	3. System displays a list of all bookings with filtering options
4. Admin applies filters if needed	5. System updates the list based on the filters
6. Admin selects a booking to view details	7. System displays detailed information about the selected booking
**Alternative course of events**  
None  

### 3. User Booking Management

#### Use Case 3.1	View My Bookings
**Goal in Context**	To allow users to view all their bookings  
**Primary Actor**	Authenticated user  
**Secondary Actor**	None  
**Trigger**	User navigates to the "My Bookings" section  
**Typical Course of Events Actor Action**	**System Response**  
1. This use case begins when user wishes to view their bookings	
2. User navigates to the "My Bookings" section	3. System retrieves all bookings associated with the user
 | 4. System displays room bookings, event tickets, and ferry tickets
3. User selects a booking to view details	6. System displays detailed information about the selected booking
**Alternative course of events**  
Line 2: a- If the user has no bookings, a message will be displayed  

#### Use Case 3.2	Cancel Booking
**Goal in Context**	To allow users to cancel their bookings  
**Primary Actor**	Authenticated user  
**Secondary Actor**	None  
**Trigger**	User selects a booking and presses "Cancel" button  
**Typical Course of Events Actor Action**	**System Response**  
1. This use case begins when user wishes to cancel a booking	
2. User selects a booking and presses "Cancel" button	3. System displays a confirmation dialog
4. User confirms the cancellation	5. System updates the booking status to "cancelled"
 | 6. System processes any applicable refund
 | 7. System sends a cancellation confirmation email
 | 8. System displays a cancellation confirmation message
**Alternative course of events**  
Line 4: a- If the cancellation window has expired, an error message will be displayed  
Line 4: b- If dependent bookings exist (e.g., ferry tickets dependent on room booking), a warning will be displayed  

### 4. Ferry Management

#### Use Case 4.1	View Ferry Schedules
**Goal in Context**	To allow users to view available ferry schedules  
**Primary Actor**	User (authenticated or anonymous)  
**Secondary Actor**	None  
**Trigger**	User navigates to the ferry schedules page  
**Typical Course of Events Actor Action**	**System Response**  
1. This use case begins when user wishes to check ferry schedules	
2. User navigates to the ferry schedules page	3. System retrieves active ferry schedules
 | 4. System displays the schedules with departure and arrival times
5. User can filter schedules by date	6. System updates the list based on the filter
**Alternative course of events**  
Line 5: a- If no schedules match the filter criteria, a message will be displayed  

#### Use Case 4.2	Book Ferry Tickets
**Goal in Context**	To allow users to book ferry tickets  
**Primary Actor**	Authenticated user with an active room booking  
**Secondary Actor**	None  
**Trigger**	User selects a ferry schedule and presses "Book Tickets" button  
**Typical Course of Events Actor Action**	**System Response**  
1. This use case begins when user decides to book ferry tickets	
2. User selects a ferry schedule and presses "Book Tickets" button	3. System verifies the user has an active room booking
 | 4. System displays a ticket booking form
5. User selects departure date and number of passengers	6. System calculates the total price
7. User confirms the booking and proceeds to payment	8. System processes the payment
 | 9. System creates ferry ticket records with a unique confirmation code
 | 10. System sends a confirmation email with ticket details
 | 11. System displays a booking confirmation page
**Alternative course of events**  
Line 2: a- If the user does not have an active room booking, an error message will be displayed  
Line 5: a- If the selected ferry is at capacity, an error message will be displayed  
Line 7: a- If the payment fails, an error message will be displayed  

#### Use Case 4.3	Manage Ferry Schedules (Admin)
**Goal in Context**	To allow administrators to manage ferry schedules  
**Primary Actor**	Administrator  
**Secondary Actor**	None  
**Trigger**	Admin navigates to the ferry schedule management section  
**Typical Course of Events Actor Action**	**System Response**  
1. This use case begins when admin needs to manage ferry schedules	
2. Admin navigates to the ferry schedule management section	3. System displays a list of all ferry schedules
4. Admin selects to add a new schedule or edit an existing one	5. System displays the appropriate form
6. Admin enters/updates schedule details and submits the form	7. System validates and saves the schedule information
 | 8. System displays a success message
**Alternative course of events**  
Line 6: a- If the provided information is invalid, an error message will be displayed  

#### Use Case 4.4	View Ferry Bookings (Admin)
**Goal in Context**	To allow administrators to view all ferry ticket bookings  
**Primary Actor**	Administrator  
**Secondary Actor**	None  
**Trigger**	Admin navigates to the ferry tickets section  
**Typical Course of Events Actor Action**	**System Response**  
1. This use case begins when admin needs to view ferry bookings	
2. Admin navigates to the ferry tickets section	3. System displays a list of all ferry ticket bookings with filtering options
4. Admin applies filters if needed	5. System updates the list based on the filters
6. Admin selects a booking to view details	7. System displays detailed information about the selected booking
**Alternative course of events**  
None  

---

## 10. Appendices

### 10.1 Glossary
- **Room**: A accommodation unit within the resort
- **Event**: An activity or attraction organized by the resort
- **Ferry**: Transportation to and from the island
- **Booking**: A reservation of a room for a specific date range
- **Ticket**: A purchased access pass for an event or ferry ride

### 10.2 References
- Laravel Documentation: https://laravel.com/docs
- Tailwind CSS Documentation: https://tailwindcss.com/docs
- PHP Documentation: https://www.php.net/docs.php

---

**Document Approval**

| Name | Role | Date | Signature |
|------|------|------|-----------|
|      |      |      |           |
|      |      |      |           |
|      |      |      |           |
