  <aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3 " id="sidenav-main">
    <div class="sidenav-header">
      <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
      <a class="navbar-brand m-0" href=" index.php ">
          <h4>Z.Art Admin</h4>
      </a>
    </div>
      
    <hr class="horizontal dark mt-0">
    <div class="collapse navbar-collapse  w-auto " id="sidenav-collapse-main">
        
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link  active" href="dashboard.php">
            <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="fa fa-home text-white text-lg"></i>
            </div>
            <span class="nav-link-text ms-1">Dashboard</span>
          </a>
        </li>
          
        <li class="nav-item mt-3">
          <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6">Admin Accounts</h6>
        </li>
        <li class="nav-item">
          <a class="nav-link  " href="admin_accounts.php">
            <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                <i class="fa fa-bullhorn text-dark text-lg"></i>
            </div>
            <span class="nav-link-text ms-1">Admin</span>
          </a>
        </li>
          <li class="nav-item">
          <a class="nav-link  " href="countdown/chart.php">
            <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                <i class="fa fa-bar-chart text-dark text-lg"></i>
            </div>
            <span class="nav-link-text ms-1">View Graph</span>
          </a>
        </li>
          
        <li class="nav-item mt-3">
          <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6">Manage Products</h6>
        </li>
        <li class="nav-item">
          <a class="nav-link  " href="products.php">
            <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                <i class="fa fa-briefcase text-dark text-lg"></i>
            </div>
            <span class="nav-link-text ms-1">Products</span>
          </a>
        </li>
          <li class="nav-item">
          <a class="nav-link  " href="auction_product.php">
            <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                <i class="fa fa-gavel text-dark text-lg"></i>
            </div>
            <span class="nav-link-text ms-1">Auction</span>
          </a>
        </li>
          
        <li class="nav-item mt-3">
          <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6">Site Management</h6>
        </li>
        <li class="nav-item">
          <a class="nav-link  " href="users_accounts.php">
            <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                <i class="fa fa-user-plus text-dark text-lg"></i>
            </div>
            <span class="nav-link-text ms-1">User Accounts</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link  " href="placed_orders.php">
            <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                <i class="fas fa-shopping-cart text-dark text-lg"></i>
            </div>
            <span class="nav-link-text ms-1">Orders</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link  " href="messages.php">
            <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                <i class="fa fa-envelope text-dark text-lg"></i>
            </div>
            <span class="nav-link-text ms-1">Messages</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link  " href="bid_comment.php">
            <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                <i class="fa fa-comment text-dark text-lg"></i>
            </div>
            <span class="nav-link-text ms-1">Comments</span>
          </a>
        </li>
          <li class="nav-item">
          <a class="nav-link  " href="countdown/countdown-timer.php">
            <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                <i class="fa fa-clock-o text-dark text-lg"></i>
            </div>
            <span class="nav-link-text ms-1">Countdown</span>
          </a>
        </li>
          <li class="nav-item">
          <a class="nav-link  " href="manage_photo.php">
            <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                <i class="fa fa-picture-o text-dark text-lg"></i>
            </div>
            <span class="nav-link-text ms-1">User photo</span>
          </a>
        </li>
        
      </ul>
    </div>
    <div class="sidenav-footer mx-3 ">
    
      <a class="btn bg-gradient-primary mt-3 w-100" href="../components/admin_logout.php" onclick="return confirm('logout from the website?');">
            Logout  
      </a>
    </div>
  </aside>