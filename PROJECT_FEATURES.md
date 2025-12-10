# 🚀 Role-Based Task Management System

A comprehensive, role-based project and task management solution built with **Laravel**. This system is designed to streamline team collaboration with strict access controls, real-time status tracking, and a modern glassmorphism UI.

---

## 🌟 Key Features

### 🔐 1. Role-Based Access Control (RBAC)
Security and hierarchy are at the core of the system.
-   **Admin**: Full access to the system. Can create/edit/delete Projects, Teams, and Tasks. Manages Users, Settings, and Global Announcements.
-   **Manager**: Can oversee assigned projects and teams.
-   **Member**: Can only view assigned tasks and teams. **Cannot create** new entities. Can **mark assigned tasks as complete**.

### 🛠️ 2. Admin Dashboard & Management
A powerful central hub for administrators.
-   **Dashboard**: Quick stats (Total Users, Active Projects, Teams, Tasks) and quick actions.
-   **User Management**: View, search, and delete users. Assign roles.
-   **Global Announcements**: Post system-wide announcements (Info, Success, Warning, Danger) visible to all users.
-   **System Settings**: Configure Site Name and Maintenance Mode directly from the UI.
-   **Interactive Widgets**: Clickable stat cards for fast navigation.

### 📂 3. Project & Team Management
Organize work efficiently.
-   **Teams**: Create teams and **assign multiple members** via a multi-select interface.
    -   *Smart Filtering*: Admin users are automatically excluded from "Member" lists to prevent self-assignment errors.
-   **Projects**: Create projects and assign them to specific Teams. Track project status (Pending, In Progress, Completed).
-   **Status Visibility**: Users only see Projects and Teams they are explicitly assigned to.

### ✅ 4. Advanced Task Management
Granular control over specific units of work.
-   **Multi-User Assignment**: Assign a single task to multiple users (e.g., "User A", "User B").
-   **Per-User Status Tracking**:
    -   **Independent Progress**: If User A completes the task, it shows as "Completed" for them but remains "Pending" for User B.
    -   **Auto-Completion Logic**: The main task status automatically updates to "Completed" ONLY when **ALL** assigned users have finished their work.
    -   **Timestamps**: Tracks exactly **when** each user finished their task (`Completed At` time).
-   **Priority Levels**: High, Medium, Low indicators.
-   **Due Dates**: Clear deadline tracking.

### 🎨 5. Modern UI/UX
Designed for a premium user experience.
-   **Glassmorphism Design**: Translucent cards (`card-dark`), blur effects, and modern gradients.
-   **Responsive Layout**: Fully functional on Desktop, Tablet, and Mobile.
-   **Fluid Animations**: Smooth transitions on hover, dropdowns, and buttons.
-   **Dynamic Sidebar**: "My Tasks" changes to "Assign Tasks" for Admins to reflect their context.
-   **Timezone Aware**: configured to **Asia/Kolkata** for accurate local time display.

### 🔔 6. Notifications & Updates
-   **Real-time Announcements**: Users receive color-coded system notifications (e.g., "Server Maintenance" in orange).
-   **Unread Badges**: Red badge counter for new/unseen announcements.
-   **Read Tracking**: "Mark as Read" functionality clears the badge count.

---

## 🚀 Getting Started

1.  **Login**: Access the system with your credentials.
2.  **Admin Setup**:
    -   Go to **Admin Dashboard**.
    -   Create **Teams** and assign members.
    -   Create **Projects** for those teams.
    -   Create **Tasks** and assign them to users.
3.  **User Workflow**:
    -   Login as a Member.
    -   Go to **My Tasks**.
    -   View assigned work and click **"Mark Complete"** when done.
    -   Watch as your status updates to "Completed" with the timestamp!

---
*Built with Laravel, Blade, Alpine.js, and Modern CSS.*
