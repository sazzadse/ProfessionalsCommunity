<?php
$page_title = "President's Message";

include 'includes/config.php';
include 'includes/header.php';
?>

<style>
    .itlc-about {
        padding: 170px 0 60px;
        color: #06487a;
    }

    .itlc-about h1 {
        color: #ffbc3b;
    }

    .itlc-about h2,
    .itlc-about p,
    .itlc-about strong {
        color: #06487a;
    }

    /* Main Title */
    .itlc-about .main-title {
        font-size: 25px;
        font-weight: 700;
        line-height: 1.4;
        margin: 0 0 12px;
    }

    /* Title Underline */
    .itlc-about .title-accent {
        width: 45px;
        height: 3px;
        background: #06487a;
        border-radius: 2px;
        margin-bottom: 25px;
    }

    /* Message Content */
    .itlc-about p {
        color: #06487a;
        font-size: 15px;
        line-height: 1.8;
        font-weight: 400;
        margin: 0 0 14px;
        text-align: justify;
    }

    .itlc-about strong {
        font-weight: 700;
    }

    /* President Photo */
    .itlc-about .president-photo {
        float: left;
        width: 210px;
        max-width: 100%;
        height: auto;
        margin: 0 25px 15px 0;
        padding: 5px;
        background: #fff;
        border-radius: 4px;
        object-fit: cover;
    }

    /* Greeting */
    .itlc-about .president-greeting {
        font-size: 17px;
        font-weight: 700;
        margin-bottom: 5px;
    }

    .itlc-about .president-opening {
        font-style: italic;
        margin-bottom: 10px;
    }

    /* Clear Float */
    .itlc-about .message-content::after {
        content: "";
        display: block;
        clear: both;
    }

    /* President Signature */
    .itlc-about .president-signature {
        margin-top: 45px;
        text-align: right;
    }

    .itlc-about .president-signature p {
        text-align: right;
        margin-bottom: 4px;
    }

    .itlc-about .president-signature .signature-name {
        font-weight: 700;
        margin-top: 8px;
    }

    /* Mobile Responsive */
    @media (max-width: 767px) {
        .itlc-about {
            padding: 120px 0 40px;
        }

        .itlc-about .main-title {
            font-size: 25px;
        }

        .itlc-about .president-photo {
            float: none;
            display: block;
            width: 200px;
            margin: 0 auto 20px;
        }

        .itlc-about .president-greeting {
            text-align: left;
        }

        .itlc-about .president-signature {
            margin-top: 30px;
        }
    }
</style>

<section class="itlc-about">
    <div class="container">

        <!-- Page Title -->
        <div class="row">
            <div class="col-12">
                <h1 class="main-title">President's Message</h1>
                <div class="title-accent"></div>
            </div>
        </div>

        <!-- President's Message -->
        <div class="row">
            <div class="col-12">

                <div class="message-content">

                    <img
                        src="images/members/Md_Fokrul_Islam_President.jpg"
                        alt="Md. Fokrul Islam, President of ITLC"
                        class="president-photo"
                        loading="lazy"
                    >

                    <p class="president-greeting">
                        Dear Fellow Members and Colleagues
                    </p>

                    <p class="president-opening">
                        Assalamualaikum and Sincere Greetings to all IT
                        leaders and professionals,
                    </p>

                    <p>
                        It is an honor to serve as the President of the
                        IT Leadership Community (ITLC), a platform
                        dedicated to uniting and empowering IT
                        professionals across Bangladesh and beyond.
                        Our community has grown to connect over 300
                        CIOs, CTOs, Heads of IT, and technology leaders
                        from renowned local and international
                        organizations. Together, we are shaping the
                        future of the IT profession. At ITLC, our
                        mission is to foster leadership, collaboration,
                        and innovation within the IT industry. We
                        believe in the power of shared knowledge and
                        experiences, which is why we focus on creating
                        opportunities for our members to grow through
                        networking, skill development, and mentorship.
                        By upholding the highest standards of
                        excellence, we aim to elevate the IT profession
                        and contribute to the sustainable growth of
                        Bangladesh's technology landscape. As we
                        navigate an era of rapid technological
                        advancement, the role of IT leaders has never
                        been more critical.
                    </p>

                </div>

                <p>
                    ITLC is committed to supporting our members by
                    providing them with the tools, resources, and
                    community they need to succeed in an increasingly
                    digital world. Whether through workshops, webinars,
                    leadership programs, or action teams, we are here
                    to guide and support one another in achieving our
                    goals. I invite all IT professionals who share our
                    vision to join us in this journey. Together, we can
                    drive positive change, not only for our profession
                    but for society as a whole. Thank you for your
                    continued trust and dedication. I look forward to
                    working alongside all of you to create a
                    tech-powered, innovative future for Bangladesh.
                </p>

                <!-- President's Signature -->
                <div class="president-signature">
                    <p>With regards,</p>

                    <p class="signature-name">
                        Md.Fokrul Islam, PMP®, CISA®
                    </p>

                    <p>
                        <strong>
                            President, IT Leadership Community (ITLC)
                        </strong>
                    </p>
                </div>

            </div>
        </div>

    </div>
</section>

<?php
include 'includes/footer.php';
?>