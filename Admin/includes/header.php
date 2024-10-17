<?php
session_start();

if (!isset($_SESSION['Admin'])) {
    header("location: Admin_login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>DASHMIN - Bootstrap Admin Template</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="css/style.css" rel="stylesheet">
    <style>
        .itemss {
            color: black;
            text-decoration: none;
            text-align: center;
            margin-left: 16px;
            border-radius: 0;
        }

        .itemss:hover {
            color: #009cff;
            background-color: white;
        }

        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            height: 100vh;
            width: 250px;
            /* Adjust width as needed */
            background-color: #f8f9fa;
            overflow-y: auto;
        }

        .navbar {
            z-index: 1000;
            /* Ensure navbar is on top */
        }

        .main-content {
            margin-left: 250px;
            /* Adjust margin to match sidebar width */
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light sticky-top px-4 py-0">
        <a href="index.php" class="navbar-brand d-flex d-lg-none me-4">
            <h2 class="text-primary mb-0"><i class="fa fa-hashtag"></i></h2>
        </a>
        <a href="#" class="sidebar-toggler flex-shrink-0">
            <i class="fa fa-bars"></i>
        </a>
        <form class="d-none d-md-flex ms-4">
            <input class="form-control border-0" type="search" placeholder="Search">
        </form>
        <div class="navbar-nav align-items-center ms-auto">
            <!-- Messages Dropdown -->
            <div class="nav-item dropdown">
                <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                    <i class="fa fa-envelope me-lg-2"></i>
                    <span class="d-none d-lg-inline-flex">Message</span>
                </a>
                <div class="dropdown-menu dropdown-menu-end bg-light border-0 rounded-0 rounded-bottom m-0">
                    <!-- Dropdown items here -->
                </div>
            </div>
            <!-- Notifications Dropdown -->
            <div class="nav-item dropdown">
                <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                    <i class="fa fa-bell me-lg-2"></i>
                    <span class="d-none d-lg-inline-flex">Notification</span>
                </a>
                <div class="dropdown-menu dropdown-menu-end bg-light border-0 rounded-0 rounded-bottom m-0">
                    <!-- Dropdown items here -->
                </div>
            </div>
            <!-- Profile Dropdown -->
            <div class="nav-item dropdown">
                <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                    <img class="rounded-circle me-lg-2"
                        src="<?php echo isset($_SESSION['Admin']['ProfilePic']) ? $_SESSION['Admin']['ProfilePic'] : 'img/default-profile.jpg'; ?>"
                        alt="Profile Picture" style="width: 40px; height: 40px;">
                    <span class="d-none d-lg-inline-flex"><?php echo $_SESSION['Admin']['Username']; ?></span>
                </a>
                <div class="dropdown-menu dropdown-menu-end bg-light border-0 rounded-0 rounded-bottom m-0">
                    <a href="profile.php" class="dropdown-item">My Profile</a>
                    <a href="settings.php" class="dropdown-item">Settings</a>
                    <a href="logout.php" class="dropdown-item">Log Out</a>
                </div>
            </div>

        </div>
    </nav>

    <div class="sidebar pe-4 pb-3">
        <nav class="navbar navbar-light bg-light">
            <a href="index.php" class="navbar-brand mx-4 mb-3">
                <h3 class="text-primary"><i class="fa fa-hashtag me-2"></i>OGANI</h3>
            </a>
            <div class="d-flex align-items-center ms-4 mb-4">
                <div class="position-relative">
                    <img class="rounded-circle" src="img/" alt="" style="width: 40px; height: 40px;">
                    <div
                        class="bg-success rounded-circle border border-2 border-white position-absolute end-0 bottom-0 p-1">
                    </div>
                </div>
                <div class="ms-3">
                    <h6 class="mb-0"></h6>
                    <span>ADMIN</span>
                </div>
            </div>
            <div class="navbar-nav w-100">
                <a href="index.php" class="nav-item nav-link active"><i
                        class="fa fa-tachometer-alt me-2"></i>Dashboard</a>
                <div class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i
                            class="fa fa-laptop me-2"></i>Category</a>
                    <div class="dropdown-menu bg-transparent border-0">
                        <a href="Add_category.php" class="dropdown-item itemss">Add Category</a>
                        <a href="View_category.php" class="dropdown-item itemss">View Category</a>
                    </div>
                </div>
                <div class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i
                            class="fa fa-laptop me-2"></i>Products</a>
                    <div class="dropdown-menu bg-transparent border-0">
                        <a href="add_product.php" class="dropdown-item itemss">Add Product</a>
                        <a href="view_product.php" class="dropdown-item itemss">View Product</a>
                        <a href="#" class="dropdown-item itemss">Listed Product</a>
                        <a href="view_product.php" class="dropdown-item itemss">Unlisted Product</a>

                    </div>
                </div>
                <div class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i
                            class="fa fa-laptop me-2"></i>Order</a>
                    <div class="dropdown-menu bg-transparent border-0">
                        <a href="product_order.php" class="dropdown-item itemss">Total Order</a>
                        <a href="#" class="dropdown-item itemss">Product Status</a>
                        <a href="#" class="dropdown-item itemss">Pending</a>
                        <a href="#" class="dropdown-item itemss">Completed</a>
                        <a href="#" class="dropdown-item itemss">Returned</a>
                    </div>
                </div>
                <div class="nav-item dropdown">
                    <a href="table.php" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i
                            class="fa fa-table me-2"></i>Users</a>
                    <div class="dropdown-menu bg-transparent border-0">
                        <a href="user_data.php" class="dropdown-item itemss">User Data</a>
                        <a href="block_user.php" class="dropdown-item itemss">Blocked Users</a>
                        <a href="active_user.php" class="dropdown-item itemss">Active Users</a>
                        <a href="old_user.php" class="dropdown-item itemss">Old Users</a>

                    </div>
                </div>
                <div class="nav-item dropdown">
                    <a href="table.php" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i
                            class="fa fa-table me-2"></i>Support</a>
                    <div class="dropdown-menu bg-transparent border-0">
                        <a href="contact_msg.php" class="dropdown-item itemss">Contact messages</a>
                        <a href="send_reply.php" class="dropdown-item itemss">Messages</a>
                        <a href="#" class="dropdown-item itemss">Order Issue</a>
                        <a href="#" class="dropdown-item itemss">Accout Issue</a>
                        <a href="#" class="dropdown-item itemss">Feedback<br>&<br>Suggestion</a>
                    </div>
                </div>
            </div>
        </nav>
    </div>

    <div class="main-content">
        <!-- Your main content here -->
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>