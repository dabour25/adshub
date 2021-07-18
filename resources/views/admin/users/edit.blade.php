@extends('admin/layouts/app')
@section('content')
    <div id="content-wrapper">
        <div class="container-fluid">

            <!-- Breadcrumbs-->
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="/admin">Dashboard</a>
                </li>
                <li class="breadcrumb-item">
                    <a href="/admin/users">Users</a>
                </li>
                <li class="breadcrumb-item active">Edit User: {{$user->slug}}</li>
            </ol>
            <!-- Page Content -->
            @if(count($errors)>0)
                <br>
                <div class="alert alert-danger">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            @if(Session::has('m'))
                <?php $a=[]; $a=session()->pull('m'); ?>
                <div class="alert alert-{{$a[0]}}" style="width: 40%">
                    {{$a[1]}}
                </div>
            @endif
            <div class="mx-3">
                <form action="/admin/users/{{$user->slug}}" method="post">
                    @csrf
                    {{method_field('put')}}
                    <h4><strong>User Slug:</strong> {{$user->slug}}</h4>
                    <label>Email</label>
                    <input type="text" name="email" value="{{$user->email}}" class="form-control">
                    <label>Paypal Account</label>
                    <input type="text" name="paypal_email" value="{{$user->paypal_email}}" class="form-control">
                    <label>Phone</label>
                    <input type="text" name="phone" value="{{$user->phone}}" class="form-control">
                    <label>Name</label>
                    <input type="text" name="name" value="{{$user->name}}" class="form-control">
                    <label>User Status</label>
                    <select name="user_status" class="form-control">
                        <option value="active" {{$user->user_status=='active'?'selected':''}}>User</option>
                        <option value="admin" {{$user->user_status=='admin'?'selected':''}}>Admin</option>
                        <option value="blocked" {{$user->user_status=='blocked'?'selected':''}}>Block</option>
                    </select>
                    <hr>
                    <label>Country</label>
                    <select class="form-control" name="country" id="country">
                        <option value="">Select Country</option>
                        <option value="Egypt" {{$user->user_data->country=='Egypt'?'selected':''}}>Egypt</option>
                        <option value="Saudi Arabia" {{$user->user_data->country=='Saudi Arabia'?'selected':''}}>Saudi Arabia</option>
                        <option value="UAE" {{$user->user_data->country=='UAE'?'selected':''}}>UAE</option>
                        <option value="USA" {{$user->user_data->country=='USA'?'selected':''}}>USA</option>
                        <option value="Germany" {{$user->user_data->country=='Germany'?'selected':''}}>Germany</option>
                        <option value="France" {{$user->user_data->country=='France'?'selected':''}}>France</option>
                        <option value="Sudan" {{$user->user_data->country=='Sudan'?'selected':''}}>Sudan</option>
                        <option value="Lebanon" {{$user->user_data->country=='Lebanon'?'selected':''}}>Lebanon</option>
                        <option value="jordon" {{$user->user_data->country=='jordon'?'selected':''}}>Jordon</option>
                        <option value="Oman" {{$user->user_data->country=='Oman'?'selected':''}}>Oman</option>
                        <option value="Kuwait" {{$user->user_data->country=='Kuwait'?'selected':''}}>Kuwait</option>
                        <option value="Syria" {{$user->user_data->country=='Syria'?'selected':''}}>Syria</option>
                        <option value="Iraq" {{$user->user_data->country=='Iraq'?'selected':''}}>Iraq</option>
                        <option value="Palestine" {{$user->user_data->country=='Palestine'?'selected':''}}>Palestine</option>
                        <option value="Yemen" {{$user->user_data->country=='Yemen'?'selected':''}}>Yemen</option>
                        <option value="Tunisia" {{$user->user_data->country=='Tunisia'?'selected':''}}>Tunisia</option>
                        <option value="Morocco" {{$user->user_data->country=='Morocco'?'selected':''}}>Morocco</option>
                        <option value="Other" {{$user->user_data->country=='Other'?'selected':''}}>Other</option>
                    </select>
                    <label>City</label>
                    <select class="form-control" name="city" id="city">
                        <option value="" id="city-null">Select City</option>
                        <option value="Other" id="city-other">Other</option>
                    </select>
                    <label>Address</label>
                    <textarea class="form-control" name="address">{{$user->user_data->address}}</textarea>
                    <label>Birth Date</label>
                    <input type="date" name="age" class="form-control" value="{{$user->user_data->age}}">
                    <label>Nationality</label>
                    <select class="form-control" name="nationality" id="nationality">
                        <option value="">Select Nationality</option>
                        <option value="Egyptian" {{$user->user_data->nationality=='Egyptian'?'selected':''}}>Egyptian</option>
                        <option value="Saudi" {{$user->user_data->nationality=='Saudi'?'selected':''}}>Saudi</option>
                        <option value="Emirati" {{$user->user_data->nationality=='Emirati'?'selected':''}}>Emirati</option>
                        <option value="American" {{$user->user_data->nationality=='American'?'selected':''}}>American</option>
                        <option value="German" {{$user->user_data->nationality=='German'?'selected':''}}>German</option>
                        <option value="French" {{$user->user_data->nationality=='French'?'selected':''}}>French</option>
                        <option value="Sudanese" {{$user->user_data->nationality=='Sudanese'?'selected':''}}>Sudanese</option>
                        <option value="Lebanese" {{$user->user_data->nationality=='Lebanese'?'selected':''}}>Lebanese</option>
                        <option value="Jordanian" {{$user->user_data->nationality=='Jordanian'?'selected':''}}>Jordanian</option>
                        <option value="Omani" {{$user->user_data->nationality=='Omani'?'selected':''}}>Omani</option>
                        <option value="Kuwaiti" {{$user->user_data->nationality=='Kuwaiti'?'selected':''}}>Kuwaiti</option>
                        <option value="Syrian" {{$user->user_data->nationality=='Syrian'?'selected':''}}>Syrian</option>
                        <option value="Iraqi" {{$user->user_data->nationality=='Iraqi'?'selected':''}}>Iraqi</option>
                        <option value="Palestinian" {{$user->user_data->nationality=='Palestinian'?'selected':''}}>Palestinian</option>
                        <option value="Yemeni" {{$user->user_data->nationality=='Yemeni'?'selected':''}}>Yemeni</option>
                        <option value="Tunisian" {{$user->user_data->nationality=='Tunisian'?'selected':''}}>Tunisian</option>
                        <option value="Moroccan" {{$user->user_data->nationality=='Moroccan'?'selected':''}}>Moroccan</option>
                        <option value="Other" {{$user->user_data->nationality=='Other'?'selected':''}}>Other</option>
                    </select>
                    <label>Gender</label>
                    <input type="radio" name="gender" value="male" {{$user->user_data->gender=='male'?'checked':''}}>Male
                    <input type="radio" name="gender" value="female" {{$user->user_data->gender=='female'?'checked':''}}>Female
                    <br>
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                </form>
            </div>
        </div>
    </div>
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
                    if (citiesOfCountry[i] == "{{$user->user_data->city}}") {
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
