<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="author" content="Nathakorn Wimonwatwethi" />
    <meta name="keyword" content="HTML, CSS" />
    <meta name="description" content="AboutUs" />
    <title>About us</title>
    <link rel="stylesheet" type="text/css" href="./styles/aboutUs.css" />
    <link rel="stylesheet" type="text/css" href="./styles/global.css" />
    <script defer src="scripts/part2.js" type="text/javascript"></script>
  </head>
  <body>
  <?php include 'includes/header.inc'; ?>
  <section>
      <h1 id="about-us-title">About Us</h1>
      <div class="about-us">
        <div class="content-box">
          <p id="content-box-subtitle">About Ours Website Creater</p>
          <dl>
            <dt>My name is</dt>
            <dd>Nathakorn Wimonwatwethi (KEW)</dd>
            <dt>Student number</dt>
            <dd>105230475</dd>
            <dt>Tutor’s name</dt>
            <dd>Yi Tian</dd>
            <dt>Course</dt>
            <dd>Master of Information Technology</dd>
            <dt>Email</dt>
            <dd>
              <a href="mailto:105230475@student.swin.edu.au"
                >105230475@student.swin.edu.au</a
              >
            </dd>
          </dl>
          <div class="personal-information">
            <h1></h1>
            <p>
              Hi, I'm Nathakorn from Thailand, and it's great to meet you! I
              have a passion for music, whether I'm playing instruments or just
              enjoying my favorite tunes. In my free time, I love to play
              basketball and football, which keep me active and social.
              Traveling and trying new things are also high on my list of
              hobbies, as I enjoy exploring different cultures and experiences.
            </p>
          </div>
        </div>
        <img
          id="aboutUsTopImage"
          src="./images/aboutUsImageBottom.png"
          alt="ImageHolder"
        />
      </div>
      <h2 id="timetable">Time Table</h2>
      <table>
        <tr>
          <th>Unit</th>
          <th>Date</th>
          <th>Time</th>
        </tr>
        <tr>
          <td>COS60010 Technology Inquiry Project (Online)</td>
          <td>Monday</td>
          <td>10:30 - 11:30</td>
        </tr>
        <tr>
          <td>COS80022 Software Quality and Testing (Online)</td>
          <td>Monday</td>
          <td>12:30 - 14:30</td>
        </tr>
        <tr>
          <td>COS60004 Creating Web Applications (Online)</td>
          <td>Monday</td>
          <td>15:30 - 16:30</td>
        </tr>
        <tr>
          <td>COS60004 Creating Web Applications</td>
          <td>Tuesday</td>
          <td>12:30 - 14:30</td>
        </tr>
        <tr>
          <td>COS60009 Data Management for the Big Data Age (Online)</td>
          <td>Wednesday</td>
          <td>12:30 -14:30</td>
        </tr>
        <tr>
          <td>COS60010 Technology Inquiry Project</td>
          <td>Thursday</td>
          <td>12:30 -14:30</td>
        </tr>
        <tr>
          <td>COS60009 Data Management for the Big Data Age</td>
          <td>Thursday</td>
          <td>15:30 -16:30</td>
        </tr>
        <tr>
          <td>COS80022 Software Quality and Testing</td>
          <td>Friday</td>
          <td>09:30 -10:30</td>
        </tr>
      </table>
    </section>
    <?php include 'includes/footer_full.inc'; ?>
  </body>
</html>
