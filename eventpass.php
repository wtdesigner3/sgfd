<!DOCTYPE html>
<html lang="en">
<head>
    <style>
        * {
  box-sizing: border-box;
}

body {
  margin: 0;
  padding: 30px;
  background: #f2f2f2;
  font-family: "Segoe UI", sans-serif;
}

.container {
  display: flex;
  gap: 50px;
  align-items: flex-start;
}

/* FORM */
.form-box {
  width: 300px;
  background: #ffffff;
  padding: 20px;
  border-radius: 12px;
  box-shadow: 0 10px 25px rgba(0,0,0,0.15);
}

.form-box h2 {
  margin-bottom: 15px;
  text-align: center;
}

.form-box input,
.form-box select,
.form-box button {
  width: 100%;
  padding: 10px;
  margin-bottom: 12px;
  border-radius: 6px;
  border: 1px solid #ccc;
}

.form-box button {
  background: #c0392b;
  color: white;
  font-size: 14px;
  cursor: pointer;
  border: none;
}

.form-box button:hover {
  background: #a93226;
}

/* BADGE */
.badge {
    width: 360px;
    height: 540px;
    background: #ffffff;
    border-radius: 16px;
    overflow: hidden;
    box-shadow: 0 15px 40px rgba(0, 0, 0, 0.25);
    display: flex;
    flex-direction: column;
    border: 1px solid #00000052;
}

/* TOP */
.badge-top img {
  width: 100%;
  height: 155px;
  object-fit: cover;
}

/* MIDDLE */
.badge-middle {
    flex: 1;
    padding: 0px 20px;
    text-align: center;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
}

.badge-middle h2 {
  margin: 12px 0 4px;
  font-size: 22px;
  color: #c0392b;
}

.badge-middle p {
  margin: 2px 0;
  font-size: 14px;
  color: #555;
}

/* TYPE */
.badge-type {
  display: inline-block;
  margin: 14px 0;
  padding: 6px 18px;
  background: #f39c12;
  color: #fff;
  font-weight: 600;
  border-radius: 20px;
  letter-spacing: 1px;
}

/* QR */
.qr-section {
  margin-top: 10px;
}

.qr-section small {
  display: block;
  margin-top: 6px;
  font-size: 12px;
  color: #777;
}

/* BOTTOM */
.badge-bottom img {
          width: 100%;
    height: 100%;
    object-fit: contain;
    margin-bottom: -3px;
}

    </style>
  <meta charset="UTF-8" />
  <title>Expo Pass Generator</title>

  <!-- Libraries -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>

  <link rel="stylesheet" href="style.css" />
</head>
<body>

<div class="container">

  <!-- FORM -->
  <div class="form-box">
    <h2>Get Your Expo Pass</h2>

    <input type="text" id="name" placeholder="Full Name" />
    <input type="text" id="designation" placeholder="Designation" />
    <input type="text" id="company" placeholder="Company Name" />

    <select id="type">
      <option value="VISITOR">Visitor</option>
      <option value="EXHIBITOR">Exhibitor</option>
    </select>

    <button onclick="generatePass()">Generate Pass</button>
    <button onclick="downloadPDF()">Download PDF</button>
  </div>

  <!-- BADGE -->
  <div class="badge" id="pass">

    <!-- TOP IMAGE -->
    <div class="badge-top">
      <img src="assets/img/f-top-new.jpg" alt="Expo Header">
    </div>

    <!-- MIDDLE DATA -->
    <div class="badge-middle">

      <h2 id="p-name">YOUR NAME</h2>
      <p id="p-designation">Designation</p>
      <p id="p-company">Company Name</p>


      <div class="qr-section">
        <div id="qrcode" style="margin: auto; text-align: center; display: flex; justify-content: center;"></div>
        <small id="badge-id">ID: FBE26-0001</small>
      </div>
            <span class="badge-type" id="p-type">VISITOR</span>


    </div>

    <!-- BOTTOM IMAGE -->
    <div class="badge-bottom">
      <img src="assets/img/f-bottom-new.jpg" alt="Expo Footer">
    </div>

  </div>

</div>

<script src="script.js"></script>
<script>
    function generatePass() {
  const name = document.getElementById("name").value || "YOUR NAME";
  const designation = document.getElementById("designation").value || "Designation";
  const company = document.getElementById("company").value || "Company Name";
  const type = document.getElementById("type").value;

  document.getElementById("p-name").innerText = name.toUpperCase();
  document.getElementById("p-designation").innerText = designation;
  document.getElementById("p-company").innerText = company;
  document.getElementById("p-type").innerText = type;

  // Generate badge ID
  const badgeId = "FBE26-" + Math.floor(1000 + Math.random() * 9000);
  document.getElementById("badge-id").innerText = "ID: " + badgeId;

  // Clear QR
  document.getElementById("qrcode").innerHTML = "";

  new QRCode("qrcode", {
    text: `${badgeId}|${name}|${company}|${type}`,
    width: 110,
    height: 110
  });
}

async function downloadPDF() {
  const badge = document.getElementById("pass");

  const canvas = await html2canvas(badge, {
    scale: 2,
    backgroundColor: "#ffffff"
  });

  const imgData = canvas.toDataURL("image/png");

  // Sizes (mm)
  const badgeWidth = 95;
  const badgeHeight = 143;
  const padding = 5;
  const pdfWidth = badgeWidth + padding * 2;
  const pdfHeight = badgeHeight + padding * 2;

  const cornerRadius = 6;
  const cropOffset = 3;
  const cropLength = 5;

  const { jsPDF } = window.jspdf;

  const pdf = new jsPDF({
    orientation: "portrait",
    unit: "mm",
    format: [pdfWidth, pdfHeight]
  });

  const x = padding;
  const y = padding;

  /* ===== Rounded Background (Mask Effect) ===== */
  pdf.setFillColor(255, 255, 255);
  pdf.roundedRect(
    x,
    y,
    badgeWidth,
    badgeHeight,
    cornerRadius,
    cornerRadius,
    "F"
  );

  /* ===== Badge Image ===== */
  pdf.addImage(
    imgData,
    "PNG",
    x,
    y,
    badgeWidth,
    badgeHeight
  );

  /* ===== Crop Marks ===== */
  pdf.setDrawColor(0);
  pdf.setLineWidth(0.3);

  // Top Left
  pdf.line(x - cropOffset, y, x - cropOffset - cropLength, y);
  pdf.line(x, y - cropOffset, x, y - cropOffset - cropLength);

  // Top Right
  pdf.line(x + badgeWidth + cropOffset, y, x + badgeWidth + cropOffset + cropLength, y);
  pdf.line(x + badgeWidth, y - cropOffset, x + badgeWidth, y - cropOffset - cropLength);

  // Bottom Left
  pdf.line(x - cropOffset, y + badgeHeight, x - cropOffset - cropLength, y + badgeHeight);
  pdf.line(x, y + badgeHeight + cropOffset, x, y + badgeHeight + cropOffset + cropLength);

  // Bottom Right
  pdf.line(
    x + badgeWidth + cropOffset,
    y + badgeHeight,
    x + badgeWidth + cropOffset + cropLength,
    y + badgeHeight
  );
  pdf.line(
    x + badgeWidth,
    y + badgeHeight + cropOffset,
    x + badgeWidth,
    y + badgeHeight + cropOffset + cropLength
  );

  pdf.save("Expo-Pass-PrintReady.pdf");
}



</script>
</body>
</html>
