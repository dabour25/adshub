@extends('layouts/app')
@section('content')
    <!-- ======= Breadcrumbs Section ======= -->
    <section class="breadcrumbs">
        <div class="container">

            <div class="d-flex justify-content-between align-items-center">
                <h2>@lang("strings.Your Profile")</h2>
                <ol>
                    <li><a href="/">@lang("strings.Home")</a></li>
                    <li>@lang("strings.Edit Profile")</li>
                </ol>
            </div>

        </div>
    </section><!-- End Breadcrumbs Section -->

    <section class="inner-page">
        <div class="container">
            <h4>@lang("strings.All Data is Optional")</h4>
            <form action="/profile/edit" method="post">
                @csrf
                <label>@lang("strings.Country")</label>
                <select class="form-control" name="country" id="country">
                    <option value="">@lang("strings.Select Country")</option>
                    <option value="Egypt" {{$user_data['country']=='Egypt'?'selected':''}}>@lang("strings.Egypt")</option>
                    <option value="Saudi Arabia" {{$user_data['country']=='Saudi Arabia'?'selected':''}}>@lang("strings.Saudi Arabia")</option>
                    <option value="UAE" {{$user_data['country']=='UAE'?'selected':''}}>@lang("strings.UAE")</option>
                    <option value="USA" {{$user_data['country']=='USA'?'selected':''}}>@lang("strings.USA")</option>
                    <option value="Germany" {{$user_data['country']=='Germany'?'selected':''}}>@lang("strings.Germany")</option>
                    <option value="France" {{$user_data['country']=='France'?'selected':''}}>@lang("strings.France")</option>
                    <option value="Sudan" {{$user_data['country']=='Sudan'?'selected':''}}>@lang("strings.Sudan")</option>
                    <option value="Lebanon" {{$user_data['country']=='Lebanon'?'selected':''}}>@lang("strings.Lebanon")</option>
                    <option value="jordon" {{$user_data['country']=='jordon'?'selected':''}}>@lang("strings.Jordon")</option>
                    <option value="Oman" {{$user_data['country']=='Oman'?'selected':''}}>@lang("strings.Oman")</option>
                    <option value="Kuwait" {{$user_data['country']=='Kuwait'?'selected':''}}>@lang("strings.Kuwait")</option>
                    <option value="Syria" {{$user_data['country']=='Syria'?'selected':''}}>@lang("strings.Syria")</option>
                    <option value="Iraq" {{$user_data['country']=='Iraq'?'selected':''}}>@lang("strings.Iraq")</option>
                    <option value="Palestine" {{$user_data['country']=='Palestine'?'selected':''}}>@lang("strings.Palestine")</option>
                    <option value="Yemen" {{$user_data['country']=='Yemen'?'selected':''}}>@lang("strings.Yemen")</option>
                    <option value="Tunisia" {{$user_data['country']=='Tunisia'?'selected':''}}>@lang("strings.Tunisia")</option>
                    <option value="Morocco" {{$user_data['country']=='Morocco'?'selected':''}}>@lang("strings.Morocco")</option>
                    <option value="Other" {{$user_data['country']=='Other'?'selected':''}}>@lang("strings.Other")</option>
                </select>
                <label>@lang("strings.City")</label>
                <select class="form-control" name="city" id="city">
                    <option value="" id="city-null">@lang("strings.Select City")</option>
                    <option value="Other" id="city-other">@lang("strings.Other")</option>
                </select>
                <label>@lang("strings.Address")</label>
                <textarea class="form-control" name="address">{{$user_data['address']}}</textarea>
                <label>@lang("strings.Birth Date")</label>
                <input type="date" name="age" class="form-control" value="{{$user_data['age']}}">
                <label>@lang("strings.Nationality")</label>
                <select class="form-control" name="nationality" id="nationality">
                    <option value="">@lang("strings.Select Nationality")</option>
                    <option value="Egyptian" {{$user_data['nationality']=='Egyptian'?'selected':''}}>@lang("strings.Egyptian")</option>
                    <option value="Saudi" {{$user_data['nationality']=='Saudi'?'selected':''}}>@lang("strings.Saudi")</option>
                    <option value="Emirati" {{$user_data['nationality']=='Emirati'?'selected':''}}>@lang("strings.Emirati")</option>
                    <option value="American" {{$user_data['nationality']=='American'?'selected':''}}>@lang("strings.American")</option>
                    <option value="German" {{$user_data['nationality']=='German'?'selected':''}}>@lang("strings.German")</option>
                    <option value="French" {{$user_data['nationality']=='French'?'selected':''}}>@lang("strings.French")</option>
                    <option value="Sudanese" {{$user_data['nationality']=='Sudanese'?'selected':''}}>@lang("strings.Sudanese")</option>
                    <option value="Lebanese" {{$user_data['nationality']=='Lebanese'?'selected':''}}>@lang("strings.Lebanese")</option>
                    <option value="Jordanian" {{$user_data['nationality']=='Jordanian'?'selected':''}}>@lang("strings.Jordanian")</option>
                    <option value="Omani" {{$user_data['nationality']=='Omani'?'selected':''}}>@lang("strings.Omani")</option>
                    <option value="Kuwaiti" {{$user_data['nationality']=='Kuwaiti'?'selected':''}}>@lang("strings.Kuwaiti")</option>
                    <option value="Syrian" {{$user_data['nationality']=='Syrian'?'selected':''}}>@lang("strings.Syrian")</option>
                    <option value="Iraqi" {{$user_data['nationality']=='Iraqi'?'selected':''}}>@lang("strings.Iraqi")</option>
                    <option value="Palestinian" {{$user_data['nationality']=='Palestinian'?'selected':''}}>@lang("strings.Palestinian")</option>
                    <option value="Yemeni" {{$user_data['nationality']=='Yemeni'?'selected':''}}>@lang("strings.Yemeni")</option>
                    <option value="Tunisian" {{$user_data['nationality']=='Tunisian'?'selected':''}}>@lang("strings.Tunisian")</option>
                    <option value="Moroccan" {{$user_data['nationality']=='Moroccan'?'selected':''}}>@lang("strings.Moroccan")</option>
                    <option value="Other" {{$user_data['nationality']=='Other'?'selected':''}}>@lang("strings.Other")</option>
                </select>
                <label>@lang("strings.Gender")</label>
                <input type="radio" name="gender" value="male" {{$user_data['gender']=='male'?'checked':''}}>@lang("strings.male")
                <input type="radio" name="gender" value="female" {{$user_data['gender']=='female'?'checked':''}}>@lang("strings.female")
                <br>
                <button type="submit" class="btn btn-primary">@lang("strings.Save Changes")</button>
            </form>
            <hr>
            <h4>@lang("strings.Change Password")</h4>
            <form action="/change-password" method="post">
                @csrf
                <label>@lang("strings.Old Password")</label>
                <input type="password" name="old_password" class="form-control">
                <label>@lang("strings.New Password")</label>
                <input type="password" name="password" class="form-control" id="password">
                <label>@lang("strings.New Password confirm")</label>
                <input type="password" name="password_confirmation" class="form-control" id="password_confirmation">
                <br>
                <button type="submit" class="btn btn-primary" id="change_password">@lang("strings.Save Changes")</button>
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
        };
        @if(app()->isLocale("ar"))
        let cities_ar={'Egypt':['القاهرة','الجيزة','القليوبية','الأسكندرية','قنا','سوهاج','مطروح','السويس','بورسعيد','سيناء','اسوان'],
                'Saudi Arabia':['الرياض','بيشة','الدمام','جدة','مكة','المدينة','تبوك','نجران','الخٌبر'],
                'UAE':['دبى','أبو ظبى','الشارقة','العين','عجمان','راس الخيمة','الفجيرة'],
                'USA':['الاسكا','اريزونا','كاليفورنيا','فلوريدا','هواى','نيو جيرسى','نيو يورك','تكساس'],
                'Germany':['برلين','هامبرج','ميونخ','هانوفر'],
                'France':['باريس','ليون','مارسيليا'],
                'Sudan':['الخرطوم','وادى حلفا','سنجا'],
                'Lebanon':['بيروت','طرابلس','صيدا','جونية'],
                'jordon':['عَمان','الزرقاء','إربد','الرصيفة'],
                'Oman':['ادم','الأشخرة','مسقط','صحار'],
                'Kuwait':['اليرموك','الكويت','عبدالله سالم','العديلية'],
                'Syria':['حلب','دمشق','درعا','حمص'],
                'Iraq':['الدور','عفك','كربلاء','بغداد'],
                'Palestine':['بيت لحم','الظاهرية','غزة','رام الله'],
                'Yemen':['صنعاء','تعز','عدن','ذمار'],
                'Tunisia':['تونس','صفاقس','سوسة'],
                'Morocco':['الدار البيضاء','فاس','طنجة','الرباط']
            };
        @endif
        function createCities(){
            let selectedCountry=$('#country').val();
            if($('#country').val()==''||$('#country').val()=='Other'){
                $('#city').empty();
                let htmlCity="<option value=\"\" id=\"city-null\">@lang("strings.Select City")</option>";
                htmlCity+="<option value=\"Other\" id=\"city-other\">@lang("strings.Other")</option>";
                $("#city").html(htmlCity);
            }else {
                let citiesOfCountry = cities[selectedCountry];
                @if(app()->isLocale("ar"))
                    let citiesOfCountry_ar = cities_ar[selectedCountry];
                    $('#city').empty();
                    let htmlCity = "<option value=\"\" id=\"city-null\">@lang("strings.Select City")</option>";
                    for (i = 0; i < citiesOfCountry.length; i++) {
                        if (citiesOfCountry[i] == "{{$user_data['city']}}") {
                            htmlCity += "<option value=\"" + citiesOfCountry[i] + "\" id=\"city-other\" selected>" + citiesOfCountry_ar[i] + "</option>";
                        } else {
                            htmlCity += "<option value=\"" + citiesOfCountry[i] + "\" id=\"city-other\">" + citiesOfCountry_ar[i] + "</option>";
                        }
                    }
                    htmlCity += "<option value=\"Other\" id=\"city-other\">@lang("strings.Other")</option>";
                    $("#city").html(htmlCity);
                @else
                    $('#city').empty();
                    let htmlCity = "<option value=\"\" id=\"city-null\">@lang("strings.Select City")</option>";
                    for (i = 0; i < citiesOfCountry.length; i++) {
                        if (citiesOfCountry[i] == "{{$user_data['city']}}") {
                            htmlCity += "<option value=\"" + citiesOfCountry[i] + "\" id=\"city-other\" selected>" + citiesOfCountry[i] + "</option>";
                        } else {
                            htmlCity += "<option value=\"" + citiesOfCountry[i] + "\" id=\"city-other\">" + citiesOfCountry[i] + "</option>";
                        }
                    }
                    htmlCity += "<option value=\"Other\" id=\"city-other\">@lang("strings.Other")</option>";
                    $("#city").html(htmlCity);
                @endif
            }
        }
        $('#country').change(function () {
            createCities();
        });
        createCities();
    </script>
    {!! session()->get('enc_script') !!}
@stop
