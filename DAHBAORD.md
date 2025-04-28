# Dashboard System

A comprehensive admin dashboard for managing customers, products, orders, and users.

## Features

### Dashboard Overview
- Real-time statistics and key metrics
- Visual summary cards for quick insights
- Recent activity tracking

### Core Components
- **Customer Management**: Track active customers and their status
- **Product Management**: View latest products and inventory status
- **Order Processing**: Monitor paid orders and revenue
- **User Administration**: Manage system users and roles

## Dashboard Components

### Summary Metrics
- **Active Customers**: Total active customer count
- **Latest Products**: Number of active products
- **Total Paid Orders**: Count of completed transactions
- **Total Income**: Sum of all paid orders (formatted as currency)

### Detailed Sections
1. **Latest Orders**
   - Order ID with direct links
   - Product details with thumbnails
   - Pricing information
   - Customer profiles
   - Delivery timelines

2. **Recent Users**
   - User avatars with status indicators
   - Contact information
   - Role-based access details

3. **New Products**
   - Product images with status borders
   - Brief descriptions
   - Quick links to full details

## Technical Specifications

### Backend Architecture
- **Controller**: `DashboardController`
- **Models**:
  - `UserModel`, `CustomerModel`
  - `OrderModel`, `ProductModel`
  - `OrderLineModel`
- **Enums**:
  - `UserStatus`, `CustomerStatus`
  - `PorductStatus`, `OrderStatus`

### Frontend Implementation
- Responsive Bootstrap layout
- Interactive UI components
- Loading state indicators
- Status visualization:
  - Color-coded badges
  - Border indicators
  - Icon-based status

## Installation

1. Clone the repository:
   ```bash
   git clone [repository-url]