@extends('Website.layouts.default')


@section('content')
    <style>
        table td {
            width: 75px !important;
            height: 75px !important;
        }

        .ml-cust-3 {
            margin-left: 3rem;
        }

        ul li {
            font-weight: 500 !important;
            padding: 0.25rem;
        }

        ul li span {
            font-weight: 500 !important;
        }

        .pl-cust-6 {
            padding-left: 6rem;
        }

    </style>

    <div class="breadcrumbs">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-12">
                    <ul class="breadcrumb-nav">
                        <li><a href="{{ route('user.dashboard') }}">Home</a></li>
                        <li>Edit Profile</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <section class="dashboard mt-3">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-4 col-12">
                    @php
                        $user=App\Models\User::find(auth()->user()->id)->load('userBasicInfo');
                        [$performance,$bgColor]=App\Helpers\UserSideBar\UserSideBarHelper::make($user)->logic();
                    @endphp
                    <x-user-dashboard.side-bar  :user="$user" :status="0" :performance="$performance" :bgColor="$bgColor" />
                </div>
                <div class="col-lg-9">
                    <div class="item-details">
                        <div class="container">
                            <div class="top-area shadow">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="product-images">
                                            <main id="gallery">
                                                <div class="main-img">
                                                    <img class='rounded' id='profileImg'
                                                        @if ($userBasicInfo->image_with_path) src="{{ $userBasicInfo->image_with_path }}"
                                                                @else
                                                                    src="{{ $image_src ?? '' }}" @endif
                                                        alt="Preview">
                                                </div>
                                                <div class="images">
                                                    <img class='rounded'
                                                        @if ($user_image_with_path) src="{{ $user_image_with_path }}"
                                                                @else
                                                                    src="{{ $image_src ?? '' }}" @endif
                                                        alt="Preview">

                                                    @foreach ($user_photos as $photos)
                                                        <img src={{ $photos->image_full_path }} class="img rounded"
                                                            alt="#">
                                                    @endforeach
                                                </div>
                                            </main>
                                        </div>
                                    </div>

                                    <div class="col-lg-6 col-md-12 col-12 mt-lg-4">
                                        <div class="product-info">
                                            <h1 class="lead fw-normal">{{ $userInfo->user_profile_id ?? 'TM#######' }}
                                            </h1>
                                            <h5 class="price pt-2"><span class="text-dark">I'm</span>
                                                {{ $userBasicInfo->user_full_name }}</h5>
                                            <hr>
                                            <div class="row">
                                                <div class="col-12">
                                                    <ul class="text">
                                                        <li class="location m-0 p-0"><i class="lni lni-user"></i>
                                                            I'm&nbsp;{{ $userBasicInfo->age }}
                                                            Yrs</li>

                                                        <li class="location m-0 p-0"><i class="lni lni-phone"></i>
                                                            {{ $userInfo->phonenumber }}
                                                        </li>
                                                        <li class="location m-0"><i class="lni lni-envelope"></i>
                                                            {{ $userInfo->email }}
                                                        </li>

                                                        <li class="location m-0"><i class="lni lni-map-marker"></i>
                                                            {{ $userBasicInfo->user_address ?? '-' }}
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="item-details-blocks">
                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-12 mb-3">
                                        <div class="single-block shadow">
                                            <h3 class="float-start">More Information</h3>
                                            <div class="float-end">
                                                <div x-data='userShortList'>
                                                    <a class="btn btn-warning btn-sm"
                                                        href="{{ route('generate-pdf', AUTH()->user()->id) }}"
                                                        target="_blank"><i class="lni lni-download"></i> Get PDF</a>
                                                </div>
                                            </div>

                                            <div class="accordion" id="accordionExample">
                                                @if (!empty($userBasicInfo))
                                                    <div class="accordion-item">
                                                        <h2 class="accordion-header" id="headingTwo">
                                                            <button class="accordion-button" type="button"
                                                                data-bs-toggle="collapse" data-bs-target="#collapseTwo"
                                                                aria-expanded="false" aria-controls="collapseTwo">
                                                                Basic Details <i class="lni lni-chevron-down"></i>
                                                            </button>
                                                        </h2>

                                                        <div id="collapseTwo" class="accordion-collapse"
                                                            aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                                                            <div class="accordion-body">
                                                                <div class="p-3">
                                                                    <ul>
                                                                        <div class="row">
                                                                            <div class="col-md-6">
                                                                                <li class="p-2">
                                                                                    <span class="text-primary">
                                                                                        Blood Group :
                                                                                    </span>
                                                                                    {{ $userBasicInfo->blood_group ?? '-' }}
                                                                                </li>
                                                                                <li class="p-2">
                                                                                    <span class="text-primary">
                                                                                        Height :
                                                                                    </span>
                                                                                    {{ $userBasicInfo->Height->height_feet_cm ?? '-' }}
                                                                                </li>
                                                                                <li class="p-2">
                                                                                    <span class="text-primary">
                                                                                        Complexion :
                                                                                    </span>
                                                                                    {{ $userBasicInfo->Complex->complexion_name }}
                                                                                </li>
                                                                            </div>
                                                                            <div class="col-md-6">
                                                                                <li class="p-2">
                                                                                    <span class="text-primary">
                                                                                        Mother Tongue :
                                                                                    </span>
                                                                                    {{ $userBasicInfo->MotherTongue->language_name }}
                                                                                </li>
                                                                                {{-- <li class="p-2">
                                                                    <span class="text-primary">
                                                                        Marital Status :
                                                                    </span>
                                                                    {{ $userBasicInfo->MartialStatus->martial_status_name }}
                                                                </li> --}}
                                                                                <li class="p-2">
                                                                                    <span class="text-primary">
                                                                                        Eating Habit :
                                                                                    </span>
                                                                                    {{ $userBasicInfo->EatingHabit->habit_type_name }}
                                                                                </li>
                                                                                <li class="p-2">
                                                                                    <span class="text-primary">
                                                                                        Disability :
                                                                                    </span>
                                                                                    {{ ($userBasicInfo->is_disable = 1) ? 'Yes' : 'No' }}
                                                                                </li>

                                                                            </div>
                                                                        </div>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif

                                                @if (!empty($userReligiousInfo))
                                                    <div class="accordion-item">
                                                        <h2 class="accordion-header" id="headingThree">
                                                            <button class="accordion-button collapsed" type="button"
                                                                data-bs-toggle="collapse" data-bs-target="#collapseThree"
                                                                aria-expanded="false" aria-controls="collapseThree">
                                                                Religion Information <i class="lni lni-chevron-down"></i>
                                                            </button>
                                                        </h2>
                                                        <div id="collapseThree" class="accordion-collapse collapse"
                                                            aria-labelledby="headingThree"
                                                            data-bs-parent="#accordionExample">
                                                            <div class="accordion-body">
                                                                <div class="p-3">
                                                                    <ul>
                                                                        <div class="row">
                                                                            <div class="col-md-6">
                                                                                <li class="p-2">
                                                                                    <span class="text-primary">
                                                                                        Religion :
                                                                                    </span>
                                                                                    {{ $userReligiousInfo->Religion->religion_name }}
                                                                                </li>
                                                                                <li class="p-2">
                                                                                    <span class="text-primary">
                                                                                        Caste :
                                                                                    </span>
                                                                                    {{ $userReligiousInfo->Caste->caste_name }}
                                                                                </li>
                                                                                <li class="p-2">
                                                                                    <span class="text-primary">Sub-Caste :
                                                                                    </span>
                                                                                    {{ $userReligiousInfo->sub_caste }}
                                                                                </li>
                                                                                <li class="p-2"><span
                                                                                        class="text-primary">Rasi
                                                                                        :</span>
                                                                                    {{ $userReligiousInfo->Rasi->rasi_name }}
                                                                                </li>
                                                                            </div>
                                                                            <div class="col-md-6">
                                                                                <li class="p-2"><span
                                                                                        class="text-primary">Star
                                                                                        :</span>
                                                                                    {{ $userReligiousInfo->Star->star_name }}
                                                                                </li>
                                                                                <li class="p-2"><span
                                                                                        class="text-primary">Dhosam
                                                                                        :</span>
                                                                                    {{ ($userReligiousInfo->dhosam = 1) ? 'Yes' : 'No' }}
                                                                                </li>
                                                                                <li class="p-2"><span
                                                                                        class="text-primary">Birth
                                                                                        Time :</span>
                                                                                    {{ $userReligiousInfo->user_birth_time }}
                                                                                </li>
                                                                                <li class="p-2"><span
                                                                                        class="text-primary">Birth
                                                                                        Place :</span>
                                                                                    {{ $userReligiousInfo->user_birth_place }}
                                                                                </li>
                                                                            </div>
                                                                        </div>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif

                                                @if (!empty($UserProfessionInfo))
                                                    <div class="accordion-item">
                                                        <h2 class="accordion-header" id="headingThree">
                                                            <button class="accordion-button collapsed" type="button"
                                                                data-bs-toggle="collapse" data-bs-target="#collapseFive"
                                                                aria-expanded="false" aria-controls="collapseFive">
                                                                Professional Information <i
                                                                    class="lni lni-chevron-down"></i>
                                                            </button>
                                                        </h2>
                                                        <div id="collapseFive" class="accordion-collapse collapse"
                                                            aria-labelledby="headingThree"
                                                            data-bs-parent="#accordionExample">
                                                            <div class="accordion-body">
                                                                <div class="p-3">
                                                                    <ul>
                                                                        <div class="row">
                                                                            <div class="col-md-6">
                                                                                <li class="p-2"><span
                                                                                        class="text-primary">Education
                                                                                        :</span>
                                                                                    @forelse ($UserProfessionInfo->user_education_id as $education)
                                                                                        {{ $education->education_name }},
                                                                                    @empty
                                                                                        <span>-</span>
                                                                                    @endforelse
                                                                                </li>
                                                                                <li class="p-2"><span
                                                                                        class="text-primary">Education
                                                                                        Detials
                                                                                        :</span>
                                                                                    {{ $UserProfessionInfo->user_education_details }}
                                                                                </li>
                                                                                <li class="p-2"><span
                                                                                        class="text-primary">Job
                                                                                        :</span>
                                                                                    {{ $UserProfessionInfo->Job->job_name }}
                                                                                </li>
                                                                                <li class="p-2"><span
                                                                                        class="text-primary">Job
                                                                                        Details :</span>
                                                                                    {{ $UserProfessionInfo->user_job_details }}
                                                                                </li>
                                                                            </div>
                                                                            <div class="col-md-6">
                                                                                <li class="p-2"><span
                                                                                        class="text-primary">Annual
                                                                                        Income :</span>
                                                                                    ₹
                                                                                    {{ $UserProfessionInfo->user_annual_income }}
                                                                                </li>
                                                                                <li class="p-2"><span
                                                                                        class="text-primary">Job
                                                                                        Country :</span>
                                                                                    {{ $UserProfessionInfo->JobCountry->country_name }}
                                                                                </li>
                                                                                <li class="p-2"><span
                                                                                        class="text-primary">Job
                                                                                        State :</span>
                                                                                    {{ $UserProfessionInfo->JobState->state_name }}
                                                                                </li>
                                                                                <li class="p-2"><span
                                                                                        class="text-primary">Job
                                                                                        City :</span>
                                                                                    {{ $UserProfessionInfo->JobCity->city_name }}
                                                                                </li>
                                                                            </div>
                                                                        </div>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif

                                                @if (!empty($UserFamilyInfo))
                                                    <div class="accordion-item">
                                                        <h2 class="accordion-header" id="headingThree">
                                                            <button class="accordion-button collapsed" type="button"
                                                                data-bs-toggle="collapse" data-bs-target="#collapseSix"
                                                                aria-expanded="false" aria-controls="collapseSix">
                                                                Family Details <i class="lni lni-chevron-down"></i>
                                                            </button>
                                                        </h2>
                                                        <div id="collapseSix" class="accordion-collapse collapse"
                                                            aria-labelledby="headingThree"
                                                            data-bs-parent="#accordionExample">
                                                            <div class="accordion-body">
                                                                <ul>
                                                                    <div class="row">
                                                                        <div class="col-md-4">
                                                                            <li class="p-2"><span
                                                                                    class="text-primary">Father
                                                                                    Name :</span>
                                                                                {{ $UserFamilyInfo->user_father_name }}
                                                                            </li>
                                                                            <li class="p-2"><span
                                                                                    class="text-primary">Father's
                                                                                    Occupation
                                                                                    :</span>
                                                                                {{ $UserFamilyInfo->user_father_job_details }}
                                                                            </li>
                                                                            <li class="p-2"><span
                                                                                    class="text-primary">Mother
                                                                                    Name :</span>
                                                                                {{ $UserFamilyInfo->user_mother_name }}
                                                                            </li>
                                                                            <li class="p-2"><span
                                                                                    class="text-primary">Mother's
                                                                                    Occupation
                                                                                    :</span>
                                                                                {{ $UserFamilyInfo->user_mother_job_details }}
                                                                            </li>
                                                                        </div>
                                                                        <div class="col-md-4">
                                                                            <li class="p-2"><span
                                                                                    class="text-primary">Family
                                                                                    Status :</span>
                                                                                {{ $UserFamilyInfo->FamilyStatusSubMaster->family_type_name }}
                                                                            </li>
                                                                            <li class="p-2"><span
                                                                                    class="text-primary">No. Of
                                                                                    Siblings
                                                                                    :</span>
                                                                                {{ $UserFamilyInfo->no_of_sibling ?? '-' }}
                                                                            </li>
                                                                            <li class="p-2"><span
                                                                                    class="text-primary">No. Of
                                                                                    Brothers
                                                                                    :</span>
                                                                                {{ $UserFamilyInfo->no_of_brothers ?? '-' }}
                                                                            </li>
                                                                            <li class="p-2"><span
                                                                                    class="text-primary">No. Of
                                                                                    Sisters
                                                                                    :</span>
                                                                                {{ $UserFamilyInfo->no_of_sisters ?? '-' }}
                                                                            </li>
                                                                        </div>

                                                                        <div class="col-md-4">
                                                                            <li class="p-2"><span
                                                                                    class="text-primary">No. Of
                                                                                    Brothers Married
                                                                                    :</span>
                                                                                {{ $UserFamilyInfo->no_of_brothers_married ?? '-' }}
                                                                            </li>
                                                                            <li class="p-2"><span
                                                                                    class="text-primary">No. Of
                                                                                    Sisters Married
                                                                                    :</span>
                                                                                {{ $UserFamilyInfo->no_of_sisters_married ?? '-' }}
                                                                            </li>
                                                                            <li class="p-2"><span
                                                                                    class="text-primary">Siblings
                                                                                    Details
                                                                                    :</span>
                                                                                {{ $UserFamilyInfo->user_sibling_details ?? '-' }}
                                                                            </li>
                                                                            <li class="p-2"><span
                                                                                    class="text-primary">Relative
                                                                                    Address
                                                                                    :</span>
                                                                                {{ $UserFamilyInfo->paternal_uncle_address ?? '-' }}
                                                                            </li>
                                                                        </div>
                                                                    </div>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif

                                                @if (!empty($UserPreferenceInfo))
                                                    <div class="accordion-item">
                                                        <h2 class="accordion-header" id="headingThree">
                                                            <button class="accordion-button collapsed" type="button"
                                                                data-bs-toggle="collapse" data-bs-target="#collapseSeven"
                                                                aria-expanded="false" aria-controls="collapseSeven">
                                                                Partner Preferences <i class="lni lni-chevron-down"></i>
                                                            </button>
                                                        </h2>
                                                        <div id="collapseSeven" class="accordion-collapse collapse"
                                                            aria-labelledby="headingThree"
                                                            data-bs-parent="#accordionExample">
                                                            <div class="accordion-body">
                                                                <ul>
                                                                    <div class="row">
                                                                        <div class="col-md-4">
                                                                            <li class="p-2"><span
                                                                                    class="text-primary">Partner's Age
                                                                                    :</span>
                                                                                {{ $UserPreferenceInfo->partner_age_from ?? '-' }}
                                                                                to
                                                                                {{ $UserPreferenceInfo->partner_age_to ?? '-' }}
                                                                            </li>
                                                                            <li class="p-2"><span
                                                                                    class="text-primary">Partner's Height
                                                                                    :</span>
                                                                                {{ $UserPreferenceInfo->HeightFrom->height_feet_cm ?? '-' }}
                                                                                to
                                                                                {{ $UserPreferenceInfo->HeightTo->height_feet_cm ?? '-' }}
                                                                            </li>
                                                                            <li class="p-2"><span
                                                                                    class="text-primary">Marital
                                                                                    Status :</span>
                                                                                {{ $UserPreferenceInfo->MartialStatus->martial_status_name ?? '-' }}
                                                                            </li>
                                                                            <li class="p-2"><span
                                                                                    class="text-primary">Complexion
                                                                                    :</span>
                                                                                @forelse ($UserPreferenceInfo->partner_complexion as $partner_complexion)
                                                                                    {{ $partner_complexion->complexion_name }},
                                                                                @empty
                                                                                    <span>-</span>
                                                                                @endforelse
                                                                            </li>
                                                                        </div>

                                                                        <div class="col-md-4">
                                                                            <li class="p-2"><span
                                                                                    class="text-primary">Mother
                                                                                    Tongue :</span>
                                                                                @forelse ($UserPreferenceInfo->partner_mother_tongue as $partner_tongue)
                                                                                    {{ $partner_tongue->language_name }},
                                                                                @empty
                                                                                    <span>-</span>
                                                                                @endforelse
                                                                            </li>
                                                                            <li class="p-2"><span
                                                                                    class="text-primary">Partner's Salary
                                                                                    :</span>
                                                                                {{ $UserPreferenceInfo->partner_salary ?? '-' }}
                                                                            </li>
                                                                            <li class="p-2"><span
                                                                                    class="text-primary">Partner's
                                                                                    Location
                                                                                    :</span>
                                                                                @forelse ($UserPreferenceInfo->partner_country as $partner_country)
                                                                                    {{ $partner_country->country_name }},
                                                                                @empty
                                                                                    <span>-</span>
                                                                                @endforelse
                                                                            </li>
                                                                            <li class="p-2"><span
                                                                                    class="text-primary">Job
                                                                                    Location :</span>
                                                                                @forelse ($UserPreferenceInfo->partner_job_country as $part_job_country)
                                                                                    {{ $part_job_country->country_name }},
                                                                                @empty
                                                                                    <span>-</span>
                                                                                @endforelse
                                                                            </li>
                                                                        </div>

                                                                        <div class="col-md-4">
                                                                            <li class="p-2"><span
                                                                                    class="text-primary">Partner's
                                                                                    Education
                                                                                    :</span>
                                                                                @forelse ($UserPreferenceInfo->partner_education as $partner_education)
                                                                                    {{ $partner_education->education_name }},
                                                                                @empty
                                                                                    <span>-</span>
                                                                                @endforelse
                                                                            </li>
                                                                            <li class="p-2"><span
                                                                                    class="text-primary">Prefer
                                                                                    Details :</span>
                                                                                {{ $UserPreferenceInfo->partner_education_details ?? '-' }}
                                                                            </li>
                                                                            <li class="p-2"><span
                                                                                    class="text-primary">Partner Religion
                                                                                    :</span>
                                                                                {{ $UserPreferenceInfo->Religion->religion_name ?? '-' }}
                                                                            </li>
                                                                            <li class="p-2"><span
                                                                                    class="text-primary">Partner Caste
                                                                                    :</span>
                                                                                {{ $UserPreferenceInfo->Caste->caste_name ?? '-' }}
                                                                            </li>
                                                                        </div>
                                                                    </div>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif

                                                @if (!empty($UserHoroscopeInfo))
                                                    <div class="accordion-item">
                                                        <h2 class="accordion-header" id="headingThree">
                                                            <button class="accordion-button collapsed" type="button"
                                                                data-bs-toggle="collapse" data-bs-target="#collapseEight"
                                                                aria-expanded="false" aria-controls="collapseEight">
                                                                Horoscope Details <i class="lni lni-chevron-down"></i>
                                                            </button>
                                                        </h2>
                                                        <div id="collapseEight" class="accordion-collapse collapse"
                                                            aria-labelledby="headingThree"
                                                            data-bs-parent="#accordionExample">
                                                            <div class="accordion-body">
                                                                <div class="row mt-2 justify-content-center">
                                                                    @if ($UserHoroscopeInfo->user_jathakam_rasi_katam_is_filled == 1)
                                                                        <div class="col-md-6">
                                                                            <h5 class="fw-normal text-center">Jathaka
                                                                                Katam (RASI)</h5>
                                                                            <table class="table table-bordered mt-4">
                                                                                <tbody>
                                                                                    <tr>
                                                                                        <td
                                                                                            class="jathakatam small text-center align-middle">
                                                                                            {{ $UserHoroscopeInfo->rasi_katam_row_1_col_1->flatten()->pluck('horoscope_name')[0] ?? '-' }}
                                                                                        </td>
                                                                                        <td
                                                                                            class="jathakatam small text-center align-middle">
                                                                                            {{ $UserHoroscopeInfo->rasi_katam_row_1_col_2->flatten()->pluck('horoscope_name')[0] ?? '-' }}

                                                                                        </td>
                                                                                        <td
                                                                                            class="jathakatam  small text-center align-middle">
                                                                                            {{ $UserHoroscopeInfo->rasi_katam_row_1_col_3->flatten()->pluck('horoscope_name')[0] ?? '-' }}

                                                                                        </td>
                                                                                        <td
                                                                                            class="jathakatam small text-center align-middle">
                                                                                            {{ $UserHoroscopeInfo->rasi_katam_row_1_col_4->flatten()->pluck('horoscope_name')[0] ?? '-' }}
                                                                                        </td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td
                                                                                            class="jathakatam small text-center align-middle">
                                                                                            {{ $UserHoroscopeInfo->rasi_katam_row_2_col_1->flatten()->pluck('horoscope_name')[0] ?? '-' }}
                                                                                        </td>
                                                                                        <td colspan="2"
                                                                                            class="bg-dark-lt align-middle">
                                                                                            <h5
                                                                                                class="fw-light text-center">
                                                                                                RASI</h5>
                                                                                        </td>
                                                                                        <td
                                                                                            class="jathakatam small text-center align-middle">
                                                                                            {{ $UserHoroscopeInfo->rasi_katam_row_2_col_4->flatten()->pluck('horoscope_name')[0] ?? '-' }}
                                                                                        </td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td
                                                                                            class="jathakatam small text-center align-middle">
                                                                                            {{ $UserHoroscopeInfo->rasi_katam_row_3_col_1->flatten()->pluck('horoscope_name')[0] ?? '-' }}

                                                                                        </td>
                                                                                        <td colspan="2"
                                                                                            class="bg-dark-lt align-middle">
                                                                                            <h5
                                                                                                class="fw-light text-center">
                                                                                                CHART</h5>
                                                                                        </td>
                                                                                        <td
                                                                                            class="jathakatam small text-center align-middle">
                                                                                            {{ $UserHoroscopeInfo->rasi_katam_row_3_col_4->flatten()->pluck('horoscope_name')[0] ?? '-' }}

                                                                                        </td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td
                                                                                            class="jathakatam small text-center align-middle">
                                                                                            {{ $UserHoroscopeInfo->rasi_katam_row_4_col_1->flatten()->pluck('horoscope_name')[0] ?? '-' }}

                                                                                        </td>
                                                                                        <td
                                                                                            class="jathakatam small text-center align-middle">
                                                                                            {{ $UserHoroscopeInfo->rasi_katam_row_4_col_2->flatten()->pluck('horoscope_name')[0] ?? '-' }}

                                                                                        </td>
                                                                                        <td
                                                                                            class="jathakatam small text-center align-middle">
                                                                                            {{ $UserHoroscopeInfo->rasi_katam_row_4_col_3->flatten()->pluck('horoscope_name')[0] ?? '-' }}

                                                                                        </td>
                                                                                        <td
                                                                                            class="jathakatam small text-center align-middle">
                                                                                            {{ $UserHoroscopeInfo->rasi_katam_row_4_col_4->flatten()->pluck('horoscope_name')[0] ?? '-' }}

                                                                                        </td>
                                                                                    </tr>
                                                                                </tbody>
                                                                            </table>
                                                                        </div>
                                                                    @endif

                                                                    @if ($UserHoroscopeInfo->user_jathakam_navamsam_katam_is_filled == 1)
                                                                        <div class="col-md-6">
                                                                            <h5 class="fw-normal text-center">Jathaka
                                                                                Katam (NAVAASAM)</h5>
                                                                            <table class="table table-bordered mt-4">
                                                                                <tbody>
                                                                                    <tr>
                                                                                        <td
                                                                                            class="jathakatam small text-center align-middle">
                                                                                            {{ $UserHoroscopeInfo->navam_katam_row_1_col_1->flatten()->pluck('horoscope_name')[0] ?? '-' }}
                                                                                        </td>
                                                                                        <td
                                                                                            class="jathakatam small text-center align-middle">
                                                                                            {{ $UserHoroscopeInfo->navam_katam_row_1_col_2->flatten()->pluck('horoscope_name')[0] ?? '-' }}
                                                                                        </td>
                                                                                        <td
                                                                                            class="jathakatam small text-center align-middle">
                                                                                            {{ $UserHoroscopeInfo->navam_katam_row_1_col_3->flatten()->pluck('horoscope_name')[0] ?? '-' }}
                                                                                        </td>
                                                                                        <td
                                                                                            class="jathakatam small text-center align-middle">
                                                                                            {{ $UserHoroscopeInfo->navam_katam_row_1_col_4->flatten()->pluck('horoscope_name')[0] ?? '-' }}
                                                                                        </td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td
                                                                                            class="jathakatam small text-center align-middle">
                                                                                            {{ $UserHoroscopeInfo->navam_katam_row_2_col_1->flatten()->pluck('horoscope_name')[0] ?? '-' }}
                                                                                        </td>
                                                                                        <td colspan="2"
                                                                                            class="bg-dark-lt align-middle">
                                                                                            <h5
                                                                                                class="fw-light text-center">
                                                                                                NAVAMSAM</h5>
                                                                                        </td>
                                                                                        <td
                                                                                            class="jathakatam small text-center align-middle">
                                                                                            {{ $UserHoroscopeInfo->navam_katam_row_2_col_4->flatten()->pluck('horoscope_name')[0] ?? '-' }}
                                                                                        </td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td
                                                                                            class="jathakatam small text-center align-middle">
                                                                                            {{ $UserHoroscopeInfo->navam_katam_row_3_col_1->flatten()->pluck('horoscope_name')[0] ?? '-' }}
                                                                                        </td>
                                                                                        <td colspan="2"
                                                                                            class="bg-dark-lt align-middle">
                                                                                            <h5
                                                                                                class="fw-light text-center">
                                                                                                CHART</h5>
                                                                                        </td>
                                                                                        <td
                                                                                            class="jathakatam small text-center align-middle">
                                                                                            {{ $UserHoroscopeInfo->navam_katam_row_3_col_4->flatten()->pluck('horoscope_name')[0] ?? '-' }}
                                                                                        </td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td
                                                                                            class="jathakatam small text-center align-middle">
                                                                                            {{ $UserHoroscopeInfo->navam_katam_row_4_col_1->flatten()->pluck('horoscope_name')[0] ?? '-' }}
                                                                                        </td>
                                                                                        <td
                                                                                            class="jathakatam small text-center align-middle">
                                                                                            {{ $UserHoroscopeInfo->navam_katam_row_4_col_2->flatten()->pluck('horoscope_name')[0] ?? '-' }}
                                                                                        </td>
                                                                                        <td
                                                                                            class="jathakatam small text-center align-middle">
                                                                                            {{ $UserHoroscopeInfo->navam_katam_row_4_col_3->flatten()->pluck('horoscope_name')[0] ?? '-' }}
                                                                                        </td>
                                                                                        <td
                                                                                            class="jathakatam small text-center align-middle">
                                                                                            {{ $UserHoroscopeInfo->navam_katam_row_4_col_4->flatten()->pluck('horoscope_name')[0] ?? '-' }}
                                                                                        </td>
                                                                                    </tr>
                                                                                </tbody>
                                                                            </table>
                                                                        </div>
                                                                    @endif
                                                                    @if ($UserHoroscopeInfo->user_jathakam_image_is_uploaded == 1)
                                                                        <div class="col-md-6 text-center">
                                                                            <a href="{{ $UserHoroscopeInfo->user_jathakam_image }}"
                                                                                target="_blank" rel="noopener noreferrer">
                                                                                <img src="{{ $UserHoroscopeInfo->user_jathakam_image }}"
                                                                                    class="card-img-top w-50 rounded">
                                                                            </a>
                                                                        </div>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script>
        // SWAP IMAGES
        $($('.images').children()).click(function(index, element) {
            console.log(this.src);
            var img = $('<img />', {
                src: this.src,
                'class': 'rounded'
            });

            $('.main-img').html(img).show();
        });
        // SWAP IMAGES
    </script>
@endsection
