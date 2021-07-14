@extends('layouts/app')
@section('content')
    <!-- ======= Breadcrumbs Section ======= -->
    <section class="breadcrumbs">
        <div class="container">

            <div class="d-flex justify-content-between align-items-center">
                <h2>Your Profile</h2>
                <ol>
                    <li><a href="/">Home</a></li>
                    <li>Edit Profile</li>
                </ol>
            </div>

        </div>
    </section><!-- End Breadcrumbs Section -->

    <section class="inner-page">
        <div class="container">
            <form action="/profile/edit" method="post">
                <label>Country</label>
                <select class="form-control" name="country" id="country">
                    <option value="">Select Country</option>
                    <option value="Egypt">Egypt</option>
                    <option value="Saudi Arabia">Saudi Arabia</option>
                    <option value="UAE">UAE</option>
                    <option value="USA">USA</option>
                    <option value="Germany">Germany</option>
                    <option value="France">France</option>
                    <option value="Sudan">Sudan</option>
                    <option value="Lebanon">Lebanon</option>
                    <option value="jordon">Jordon</option>
                    <option value="Oman">Oman</option>
                    <option value="Kuwait">Kuwait</option>
                    <option value="Syria">Syria</option>
                    <option value="Iraq">Iraq</option>
                    <option value="Palestine">Palestine</option>
                    <option value="Yemen">Yemen</option>
                    <option value="Tunisia">Tunisia</option>
                    <option value="Morocco">Morocco</option>
                    <option value="Other">Other</option>
                </select>
                <label>City</label>
                <select class="form-control" name="city" id="city">
                    <option value="">Select City</option>
                    <option value="Other">Other</option>
                </select>
            </form>
        </div>
    </section>
    <script>
        $("#country").change(function () {
            let cities={'Egypt':['Cairo','Giza','Qalubia','Alexandria','Qina','Sohag','Matrooh','Suiz','PortSaid','Sinai','Aswan'],
                'Saudi Arabia':['Riyadh','Bisha','Dammam','Jeddah','Mecca','Medina','Tabuk','Najran','Khobar'],
                'UAE':['Dubai','Abu Dhabi','Sharjah','Al Ain','Ajman','Ras Al Khaimah','Fujairah'],
                'USA':['Alaska','Arizona','California','Florida','Hawaii','New Jersey','New York','Texas'],
                'Germany':['Berlin','Hamburg','München','Hannover'],
                'France':['Paris','Lyon','Marseille'],
                'Sudan':['Khartoum','Wadi Halfa','Singa'],
                'Lebanon':['Beirut','Tripoli','Sidon','Jounieh'],
                'jordon':['Amman','Zarqa','Irbid','Russeifa'],
                'Oman':['Adam','Al Ashkharah','Muscat','Sohar'],
                'Kuwait':['Yarmouk','Kuwait','Abdulla Al-Salem','Adailiya'],
                'Syria':['Aleppo','Damascus','Daraa','Homs'],
                'Iraq':['Ad-Dawr','Afak','Karbala','Baghdad'],
                'Palestine':['Beit Lahm','ad-Dhahiriya','Ghazzah','Ramallah'],
                'Yemen':['Sana\'a','Ta\'izz','Aden','Dhamar'],
                'Tunisia':['Tunis','Sfax','Sousse'],
                'Morocco':['Casablanca','Fez','Tangier','Rabat']
            }
        });
    </script>
@stop
