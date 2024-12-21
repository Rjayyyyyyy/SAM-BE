<?php include 'connect.php';
if (isset($_GET['island'])) {
  $islandName = $_GET['island'];

  $query = $conn->prepare("SELECT ip.name, ic.content, ip.longDescription, ip.color, ip.image AS islandImage, ic.image AS contentImage FROM islandcontents ic
                         JOIN islandsofpersonality ip ON ic.islandOfPersonalityID = ip.islandOfPersonalityID
                         WHERE ip.name = ?");
  $query->bind_param("s", $islandName);
  $query->execute();
  $result = $query->get_result();

  $islandData = [];
  while ($row = $result->fetch_assoc()) {
    $islandData['name'] = $row['name'];
    $islandData['longDescription'] = $row['longDescription'];
    $islandData['color'] = $row['color'];
    $islandData['islandImage'] = $row['islandImage'];
    $islandData['contents'][] = [
      'content' => $row['content'],
      'image' => $row['contentImage']
    ];
  }

  echo json_encode($islandData);
  exit;
}
?>


<!DOCTYPE html>
<html>

<head>
  <title>Island Of Personality</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <style>
    body,
    h1,
    h2,
    h3,
    h4,
    h5,
    h6 {
      font-family: "Montserrat", sans-serif
    }

    html {
      scroll-behavior: smooth;
    }

    body {
      overflow-x: hidden;
    }

    .w3-row-padding img {
      margin-bottom: 12px
    }

    .bgimg {
      background-position: center;
      background-repeat: no-repeat;
      background-size: contain;

      background-image: url('image/personality.jpg');
      min-height: 100%;
      height: 80%;
      width: 80%;
      margin: auto;
    }

    .card {
      border-radius: 10px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
      overflow: hidden;
      height: 100%;
      flex: 1;
    }

    .card-body {
      padding: 20px;
    }

    .card-title {
      font-size: 1.25rem;
      font-weight: bold;
    }

    .card-text {
      font-size: 1rem;
      color: #555;
    }

    .btn-primary {
      border-radius: 20px;
      padding: 10px 20px;
      transition: all 0.3s ease;
    }

    .btn-primary:hover {
      background-color: #0056b3;
      transform: scale(1.05);
    }

    .card-img-top {
      width: 100%;
      border-bottom: 2px solid #ddd;
    }

    .w3-half {
      display: flex;
      flex-direction: column;
    }

    #contentModal {
      display: none;
      position: fixed;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      background: white;
      padding: 20px;
      max-width: 90%;
      max-height: 80%;
      overflow: auto;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
      z-index: 1000;
      border-radius: 10px;
    }

    @media (max-width: 768px) {
      #contentModal {
        width: 90%;
        max-width: 95%;
        padding: 15px;
        transform: translate(-50%, -50%);
        max-height: 80%;
      }

      #modalContent {
        font-size: 14px;
      }

      #contentModal img {
        width: 100%;
        margin-bottom: 10px;
      }

      #contentModal span {
        font-size: 18px;
        top: 5px;
        right: 5px;
      }
    }

    @media (max-width: 480px) {
      #contentModal {
        width: 90%;
        padding: 10px;
        max-height: 80%;
      }

      #modalContent {
        font-size: 13px;
      }

      #contentModal img {
        width: 100%;
      }

      #contentModal span {
        font-size: 16px;
        top: 5px;
        right: 5px;
      }
    }
  </style>
</head>

<body>

  <nav class="w3-sidebar w3-hide-medium w3-hide-small" style="width:40%">
    <div class="bgimg"></div>
  </nav>

  <nav class="w3-sidebar w3-black w3-animate-right w3-xxlarge" style="display:none;padding-top:150px;right:0;z-index:2"
    id="mySidebar">
    <a href="javascript:void(0)" onclick="closeNav()" class="w3-button w3-black w3-xxxlarge w3-display-topright"
      style="padding:0 12px;">
      <i class="fa fa-remove"></i>
    </a>
    <div class="w3-bar-block w3-center">
      <a href="#" class="w3-bar-item w3-button w3-text-grey w3-hover-black" onclick="closeNav()">Home</a>
      <a href="#portfolio" class="w3-bar-item w3-button w3-text-grey w3-hover-black" onclick="closeNav()">Portfolio</a>
      <a href="#about" class="w3-bar-item w3-button w3-text-grey w3-hover-black" onclick="closeNav()">About</a>
      <a href="#contact" class="w3-bar-item w3-button w3-text-grey w3-hover-black" onclick="closeNav()">Contact</a>
    </div>
  </nav>

  <div class="w3-main w3-padding-large" style="margin-left:40%">

    <span class="w3-button w3-top w3-white w3-xxlarge w3-text-grey w3-hover-text-black" style="width:auto;right:0;"
      onclick="openNav()"><i class="fa fa-bars"></i></span>

    <header class="w3-container w3-center" style="padding:128px 16px" id="home">
      <h1 class="w3-jumbo"><b>Raymond Husena</b></h1>
      <p>Island Of personality.</p>
      <img src="image/personality.jpg" class="w3-image w3-hide-large w3-hide-small w3-round"
        style="display:block;width:60%;margin:auto;">
      <img src="image/personality.jpg" class="w3-image w3-hide-large w3-hide-medium w3-round" width="1000"
        height="1333">

    </header>

    <div class="w3-padding-32 w3-content" id="portfolio">
      <h2 class="w3-text-grey">My Island Of Personality</h2>
      <hr class="w3-opacity">

      <div class="w3-row-padding" style="margin:0 -16px">
        <?php
        $sql = "SELECT * FROM islandsofpersonality";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
          $count = 0;
          while ($row = $result->fetch_assoc()) {
            $imagePath = 'image/' . $row['image'];
            $backgroundColor = $row['color'] ? $row['color'] : '#ffffff';
        ?>
            <?php if ($count % 2 == 0) {
              echo '<div class="w3-row-padding" style="margin:0 -16px">';
            } ?>
            <div class="w3-half" style="margin-bottom: 16px;">
              <div class="card mb-4" style="background-color: <?= $backgroundColor ?>;">
                <img src="<?= $imagePath ?>" class="card-img-top" alt="<?= htmlspecialchars($row['name']) ?>">
                <div class="card-body">
                  <h5 class="card-title"><?= htmlspecialchars($row['name']) ?></h5>
                  <p class="card-text">
                    <?= htmlspecialchars($row['shortDescription'] ?: 'No description available.') ?>
                  </p>
                  <button class="btn btn-primary" onclick="loadIslandContent('<?= htmlspecialchars($row['name']) ?>')">
                    Learn More
                  </button>
                </div>
              </div>
            </div>
        <?php
            $count++;
            if ($count % 2 == 0 || $count == $result->num_rows) {
              echo '</div>';
            }
          }
        } else {
          echo "<p>No islands of personality found.</p>";
        }
        ?>
      </div>
    </div>

    <div id="contentModal">
      <span style="cursor:pointer; float:right; font-size:20px;" onclick="closeModal()">&times;</span>
      <div id="modalContent"></div>
    </div>

    <div class="w3-content w3-justify w3-text-grey w3-padding-32" id="about">
      <h2>About</h2>
      <hr class="w3-opacity">

      <div class="w3-center">
        <img src="image/island.jpg" alt="Your Image" class="w3-round w3-image"
          style="width: 100%; max-width: 300px; border: 5px solid #f1f1f1;">
      </div>
      <p> The phrase "Island of Personality" can be interpreted as a metaphorical representation of the unique and
        isolated aspects of an individual's character. Just as an island is separated from the mainland, this concept
        suggests that certain traits or qualities of a person exist independently, distinct from the influences of
        others. It symbolizes the individuality and complexity that define a person’s identity. In psychological terms,
        the "Island of Personality" could describe a state of emotional or mental isolation, where someone might retreat
        into their own thoughts or internal world, distancing themselves from external interaction. This can occur in
        moments of self-reflection, introversion, or personal growth. Alternatively, in literary or artistic contexts,
        it might be used to evoke a deeper exploration of a character's internal life, highlighting how their unique
        experiences and personality traits shape their sense of self, often in isolation from the world around them.
        Ultimately, the "Island of Personality" represents the individuality and self-contained nature of one's
        identity.
      </p>
    </div>

    <h3 class="w3-padding-16">My favorite island of personality</h3>
    <p class="w3-wide">Family Island</p>
    <div class="w3-light-grey">
      <div class="w3-container w3-center w3-padding-small" style="width:100%; background-color: #f379e5;">100%</div>
    </div>
    <p class="w3-wide">Friends Island</p>
    <div class="w3-light-grey">
      <div class="w3-container w3-center w3-padding-small" style="width:95%; background-color: #536ded;">95%</div>
    </div>
    <p class="w3-wide">Adventure Island</p>
    <div class="w3-light-grey">
      <div class="w3-container w3-center w3-padding-small" style="width:95%; background-color: #14a74c;">95%</div>
    </div>
    <p class="w3-wide">Sports Island</p>
    <div class="w3-light-grey">
      <div class="w3-container w3-center w3-padding-small" style="width:90%; background-color: #4657eb;">90%</div>
    </div><br>

    <script>
      function loadIslandContent(islandName) {
        fetch(`?island=${islandName}`)
          .then(response => response.json())
          .then(data => {
            console.log(data);

            let modalContent = `<h3>${data.name} Island</h3>`;

            if (data.longDescription) {
              modalContent += `<p><strong>Description:</strong> ${data.longDescription}</p>`;
            }

            modalContent += `<ul>`;
            data.contents.forEach(content => {
              modalContent += `<li>${content.content}</li>`;
              if (content.image) {
                modalContent += `<img src="${content.image}" style="width:32%; margin: 0 1%;" alt="Content Image">`;
              }
            });
            modalContent += `</ul>`;

            document.getElementById('modalContent').innerHTML = modalContent;
            const backgroundColor = data.color || '#ffffff';
            document.getElementById('contentModal').style.background = backgroundColor;
            document.getElementById('contentModal').style.display = 'block';
          })
          .catch(error => console.error('Error fetching island content:', error));
      }


      function closeModal() {
        document.getElementById('contentModal').style.display = 'none';
      }

      function closeModal() {
        document.getElementById('contentModal').style.display = 'none';
      }

      function openNav() {
        document.getElementById("mySidebar").style.width = "60%";
        document.getElementById("mySidebar").style.display = "block";
      }

      function closeNav() {
        document.getElementById("mySidebar").style.display = "none";
      }
    </script>

</body>

</html>