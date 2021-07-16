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
            <h4>All Data is Optional</h4>
            <form action="/profile/edit" method="post">
                @csrf
                <label>Country</label>
                <select class="form-control" name="country" id="country">
                    <option value="">Select Country</option>
                    <option value="Egypt" {{$user_data['country']=='Egypt'?'selected':''}}>Egypt</option>
                    <option value="Saudi Arabia" {{$user_data['country']=='Saudi Arabia'?'selected':''}}>Saudi Arabia</option>
                    <option value="UAE" {{$user_data['country']=='UAE'?'selected':''}}>UAE</option>
                    <option value="USA" {{$user_data['country']=='USA'?'selected':''}}>USA</option>
                    <option value="Germany" {{$user_data['country']=='Germany'?'selected':''}}>Germany</option>
                    <option value="France" {{$user_data['country']=='France'?'selected':''}}>France</option>
                    <option value="Sudan" {{$user_data['country']=='Sudan'?'selected':''}}>Sudan</option>
                    <option value="Lebanon" {{$user_data['country']=='Lebanon'?'selected':''}}>Lebanon</option>
                    <option value="jordon" {{$user_data['country']=='jordon'?'selected':''}}>Jordon</option>
                    <option value="Oman" {{$user_data['country']=='Oman'?'selected':''}}>Oman</option>
                    <option value="Kuwait" {{$user_data['country']=='Kuwait'?'selected':''}}>Kuwait</option>
                    <option value="Syria" {{$user_data['country']=='Syria'?'selected':''}}>Syria</option>
                    <option value="Iraq" {{$user_data['country']=='Iraq'?'selected':''}}>Iraq</option>
                    <option value="Palestine" {{$user_data['country']=='Palestine'?'selected':''}}>Palestine</option>
                    <option value="Yemen" {{$user_data['country']=='Yemen'?'selected':''}}>Yemen</option>
                    <option value="Tunisia" {{$user_data['country']=='Tunisia'?'selected':''}}>Tunisia</option>
                    <option value="Morocco" {{$user_data['country']=='Morocco'?'selected':''}}>Morocco</option>
                    <option value="Other" {{$user_data['country']=='Other'?'selected':''}}>Other</option>
                </select>
                <label>City</label>
                <select class="form-control" name="city" id="city">
                    <option value="" id="city-null">Select City</option>
                    <option value="Other" id="city-other">Other</option>
                </select>
                <label>Address</label>
                <textarea class="form-control" name="address">{{$user_data['address']}}</textarea>
                <label>Birth Date</label>
                <input type="date" name="age" class="form-control" value="{{$user_data['age']}}">
                <label>Nationality</label>
                <select class="form-control" name="nationality" id="nationality">
                    <option value="">Select Nationality</option>
                    <option value="Egyptian" {{$user_data['nationality']=='Egyptian'?'selected':''}}>Egyptian</option>
                    <option value="Saudi" {{$user_data['nationality']=='Saudi'?'selected':''}}>Saudi</option>
                    <option value="Emirati" {{$user_data['nationality']=='Emirati'?'selected':''}}>Emirati</option>
                    <option value="American" {{$user_data['nationality']=='American'?'selected':''}}>American</option>
                    <option value="German" {{$user_data['nationality']=='German'?'selected':''}}>German</option>
                    <option value="French" {{$user_data['nationality']=='French'?'selected':''}}>French</option>
                    <option value="Sudanese" {{$user_data['nationality']=='Sudanese'?'selected':''}}>Sudanese</option>
                    <option value="Lebanese" {{$user_data['nationality']=='Lebanese'?'selected':''}}>Lebanese</option>
                    <option value="Jordanian" {{$user_data['nationality']=='Jordanian'?'selected':''}}>Jordanian</option>
                    <option value="Omani" {{$user_data['nationality']=='Omani'?'selected':''}}>Omani</option>
                    <option value="Kuwaiti" {{$user_data['nationality']=='Kuwaiti'?'selected':''}}>Kuwaiti</option>
                    <option value="Syrian" {{$user_data['nationality']=='Syrian'?'selected':''}}>Syrian</option>
                    <option value="Iraqi" {{$user_data['nationality']=='Iraqi'?'selected':''}}>Iraqi</option>
                    <option value="Palestinian" {{$user_data['nationality']=='Palestinian'?'selected':''}}>Palestinian</option>
                    <option value="Yemeni" {{$user_data['nationality']=='Yemeni'?'selected':''}}>Yemeni</option>
                    <option value="Tunisian" {{$user_data['nationality']=='Tunisian'?'selected':''}}>Tunisian</option>
                    <option value="Moroccan" {{$user_data['nationality']=='Moroccan'?'selected':''}}>Moroccan</option>
                    <option value="Other" {{$user_data['nationality']=='Other'?'selected':''}}>Other</option>
                </select>
                <label>Gender</label>
                <input type="radio" name="gender" value="male" {{$user_data['gender']=='male'?'checked':''}}>Male
                <input type="radio" name="gender" value="female" {{$user_data['gender']=='female'?'checked':''}}>Female
                <br>
                <button type="submit" class="btn btn-primary">Save Changes</button>
            </form>
            <hr>
            <h4>Change Password</h4>
            <form action="/change-password" method="post">
                @csrf
                <label>Old Password</label>
                <input type="password" name="old_password" class="form-control">
                <label>New Password</label>
                <input type="password" name="password" class="form-control">
                <label>New Password confirm</label>
                <input type="password" name="password_confirmation" class="form-control">
                <br>
                <button type="submit" class="btn btn-primary">Save Changes</button>
            </form>
        </div>
    </section>
    <script>
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
        function createCities(){
            let selectedCountry=$('#country').val();
            if($('#country').val()==''||$('#country').val()=='Other'){
                $('#city').empty();
                let htmlCity="<option value=\"\" id=\"city-null\">Select City</option>";
                htmlCity+="<option value=\"Other\" id=\"city-other\">Other</option>";
                $("#city").html(htmlCity);
            }else {
                let citiesOfCountry = cities[selectedCountry];
                $('#city').empty();
                let htmlCity = "<option value=\"\" id=\"city-null\">Select City</option>";
                for (i = 0; i < citiesOfCountry.length; i++) {
                    if (citiesOfCountry[i] == "{{$user_data['city']}}") {
                        htmlCity += "<option value=\"" + citiesOfCountry[i] + "\" id=\"city-other\" selected>" + citiesOfCountry[i] + "</option>";
                    } else {
                        htmlCity += "<option value=\"" + citiesOfCountry[i] + "\" id=\"city-other\">" + citiesOfCountry[i] + "</option>";
                    }
                }
                htmlCity += "<option value=\"Other\" id=\"city-other\">Other</option>";
                $("#city").html(htmlCity);
            }
        }
        $('#country').change(function () {
            createCities();
        });
        createCities();
    </script>
@stop
