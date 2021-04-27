<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid">
    <a class="navbar-brand" href="home.php"><b>Bubble Tea Station</b></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="#">Hi, <?php echo $row['first_name'] ?>!</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" aria-current="page" href="logout.php?logout">Sign Out</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" aria-current="page" href="update.php?id=<?php echo $_SESSION['user'] ?>">Update Profile</a>
        </li>
      </ul>
    </div>
  </div>
</nav>