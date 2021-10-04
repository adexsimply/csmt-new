<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CSMT Testimonial</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        html,
        body {
            width: 100%;
            height: 100vh;
            background: #fff;
            color: #000;
            font-family: cursive;
        }

        h1,
        h2,
        h3,
        h4,
        h5,
        h6,
        p {
            margin: 0;
        }

        a {
            text-decoration: none;
        }

        .page-container {
            border: 2px solid;
            margin: 2rem;
            min-height: calc(100% - 4rem);
            padding-bottom: 60px;
        }

        /*  HEADER */
        .navbar {
            margin: 0 0.8rem 0.8rem;
            display: flex;
            border-left: 2px solid;
            border-right: 2px solid;
            border-bottom: 2px solid;
        }

        .navbar .logo-container {
            width: 150px;
            height: 150px;
        }

        .navbar .logo-container img {
            width: 100%;
            height: 100%;
        }

        .navbar .school-details {
            text-align: center;
            flex: 1;
        }

        .school-details .info {
            font-family: cursive;
            font-size: 27px;
            margin-bottom: 1rem;
        }

        .school-details .contact {
            font-family: cursive;
            font-size: 18px;
        }

        .testimonial-container {
            margin-top: 1.5rem;
            border-top: 2px solid;
            padding: 0 2rem;
        }

        .testimonial-header {
            display: flex;
            margin-top: 5px;
            align-items: center;
        }

        .banner {
            flex: 1;
        }

        .banner h3 {
            background: purple;
            width: 50%;
            text-align: center;
            color: yellow;
            line-height: 60px;
            font-size: 40px;
            text-transform: uppercase;
            margin-left: 35%;
            font-weight: 100;
        }

        .user-photo {
            width: 200px;
            height: 200px;
            border: 1px dashed;
            padding: 5px;
        }

        .user-photo .user-bg {
            background: #e1e1e1;
            height: 100%;
            width: 100%;
        }

        .certify {
            text-align: center;
            margin-top: 10px;
        }

        .certify h3 {
            font-size: 24px;
            margin-bottom: 1rem;
        }

        .certify p {
            color: blue;
            font-size: 1.3rem;
            font-family: cursive;
        }

        .student-info {
            width: 100%;
        }

        .student-info .intro {
            font-family: cursive;
            font-size: 14px;
            margin: 1rem 0;
        }

        .student-grade-wrapper {
            margin-top: 1rem;
            display: flex;
            align-items: center;
        }

        .student-grade-wrapper .subject {
            font-size: 1rem;
            font-weight: 500;
            width: 50%;
            font-family: cursive;
        }

        .student-grade-wrapper .conclusion {
            font-size: 1rem;
            font-weight: 500;
            width: 100%;
            font-family: cursive;
        }

        .student-grade-wrapper .grades {
            font-weight: 400;
            color: blue;
            font-size: 16px;
            text-transform: capitalize;
            font-family: cursive;
        }

        .signature {
            margin-top: 1rem;
            display: flex;
            justify-content: flex-end;
        }

        .signature img {
            width: 100px;
        }

        .stamp {

            height: 4px;
            background: blue;
            position: relative;
            margin-top: 2rem;
        }

        .stamp img {
            width: 80px;
            position: absolute;
            left: 50%;
            top: -30px;
        }

        @media screen and (max-width:768px) {
            .stamp {
                height: 4px;
                background: blue;
                position: relative;
                margin-top: 2rem;
            }

            .stamp img {
                width: 80px;
                position: absolute;
                left: 45%;
                top: -30px;
            }
        }

        @media screen and (max-width: 575px) {
            .navbar {
                flex-direction: column;
                align-items: center;
                padding: 0 1rem;
            }

            .testimonial-container {
                padding: 0 1rem;
            }

            .testimonial-header {
                flex-direction: column;
            }

            .banner {
                width: 100%;
                margin-bottom: 1rem;
            }

            .banner h3 {
                width: 100%;
                -webkit-print-color-adjust: exact;
            }

            .student-info {
                width: 100%;
            }

            .stamp {
                height: 4px;
                background: blue;
                position: relative;
                margin-top: 2rem;
            }

            .stamp img {
                width: 80px;
                position: absolute;
                left: 38%;
                top: -30px;
            }
        }

        @media print {
            .banner h3 {
                -webkit-print-color-adjust: exact;
            }

            .stamp {
                -webkit-print-color-adjust: exact;
            }

            .stamp img {
                left: 45%;
            }
        }
    </style>
</head>

<body>
    <section class="page-container">
        <header class="navbar">
            <div class="logo-container">
                <img src="{{ asset('storage/images/logo.jpg') }}" alt="csmt logo">
            </div>
            <div class="school-details">
                <div class="info">
                    <h2>CSMT&#160;STAFF&#160;SECONDARY&#160;SCHOOL</h2>
                </div>
                <div class="contact">
                    <p>Along Watchman Street, P.M.B 147 Abakaliki, Ebonyi State. </p>
                    <p>Email : csmtschools@gmail.com. Tel : 08032124870,07060725882.</p>
                </div>


            </div>
        </header>

        <section class="testimonial-container">
            <div class="testimonial-header">
                <div class="banner">
                    <h3 style="font-weight: 300;">Testimonial</h3>
                </div>
                <div class="user-photo">
                    <div class="user-bg"><img src="{{asset('../storage/app/public/passports/'.$student->image)}}" width="200px;"></div>
                </div>
            </div>
            <div class="certify">
                <h3 style="font-weight: 300; font-size: 24px;">This is to certify that</h3>
                <p><strong>{{$student->name}}</strong></p>
            </div>
            <section class="student-info">

                <p class="intro">With registration number {{$student->admission_no}} was a bona fide student of this school from {{$student->session_admitted}} to
                    {{$student->session_graduated}}
                    academic sessions and
                    has completed his secondary education. </p>

                <div class="student-grade-wrapper">
                    <p class="subject">
                        He was good at:
                    </p>
                    <p class="grades">{{$student->areas_good_at}}</p>

                </div>
                <div class="student-grade-wrapper">
                    <p class="subject">
                        Post Held in School:
                    </p>
                    <p class="grades">{{$student->post_held}}</p>

                </div>
                <div class="student-grade-wrapper">
                    <p class="subject">
                        Academic Ability: 
                    </p>
                    <p class="grades">{{$student->abilities}}</p>

                </div>
                <div class="student-grade-wrapper">
                    <p class="subject">
                        General Conduct: 
                    </p>
                    <p class="grades">{{$student->conduct}}</p>

                </div>
                <div class="student-grade-wrapper">
                    <p class="conclusion" style="font-size: 20px;">
                        We, therefore, found him worthy of commendation in character and learning.
                    </p>

                </div>
            </section>
            <div class="signature">
                <img src="{{ asset('storage/images/siggy.jpg') }}" alt="">
            </div>
            <div class="stamp">
                <img src="{{ asset('storage/images/stamp.jpg') }}" alt="">
            </div>
        </section>

    </section>

</body>

</html>