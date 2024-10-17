<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Registration</title>

  <!-- Bootstrap CSS -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.3/css/bootstrap.min.css" rel="stylesheet">
  <!-- MDB CSS -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.10.2/mdb.min.css" rel="stylesheet">

  <style>
    .card-registration .select-input.form-control[readonly]:not([disabled]) {
      font-size: 1rem;
      line-height: 2.15;
      padding-left: .75em;
      padding-right: .75em;
    }

    .card-registration .select-arrow {
      top: 13px;
    }
  </style>
</head>

<!-- <script>
  function validate(event) {
    event.preventDefault(); // Correct method name

    var Fname = document.getElementById("Fname").value;
    var Lname = document.getElementById("Lname").value;
    var Fathername = document.getElementById("Fathername").value;
    var Village = document.getElementById("Village").value;
    var Address = document.getElementById("Address").value;
    var Female = document.getElementById("femalegender");
    var Male = document.getElementById("malegender");
    var Other = document.getElementById("Othergender");

    // Log values for debugging
    // console.log({
    //   Fname, Lname, Fathername, Village, Address,
    //   FemaleChecked: Female.checked, MaleChecked: Male.checked, OtherChecked: Other.checked
    // });

    if (Fname === '' || Lname === '' || Fathername === '' || Village === '' || Address === '') {
      alert("Fill all the given details");
    } else if (Fname === '') {
      alert("Please enter your first name");
    } else if (Lname === '') {
      alert("Please enter your last name");
    } else if (Fathername === '') {
      alert("Please enter your father's name");
    } else if (Village === '') {
      alert("Please enter your Village/Town");
    } else if (Address === '') {
      alert("Please enter your full address");
    } else if (!Female.checked && !Male.checked && !Other.checked) {
      alert("Please select your gender");
    } else {
      alert("Account successfully created!");
      window.location.href = 'index.php';
    }
  }
</script> -->

<body>
  <section class="h-100 bg-dark">
    <div class="container py-5 h-100">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col">
          <div class="card card-registration my-4">
            <div class="row g-0">
              <div class="col-xl-6 d-none d-xl-block">
                <img src="img/register_pot1.jpg" alt="Sample photo" class="img-fluid"
                  style="border-top-left-radius: .25rem; border-bottom-left-radius: .25rem; margin: 11px;" />
              </div>
              <div class="col-xl-6">
                <form id="registrationForm" action="save.php" onsubmit="validate(event)" method="post">
                  <div class="card-body p-md-5 text-black">
                    <h3 class="mb-5 text-uppercase">Registration form</h3>

                    <div class="row">
                      <div class="col-md-6 mb-4">
                        <div data-mdb-input-init class="form-outline">
                          <input type="text" id="Fname" class="form-control form-control-lg" name="Fname" />
                          <label class="form-label" for="Fname">First name</label>
                        </div>
                      </div>
                      <div class="col-md-6 mb-4">
                        <div data-mdb-input-init class="form-outline">
                          <input type="text" id="Lname" class="form-control form-control-lg" name="Lname" />
                          <label class="form-label" for="Lname">Last name</label>
                        </div>
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-md-6 mb-4">
                        <div data-mdb-input-init class="form-outline">
                          <input type="text" id="Fathername" class="form-control form-control-lg" name="Fathername" />
                          <label class="form-label" for="Fathername">Father's name</label>
                        </div>
                      </div>
                      <div class="col-md-6 mb-4">
                        <div data-mdb-input-init class="form-outline">
                          <input type="text" id="Village" class="form-control form-control-lg" name="Village" />
                          <label class="form-label" for="Village">Village/Town</label>
                        </div>
                      </div>
                    </div>

                    <div data-mdb-input-init class="form-outline mb-4">
                      <input type="text" id="Address" class="form-control form-control-lg" name="Address" />
                      <label class="form-label" for="Address">Address</label>
                    </div>

                    <div class="d-md-flex justify-content-start align-items-center mb-4 py-2">
                      <h6 class="mb-0 me-4">Gender: </h6>
                      <div class="form-check form-check-inline mb-0 me-4">
                        <input class="form-check-input" type="radio" name="Gender" id="femaleGender" value="Female" />
                        <label class="form-check-label" for="femaleGender">Female</label>
                      </div>
                      <div class="form-check form-check-inline mb-0 me-4">
                        <input class="form-check-input" type="radio" name="Gender" id="maleGender" value="Male" />
                        <label class="form-check-label" for="maleGender">Male</label>
                      </div>
                      <div class="form-check form-check-inline mb-0">
                        <input class="form-check-input" type="radio" name="Gender" id="otherGender" value="Other" />
                        <label class="form-check-label" for="otherGender">Other</label>
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-md-6 mb-4">
                        <select data-mdb-select-init class="form-select" name="State">
                          <option value="" selected disabled>State</option>
                          <option value="Andhra Pradesh">Andhra Pradesh</option>
                          <option value="Arunachal Pradesh">Arunachal Pradesh</option>
                          <option value="Assam">Assam</option>
                          <option value="Bihar">Bihar</option>
                          <option value="Chhattisgarh">Chhattisgarh</option>
                          <option value="Goa">Goa</option>
                          <option value="Gujarat">Gujarat</option>
                          <option value="Haryana">Haryana</option>
                          <option value="Himachal Pradesh">Himachal Pradesh</option>
                          <option value="Jharkhand">Jharkhand</option>
                          <option value="Karnataka">Karnataka</option>
                          <option value="Kerala">Kerala</option>
                          <option value="Madhya Pradesh">Madhya Pradesh</option>
                          <option value="Maharashtra">Maharashtra</option>
                          <option value="Manipur">Manipur</option>
                          <option value="Meghalaya">Meghalaya</option>
                          <option value="Mizoram">Mizoram</option>
                          <option value="Nagaland">Nagaland</option>
                          <option value="Odisha">Odisha</option>
                          <option value="Punjab">Punjab</option>
                          <option value="Rajasthan">Rajasthan</option>
                          <option value="Sikkim">Sikkim</option>
                          <option value="Tamil Nadu">Tamil Nadu</option>
                          <option value="Telangana">Telangana</option>
                          <option value="Tripura">Tripura</option>
                          <option value="Uttar Pradesh">Uttar Pradesh</option>
                          <option value="Uttarakhand">Uttarakhand</option>
                          <option value="West Bengal">West Bengal</option>
                          <option value="Andaman and Nicobar Islands">Andaman and Nicobar Islands</option>
                          <option value="Chandigarh">Chandigarh</option>
                          <option value="Dadra and Nagar Haveli and Daman and Diu">Dadra and Nagar Haveli and Daman
                            andDiu</option>
                          <option value="Lakshadweep">Lakshadweep</option>
                          <option value="Delhi">Delhi</option>
                          <option value="Puducherry">Puducherry</option>
                          <option value="Ladakh">Ladakh</option>
                          <option value="Jammu and Kashmir">Jammu and Kashmir</option>

                        </select>
                      </div>
                      <div class="col-md-6 mb-4">
                        <select data-mdb-select-init class="form-select" name="City">
                          <option value="" selected disabled>City</option>
                          <option value="Mumbai">Mumbai</option>
                          <option value="Delhi">Delhi</option>
                          <option value="Bangalore">Bangalore</option>
                          <option value="Hyderabad">Hyderabad</option>
                          <option value="Ahmedabad">Ahmedabad</option>
                          <option value="Chennai">Chennai</option>
                          <option value="Kolkata">Kolkata</option>
                          <option value="Surat">Surat</option>
                          <option value="Pune">Pune</option>
                          <option value="Jaipur">Jaipur</option>
                          <option value="Lucknow">Lucknow</option>
                          <option value="Kanpur">Kanpur</option>
                          <option value="Nagpur">Nagpur</option>
                          <option value="Indore">Indore</option>
                          <option value="Thane">Thane</option>
                          <option value="Bhopal">Bhopal</option>
                          <option value="Visakhapatnam">Visakhapatnam</option>
                          <option value="Pimpri-Chinchwad">Pimpri-Chinchwad</option>
                          <option value="Patna">Patna</option>
                          <option value="Vadodara">Vadodara</option>
                          <option value="Ghaziabad">Ghaziabad</option>
                          <option value="Ludhiana">Ludhiana</option>
                          <option value="Agra">Agra</option>
                          <option value="Nashik">Nashik</option>
                          <option value="Faridabad">Faridabad</option>
                          <option value="Meerut">Meerut</option>
                          <option value="Rajkot">Rajkot</option>
                          <option value="Kalyan-Dombivli">Kalyan-Dombivli</option>
                          <option value="Vasai-Virar">Vasai-Virar</option>
                          <option value="Varanasi">Varanasi</option>
                          <option value="Srinagar">Srinagar</option>
                          <option value="Aurangabad">Aurangabad</option>
                          <option value="Dhanbad">Dhanbad</option>
                          <option value="Amritsar">Amritsar</option>
                          <option value="Navi Mumbai">Navi Mumbai</option>
                          <option value="Allahabad">Allahabad</option>
                          <option value="Ranchi">Ranchi</option>
                          <option value="Howrah">Howrah</option>
                          <option value="Coimbatore">Coimbatore</option>
                          <option value="Jabalpur">Jabalpur</option>
                          <option value="Gwalior">Gwalior</option>
                          <option value="Vijayawada">Vijayawada</option>
                          <option value="Jodhpur">Jodhpur</option>
                          <option value="Madurai">Madurai</option>
                          <option value="Raipur">Raipur</option>
                          <option value="Kota">Kota</option>
                          <option value="Guwahati">Guwahati</option>
                          <option value="Chandigarh">Chandigarh</option>
                          <option value="Solapur">Solapur</option>
                          <option value="Hubli-Dharwad">Hubli-Dharwad</option>
                          <option value="Mysore">Mysore</option>
                          <option value="Tiruchirappalli">Tiruchirappalli</option>
                          <option value="Bareilly">Bareilly</option>
                          <option value="Aligarh">Aligarh</option>
                          <option value="Tiruppur">Tiruppur</option>
                          <option value="Moradabad">Moradabad</option>
                          <option value="Jalandhar">Jalandhar</option>
                          <option value="Bhubaneswar">Bhubaneswar</option>
                          <option value="Salem">Salem</option>
                          <option value="Warangal">Warangal</option>
                          <option value="Guntur">Guntur</option>
                          <option value="Bhiwandi">Bhiwandi</option>
                          <option value="Saharanpur">Saharanpur</option>
                          <option value="Gorakhpur">Gorakhpur</option>
                          <option value="Bikaner">Bikaner</option>
                          <option value="Amravati">Amravati</option>
                          <option value="Noida">Noida</option>
                          <option value="Jamshedpur">Jamshedpur</option>
                          <option value="Bhilai">Bhilai</option>
                          <option value="Cuttack">Cuttack</option>
                          <option value="Firozabad">Firozabad</option>
                          <option value="Kochi">Kochi</option>
                          <option value="Bhavnagar">Bhavnagar</option>
                          <option value="Dehradun">Dehradun</option>
                          <option value="Durgapur">Durgapur</option>
                          <option value="Asansol">Asansol</option>
                          <option value="Nanded">Nanded</option>
                          <option value="Kolhapur">Kolhapur</option>
                          <option value="Ajmer">Ajmer</option>
                          <option value="Gulbarga">Gulbarga</option>
                          <option value="Loni">Loni</option>
                          <option value="Udaipur">Udaipur</option>
                          <option value="Jhansi">Jhansi</option>
                          <option value="Ulhasnagar">Ulhasnagar</option>
                          <option value="Davangere">Davangere</option>
                          <option value="Jammu">Jammu</option>
                          <option value="Sangli-Miraj & Kupwad">Sangli-Miraj & Kupwad</option>
                          <option value="Mangalore">Mangalore</option>
                          <option value="Erode">Erode</option>
                          <option value="Belgaum">Belgaum</option>
                          <option value="Kurnool">Kurnool</option>
                          <option value="Ambattur">Ambattur</option>
                          <option value="Tirunelveli">Tirunelveli</option>
                          <option value="Malegaon">Malegaon</option>
                          <option value="Gaya">Gaya</option>
                          <option value="Jalgaon">Jalgaon</option>
                          <option value="Uzhavarkarai">Uzhavarkarai</option>
                          <option value="Kollam">Kollam</option>
                          <option value="Nellore">Nellore</option>
                          <option value="Ujjain">Ujjain</option>
                        </select>
                      </div>
                    </div>

                    <div data-mdb-input-init class="form-outline mb-4">
                      <input type="text" id="Pincode" class="form-control form-control-lg" name="Pincode" />
                      <label class="form-label" for="Pincode">Pincode</label>
                    </div>

                    <div data-mdb-input-init class="form-outline mb-4">
                      <input type="text" id="Mobile" class="form-control form-control-lg" name="Mobile" />
                      <label class="form-label" for="Mobile">Mobile</label>
                    </div>

                    <div data-mdb-input-init class="form-outline mb-4">
                      <input type="email" id="Email" class="form-control form-control-lg" name="Email" />
                      <label class="form-label" for="Email">Email ID</label>
                    </div>

                    <div data-mdb-input-init class="form-outline mb-4">
                      <input type="password" id="Password" class="form-control form-control-lg" name="Password" />
                      <label class="form-label" for="Password">Password</label>
                    </div>

                    <div data-mdb-input-init class="form-outline mb-4">
                      <input type="password" id="ConfirmPassword" class="form-control form-control-lg"
                        name="ConfirmPassword" />
                      <label class="form-label" for="ConfirmPassword">Confirm Password</label>
                    </div>

                    <div class="d-flex justify-content-end pt-3">
                      <a href="index.php"><button type="button" class="btn btn-light btn-lg"
                          style="margin-right:10px;">Back</button></a>
                      <a href="register.php"><button type="reset" class="btn btn-light btn-lg">Reset all</button></a>
                      <button type="submit" class="btn btn-warning btn-lg ms-2">Submit form</button>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Bootstrap JS and dependencies (Popper.js and jQuery) -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.11.6/umd/popper.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/js/bootstrap.min.js"></script>
  <!-- MDB JS -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.10.2/mdb.min.js"></script>
</body>

</html>