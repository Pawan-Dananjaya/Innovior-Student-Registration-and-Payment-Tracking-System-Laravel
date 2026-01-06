# API Documentation

## Authentication

All API endpoints require authentication using Laravel Sanctum.

### Login
```
POST /login
```

**Request:**
```json
{
  "email": "admin@innovior.com",
  "password": "password"
}
```

**Response:**
```json
{
  "user": {
    "id": 1,
    "name": "Admin User",
    "email": "admin@innovior.com",
    "role": "admin"
  }
}
```

### Logout
```
POST /logout
```

## Student Endpoints

### Register New Student
```
POST /reception/register-student
```

**Request:**
```json
{
  "name": "John Doe",
  "email": "john@example.com",
  "phone": "+1234567890",
  "address": "123 Main St",
  "date_of_birth": "2000-01-01",
  "course": "Computer Science"
}
```

**Response:**
```json
{
  "message": "Student registered successfully!",
  "student": {
    "id": 21,
    "student_id": "STU000021",
    "name": "John Doe",
    "email": "john@example.com",
    "qr_code": "base64_encoded_qr_code"
  }
}
```

### List Students
```
GET /admin/students
GET /reception/students
```

**Query Parameters:**
- `page` (optional): Page number for pagination
- `per_page` (optional): Items per page

## Payment Endpoints

### Record Payment
```
POST /reception/record-payment
```

**Request:**
```json
{
  "student_id": 1,
  "amount": 1500.00,
  "payment_type": "tuition",
  "notes": "First semester payment"
}
```

**Response:**
```json
{
  "message": "Payment recorded successfully!",
  "payment": {
    "id": 15,
    "reference_number": "PAY1234567890",
    "amount": 1500.00,
    "status": "paid"
  }
}
```

### View Payments
```
GET /admin/payments
GET /reception/payments
```

## Attendance Endpoints

### Process QR Scan
```
POST /reception/qr-scan
```

**Request:**
```json
{
  "student_id": "STU000001"
}
```

**Response (Check-in):**
```json
{
  "success": true,
  "message": "Student checked in successfully",
  "student": {
    "id": 1,
    "name": "John Doe",
    "student_id": "STU000001"
  },
  "action": "check_in"
}
```

**Response (Check-out):**
```json
{
  "success": true,
  "message": "Student checked out successfully",
  "student": {
    "id": 1,
    "name": "John Doe",
    "student_id": "STU000001"
  },
  "action": "check_out"
}
```

## Report Endpoints

### Generate Student Report
```
GET /reports/student/{id}
```

**Response:** PDF file download

### Generate Payments Report
```
GET /reports/payments?start_date=2024-01-01&end_date=2024-12-31
```

**Query Parameters:**
- `start_date` (optional): Start date for report
- `end_date` (optional): End date for report
- `status` (optional): Payment status filter

**Response:** PDF file download

### Generate Attendance Report
```
GET /reports/attendance?start_date=2024-01-01&end_date=2024-12-31
```

**Query Parameters:**
- `start_date` (optional): Start date for report
- `end_date` (optional): End date for report
- `student_id` (optional): Filter by specific student

**Response:** PDF file download

### Generate Comprehensive Report
```
GET /reports/comprehensive
```

**Response:** PDF file download with system-wide statistics

## Error Responses

### 401 Unauthorized
```json
{
  "message": "Unauthenticated."
}
```

### 403 Forbidden
```json
{
  "message": "Unauthorized access."
}
```

### 404 Not Found
```json
{
  "message": "Resource not found."
}
```

### 422 Validation Error
```json
{
  "message": "The given data was invalid.",
  "errors": {
    "email": [
      "The email field is required."
    ]
  }
}
```

### 500 Server Error
```json
{
  "message": "Server Error"
}
```

## Rate Limiting

API endpoints are rate-limited to prevent abuse:
- 60 requests per minute for authenticated users
- 10 requests per minute for unauthenticated users

## Best Practices

1. Always include CSRF token for web routes
2. Use HTTPS in production
3. Handle errors gracefully
4. Implement proper pagination for list endpoints
5. Cache frequently accessed data
6. Use proper HTTP status codes
