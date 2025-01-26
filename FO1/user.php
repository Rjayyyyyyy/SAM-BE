<?php
session_start();
require_once 'connect.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}

$query = "SELECT * FROM events ORDER BY event_date";
$result_cards = executeQuery($query);
$result_table = executeQuery($query);

if (!$result_cards || !$result_table) {
    die("Database query failed: " . mysqli_error($conn));
}
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Olympics</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <link rel="icon" type="image/png" href="images/logo.png">

    <style>
        .navbar {
            background-color: rgb(77, 74, 74);
            padding: 15px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .navbar-brand img {
            height: 60px;
            transition: transform 0.3s ease;
        }

        .navbar-brand img:hover {
            transform: scale(1.1);
        }


        .nav-link {
            color: #fff;
            font-size: 16px;
            font-weight: 500;
            margin-right: 15px;
            transition: color 0.3s ease;
        }

        .nav-link:hover {
            color: #f39c12;
            text-decoration: none;

        }

        .nav-link.active {
            color: #f39c12;
        }

        .logout-btn {
            background-color: #dc3545;
            color: #fff;
            border: none;
            padding: 8px 15px;
            border-radius: 5px;
            font-size: 14px;
            font-weight: 600;
            transition: background-color 0.3s ease, transform 0.3s ease;
        }

        .logout-btn:hover {
            background-color: #bb2d3b;
            transform: scale(1.05);
            cursor: pointer;
        }

        .logout-btn:focus {
            outline: none;
            box-shadow: 0 0 5px rgba(220, 53, 69, 0.5);

        }

        .navbar-toggler {
            border: none;

        }

        .navbar-toggler-icon {
            color: #fff;

        }

        .collapse {
            transition: height 0.3s ease;
        }

        section {
            padding: 60px 0;
        }

        section h2 {
            text-align: center;
            margin-bottom: 30px;
        }

        #events {
            background-color: #f9f9f9;
            font-family: 'Arial', sans-serif;
        }

        .custom-card {
            position: relative;
            border-radius: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s, box-shadow 0.3s;
        }

        .custom-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
        }

        .custom-card img {
            border-top-left-radius: 20px;
            border-top-right-radius: 20px;
            max-height: 200px;
            object-fit: cover;
        }

        .custom-card .card-title {
            font-size: 1.25rem;
            font-weight: bold;
            color: #333;
        }

        .custom-card .card-text {
            font-size: 0.9rem;
            color: #555;
        }

        .custom-card i {
            color: #007bff;
        }


        .custom-table {
            border: 1px solid #ddd;
        }

        .custom-table thead {
            background-color: #007bff;
            color: white;
        }

        .custom-table th,
        .custom-table td {
            padding: 10px;
            font-size: 0.95rem;
        }

        .custom-table tbody tr:hover {
            background-color: #f1f1f1;
        }

        .custom-table tbody tr td {
            border-top: 1px solid #ddd;
        }


        #events h1,
        #events h2 {
            font-family: 'Segoe UI', sans-serif;
            font-weight: bold;
        }


        .table-responsive {
            margin-top: 30px;
        }


        @media (max-width: 768px) {
            .custom-card img {
                max-height: 150px;
            }

            .custom-card .card-title {
                font-size: 1.1rem;
            }

            .custom-card .card-text {
                font-size: 0.85rem;
            }

            .custom-table th,
            .custom-table td {
                font-size: 0.85rem;
            }
        }

        .logout-btn {
            background-color: #dc3545;
            color: #fff;
            border: none;
            padding: 8px 15px;
            border-radius: 5px;
            font-size: 14px;
            font-weight: 600;
            transition: background-color 0.3s ease;

        }

        .logout-btn:hover {
            background-color: #bb2d3b;
            color: #fff;
            cursor: pointer;

        }

        .logout-btn:focus {
            outline: none;
            box-shadow: 0 0 5px rgba(220, 53, 69, 0.5);

        }



        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f0f0f0;
        }


        footer {
            background-color: #222;
            color: #ddd;
            padding: 40px 20px;
            font-size: 14px;
            line-height: 1.6;
        }

        .footer-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            gap: 20px;
        }

        .footer-section {
            flex: 1;
            min-width: 200px;
        }

        .footer-section h3 {
            color: #fff;
            margin-bottom: 20px;
        }

        .footer-section ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .footer-section ul li {
            margin-bottom: 10px;
        }

        .footer-section ul li a {
            text-decoration: none;
            color: #bbb;
            transition: color 0.3s ease;
        }

        .footer-section ul li a:hover {
            color: #fff;
        }

        .footer-section p {
            margin: 10px 0;
        }

        .footer-section form input {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: none;
            border-radius: 4px;
        }

        .footer-section form button {
            width: 100%;
            padding: 10px;
            background-color: #555;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .footer-section form button:hover {
            background-color: #777;
        }

        .social-icons {
            margin-top: 10px;
        }

        .social-icons a {
            text-decoration: none;
            color: #ddd;
            margin-right: 10px;
            font-size: 18px;
            transition: color 0.3s ease;
        }

        .social-icons a:hover {
            color: #fff;
        }

        .footer-bottom {
            text-align: center;
            margin-top: 20px;
            border-top: 1px solid #444;
            padding-top: 20px;
        }

        .footer-bottom a {
            text-decoration: none;
            color: #bbb;
            margin: 0 10px;
            transition: color 0.3s ease;
        }

        .footer-bottom a:hover {
            color: #fff;
        }

        .btn {
            display: inline-block;
            font-weight: 600;
            text-align: center;
            text-decoration: none;
            border: 1px solid transparent;
            cursor: pointer;
            border-radius: 5px;
        }

        .btn-primary {
            background-color: #007bff;
            color: white;
            padding: 12px 24px;
            font-size: 18px;
            transition: background-color 0.3s ease;
        }

        .btn-primary:hover {
            background-color: #0056b3;
        }

        .btn-lg {
            font-size: 20px;
            padding: 15px 30px;
        }

        .footer-logo {
            width: 150px;
            height: auto;
        }

        /* General Styling */

        #contact {
            padding: 50px 0;
            background: #ffffff;
        }

        .container-contact {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            gap: 30px;

        }

        .contact-left {
            flex-basis: 35%;
            padding: 20px;
        }

        .contact-right {
            flex-basis: 60%;
            padding: 20px;
        }

        .contact-left p {
            margin-top: 30px;
            font-size: 18px;
            color: #333;
        }

        .contact-left p i {
            color: #ff004f;
            margin-right: 15px;
            font-size: 25px;
        }

        .social-icons {
            margin-top: 20px;
        }

        .social-icons a {
            text-decoration: none;
            font-size: 30px;
            margin-right: 15px;
            color: #000000;
            display: inline-block;
            transition: transform 0.5s;
        }

        .social-icons a:hover {
            color: #ff004f;
            transform: translateY(-5px);
        }

        .contact-right form {
            width: 100%;
        }

        .contact-right form input,
        .contact-right form textarea {
            width: 100%;
            border: 1px solid #333;
            outline: none;
            background: #ffffff;
            padding: 15px;
            margin: 15px 0;
            color: #000000;
            font-size: 18px;
            border-radius: 6px;
        }

        .contact-right form button {
            background: #ff004f;
            color: #000000;
            border: none;
            padding: 15px 30px;
            cursor: pointer;
            border-radius: 6px;
            font-size: 18px;
            transition: background 0.5s;
        }

        .contact-right form button:hover {
            background: rgb(147, 102, 205);
        }

        .sub-title {
            color: #000000;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <a class="navbar-brand" href="#">
                <img src="images/logo.png" alt="Logo" style="height: 60px;">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#home">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#about">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#events">Events</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#contact">Contact</a>
                    </li>
                </ul>

                <form method="POST" action="logout.php" class="d-flex ms-3">
                    <button type="submit" class="btn logout-btn">Logout</button>
                </form>
            </div>
        </div>
    </nav>

    <section id="home" class="bg-light py-5">
        <div class="container">
            <h2 class="text-center mb-4">"Discover the Stories Behind the Glory."</h2>
            <div class="row row-cols-1 row-cols-md-2 row-cols-lg-2 g-4 align-items-center">


                <div class="col">
                    <div class="image-wrapper">
                        <img src="images/homepage.jpg" alt="Olympic Moment" class="img-fluid"
                            style="border-radius: 15px; box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);">
                    </div>
                </div>


                <div class="col">
                    <p class="lead text-right mb-4" style="font-size: 1.2rem; line-height: 1.6;">
                        Welcome to Olympic Connect – Your gateway to the inspiring world of the Olympic Games! Celebrate
                        the values of excellence, friendship, and respect as we unite athletes, fans, and communities
                        from around the globe. Explore the rich history of the Olympics, stay updated on upcoming
                        events, and immerse yourself in the stories that define the spirit of sportsmanship. Whether
                        you're here to discover, engage, or support, this is where the magic of the Olympics comes
                        alive.

                    </p>
                    <div class="text-right">
                        <a href="#get-started" class="btn btn-primary btn-lg">Get Started</a>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <section id="about" class="bg-white">
        <div class="container">
            <h2 class="text-center mb-4">"About Us"</h2>
            <div class="row row-cols-1 row-cols-md-2 row-cols-lg-2 g-4 align-items-center">


                <div class="col">
                    <div class="video-wrapper">
                        <iframe src="https://www.youtube.com/embed/mQ94xbXnYu4?si=L2cRNoUA_ipzll6D" frameborder="0"
                            allowfullscreen class="img-fluid"
                            style="border-radius: 15px; box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1); width: 100%; height: 500px;">
                        </iframe>
                    </div>
                </div>


                <div class="col">
                    <p class="lead text-right mb-4" style="font-size: 1.2rem; line-height: 1.6;">
                        History of the Olympics
                        The Olympics, one of the world’s most celebrated sporting events, has a history that spans
                        thousands of years. It originated in ancient Greece in 776 BCE in Olympia, a sanctuary site
                        dedicated to Zeus. The ancient Olympic Games were held every four years and featured various
                        athletic competitions such as running, wrestling, discus, and javelin. These games were not only
                        a display of athletic prowess but also deeply tied to religious rituals and cultural
                        celebrations.
                        The ancient Olympics came to an end in 393 CE when Emperor Theodosius I banned pagan festivals,
                        including the games. The event remained dormant for over a millennium until it was revived in
                        1896 by Pierre de Coubertin, a French educator and historian, who founded the International
                        Olympic Committee (IOC). The first modern Olympics was held in Athens, Greece, featuring 14
                        nations and nine sports.
                        Over time, the Olympics grew into the global event we know today, with the addition of the
                        Winter Olympics in 1924, catering to snow and ice sports, and the Paralympic Games, introduced
                        in 1960 for athletes with disabilities. The Youth Olympic Games were also established in 2010,
                        focusing on young athletes aged 14-18.
                        The Olympics has become a platform for showcasing talent, promoting peace, and celebrating the
                        diversity and unity of nations. It now includes hundreds of events across a wide range of
                        sports, watched by billions worldwide.
                        <br><br>
                        Watch our featured video and relive the most iconic moments in Olympic history!
                    </p>
                </div>
            </div>
            <div class="row row-cols-1 row-cols-md-2 row-cols-lg-2 g-4 align-items-center">


                <div class="col">
                    <p class="lead text-left mb-4" style="font-size: 1.2rem; line-height: 1.6;">
                        The Olympics teach us invaluable lessons about life, unity, and perseverance. They demonstrate
                        that despite our differences in culture, race, or nationality, we can come together in the
                        spirit of friendship and cooperation, showcasing the strength and beauty of diversity. The
                        dedication and hard work of athletes remind us of the importance of setting goals, staying
                        committed, and overcoming challenges to achieve success. The Games also emphasize sportsmanship
                        and respect, teaching us to uphold fairness and integrity in both victory and defeat.
                        Furthermore, the stories of athletes who face setbacks and rise again inspire us to embrace
                        resilience and view obstacles as opportunities for growth. Above all, the Olympics highlight the
                        power of peace and the potential of sports to unite people and nations, encouraging us to build
                        harmony and understanding in our own lives. Ultimately, the Olympics remind us that true success
                        lies not just in winning but in striving for excellence and contributing to a more unified and
                        compassionate world.
                    </p>
                </div>


                <div class="col">
                    <img src="images/unity.jpg" alt="Olympic History" class="img-fluid"
                        style="border-radius: 15px; box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1); width: 100%;">
                </div>

            </div>
        </div>
        </div>
    </section>

    <section id="events" class="bg-light py-5">
        <div class="container">
            <h1 class="text-center mb-4">Olympics Events</h1>
            <div class="row">
                <?php
                $colors = array("#78B3CE", "#EB5A3C");
                $i = 0;
                while ($row = mysqli_fetch_assoc($result_cards)) {
                    $color = $colors[$i % 2];
                ?>
                    <div class="col-md-4 mb-4">
                        <div class="card text-white" style="background-color: <?php echo $color; ?>; border-radius: 20px;">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo htmlspecialchars($row['sports_title']); ?></h5>
                                <p class="card-text"><?php echo htmlspecialchars($row['description']); ?></p>
                                <div class="d-flex align-items-center">
                                    <i class="fas fa-calendar-alt me-2"></i>
                                    <p class="mb-0">Date: <?php echo date('M d, Y', strtotime($row['event_date'])); ?></p>
                                </div>
                                <div class="d-flex align-items-center mt-2">
                                    <i class="fas fa-map-marker-alt me-2"></i>
                                    <p class="mb-0">Location: <?php echo htmlspecialchars($row['location']); ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php
                    $i++;
                }
                ?>
            </div>
        </div>
        <div class="table-responsive mt-5">
            <h2 class="text-center mb-4">Sports Events Schedule</h2>
            <table class="table table-bordered table-hover custom-table text-center">
                <thead>
                    <tr>
                        <th>Sport</th>
                        <th>Date</th>
                        <th>Time</th>
                        <th>Location</th>
                        <th>Countries</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    while ($row = mysqli_fetch_assoc($result_table)) {
                        echo "<tr>";
                        echo "<td>" . htmlspecialchars($row['sports_title']) . "</td>";
                        echo "<td>" . date('M d, Y', strtotime($row['event_date'])) . "</td>";
                        echo "<td>" . date('g:i A', strtotime($row['event_time'])) . "</td>";
                        echo "<td>" . htmlspecialchars($row['location']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['countries']) . "</td>";
                        echo "</tr>";
                    }
                    mysqli_free_result($result_cards);
                    mysqli_free_result($result_table);
                    mysqli_close($conn);
                    ?>
                </tbody>
            </table>
        </div>
    </section>

    <section id="contact" class="px-3">
        <div class="container-contact">
            <div class="contact-left">
                <h1 class="sub-title">Contact Us</h1>
                <p><i class="fas fa-paper-plane"></i>Olympics@gmail.com</p>
                <p><i class="fas fa-phone-square-alt"></i>09081234567</p>
                <div class="social-icons">
                    <a href="#"><i class="fab fa-facebook"></i></a>
                    <a href="#"><i class="fab fa-tiktok"></i></a>
                    <a href="#"><i class="fab fa-instagram"></i></a>
                    <a href="#"><i class="fab fa-linkedin"></i></a>
                </div>
            </div>
            <div class="contact-right">
                <form>
                    <input type="text" name="Name" placeholder="Your Name" required>
                    <input type="email" name="email" placeholder="Your Email" required>
                    <textarea name="Message" rows="6" placeholder="Your Message" required></textarea>
                    <button type="submit">Submit</button>
                </form>
            </div>
        </div>
    </section>

    <footer>
        <div class="footer-container">
            <div class="footer-section">
                <h3>
                    <img src="images/logo.png" alt="Your Logo" class="footer-logo">
                </h3>
                <p>"Uniting the World, Celebrating the Spirit of Excellence!"</p>
                <form>
                    <label for="email">Subscribe Now</label>
                    <input type="email" id="email" placeholder="Enter your Email" required />
                    <button type="submit">Subscribe</button>
                </form>
            </div>
            <div class="footer-section">
                <h3>Information</h3>
                <ul>
                    <li><a href="#">About Us</a></li>
                    <li><a href="#">More Search</a></li>
                    <li><a href="#">Blog</a></li>
                    <li><a href="#">Testimonials</a></li>
                    <li><a href="#">Events</a></li>
                </ul>
            </div>
            <div class="footer-section">
                <h3>Helpful Links</h3>
                <ul>
                    <li><a href="#">Services</a></li>
                    <li><a href="#">Supports</a></li>
                    <li><a href="#">Terms & Condition</a></li>
                    <li><a href="#">Privacy Policy</a></li>
                </ul>
            </div>
            <div class="footer-section">
                <h3>Our Services</h3>
                <ul>
                    <li><a href="#">Brands list</a></li>
                    <li><a href="#">Order</a></li>
                    <li><a href="#">Return & Exchange</a></li>
                    <li><a href="#">Fashion list</a></li>
                    <li><a href="#">Blog</a></li>
                </ul>
            </div>
            <div class="footer-section">
                <h3>Contact Us</h3>
                <p><i class="fa fa-phone"></i> +91 9999 999 999</p>
                <p><i class="fa fa-envelope"></i> youremailid@email.com</p>
                <div class="social-icons">
                    <a href="#" class="icon"><i class="fa fa-facebook"></i></a>
                    <a href="#" class="icon"><i class="fa fa-google"></i></a>
                    <a href="#" class="icon"><i class="fa fa-twitter"></i></a>
                    <a href="#" class="icon"><i class="fa fa-instagram"></i></a>
                </div>
            </div>
        </div>
        <div class="footer-bottom">
            <p>2018 © company.us | All Rights Reserved</p>
            <p>
                <a href="#">FAQ</a> | <a href="#">Privacy</a> | <a href="#">Terms & Condition</a>
            </p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>

</html>