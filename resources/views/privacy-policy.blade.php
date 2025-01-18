@extends('layout.app')
@section('main_section')
    <style>
        #main-image {
            margin-bottom: -125px;
            width: 85%;
            transform: rotate(5deg);
        }
    </style>

    <div class="position-relative text-white" style="background-color: #125259;">
        <div class="position-relative " style="z-index: 99999">
            @include('components.navbar')
        </div>
        <div
            style="z-index:0.5;position: absolute; top: 0; left: 0; width: 100%; height: 100%; background-image: url('images/home-section-1.png'); opacity: 0.15;">
        </div>
        <div class="container py-5 mt-5">
            <div class="row text-white align-items-center">
                <div class="col-lg-12 col-12 order-lg-2 order-1 mb-5">
                    <h1 style="font-size: 53px;" class="fw-bold text-uppercase text-center mb-5">PRIVACY POLICY</h1>
                </div>
            </div>
        </div>
    </div>
    <div class="mb-5 container py-5" style="width:100vw;">
        <div class="row pb-5 fs-4">
            <p>This Privacy Policy applies between you, the User of this Website, and Net Zero Foods Ltd, the owner and
                provider of this Website. Net Zero Foods Ltd takes the privacy of your information very seriously. This
                Privacy Policy
                applies to our use of any and all Data collected by us or provided by you in relation to your use of the
                Website.</p>
            <b>Please read this Privacy Policy carefully.</b>
            <h4 class="my-4">Definitions and Interpretation</h4>
            <ol>
                <li class="mb-2">In this Privacy Policy, the following definitions are used:</li>
                <table class="table table-bordered ">
                    <tr>
                        <td class="w-25">
                            <b>Data</b>
                        </td>
                        <td class="w-75">
                            <p>collectively all information that you submit to Net Zero Foods Ltd via the Website. This
                                definition
                                incorporates, where applicable, the definitions provided in the Data Protection Laws;</p>
                        </td>
                    </tr>
                    <tr>
                        <td class="w-25">
                            <b>Cookies </b>
                        </td>
                        <td class="w-75">
                            <p>a small text file placed on your computer by this Website when you visit certain parts of the
                                Website
                                and/or when you use certain features of the Website. Details of the cookies used by this
                                Website are
                                set out in the clause below (Cookies);</p>
                        </td>
                    </tr>
                    <tr>
                        <td class="w-25">
                            <b>Data Protection Laws</b>
                        </td>
                        <td class="w-75">
                            <p>any applicable law relating to the processing of personal Data, including but not limited to
                                the GDPR,
                                and any national implementing and supplementary laws, regulations and secondary legislation;
                            </p>
                        </td>
                    </tr>
                    <tr>
                        <td class="w-25">
                            <b>GDPR</b>
                        </td>
                        <td class="w-75">
                            <p>the UK General Data Protection Regulation; </p>
                        </td>
                    </tr>
                    <tr>
                        <td class="w-25">
                            <b>Net Zero Foods Ltd, we or us
                            </b>
                        </td>
                        <td class="w-75">
                            <p>Net Zero Foods Ltd, a company incorporated in England and Wales with registered number
                                936737145 whose registered office is at Net Zero Foods Ltd, 46-54 High Street, Essex, CM4
                                9DW; </p>
                        </td>
                    </tr>
                    <tr>
                        <td class="w-25">
                            <b>UK and EU Cookie Law</b>
                        </td>
                        <td class="w-75">
                            <p>the Privacy and Electronic Communications (EC Directive) Regulations 2003 as amended by the
                                Privacy and Electronic Communications (EC Directive) (Amendment) Regulations 2011 & the
                                Privacy
                                and Electronic Communications (EC Directive) (Amendment) Regulations 2018;</p>
                        </td>
                    </tr>
                    <tr>
                        <td class="w-25">
                            <b>User or you </b>
                        </td>
                        <td class="w-75">
                            <p>any third party that accesses the Website and is not either (i) employed by Net Zero Foods
                                Ltd and
                                acting in the course of their employment or (ii) engaged as a consultant or otherwise
                                providing
                                services to Net Zero Foods Ltd and accessing the Website in connection with the provision of
                                such
                                services; and
                            </p>
                        </td>
                    <tr>
                        <td class="w-25">
                            <b>Website</b>
                        </td>
                        <td class="w-75">
                            <p>the website that you are currently using, www.robotkombucha.co.uk, and any sub-domains of
                                this site unless expressly excluded by their own terms and conditions.</p>
                        </td>
                    </tr>
                </table>
                <li class="mb-2">In this Privacy Policy, unless the context requires a different interpretation:</li>
                <ol style="list-style: lower-alpha">
                    <li class="my-2">the singular includes the plural and vice versa;</li>
                    <li class="my-2">references to sub-clauses, clauses, schedules or appendices are to sub-clauses,
                        clauses, schedules
                        or appendices of this Privacy Policy;</li>
                    <li class="my-2">a reference to a person includes firms, companies, government entities, trusts and
                        partnerships;
                    </li>
                    <li class="my-2">"including" is understood to mean "including without limitation";
                    </li>
                    <li class="my-2">reference to any statutory provision includes any modification or amendment of it;
                    </li>
                    <li class="my-2">the headings and sub-headings do not form part of this Privacy Policy.</li>
                </ol>
                <h4 class="my-4">Scope of this Privacy Policy</h4>
                <li class="mb-2">This Privacy Policy applies only to the actions of Net Zero Foods Ltd and Users with
                    respect to this
                    Website. It does
                    not extend to any websites that can be accessed from this Website including, but not limited to, any
                    links we may
                    provide to social media websites.</li>
                <li class="mb-2">For purposes of the applicable Data Protection Laws, Net Zero Foods Ltd is the "data
                    controller". This
                    means that Net
                    Zero Foods Ltd determines the purposes for which, and the manner in which, your Data is processed. </li>

                <h4 class="my-4">Data Collected</h4>
                <li class="mb-2">We may collect the following Data, which includes personal Data, from you:</li>
                <ul style="list-style: lower-alpha">
                    <li class="mb-3">name;</li>
                    <li class="mb-3">contact Information such as email addresses and telephone numbers;</li>
                </ul>
                <span>in each case, in accordance with this Privacy Policy.</span>
                <h4 class="my-4">How We Collect Data</h4>
                <li class="mb-2">We collect Data in the following ways:</li>
                <ul style="list-style: lower-alpha">
                    <li class="mb-3">data is given to us by you; and</li>
                    <li class="mb-3">data is collected automatically</li>
                </ul>
                <h4 class="my-4">Data That is Given to Us by You</h4>
                <li class="mb-2">Net Zero Foods Ltd will collect your Data in a number of ways, for example:</li>
                <ul style="list-style: lower-alpha">
                    <li class="mb-3">when you contact us through the Website, by telephone, post, e-mail or through any
                        other means;</li>
                    <li class="mb-3">when you elect to receive marketing communications from us;</li>
                </ul>
                <span>in each case, in accordance with this Privacy Policy</span>
                <h4 class="my-4">Data That is Collected Automatically</h4>
                <li class="mb-2">To the extent that you access the Website, we will collect your Data automatically, for
                    example:</li>
                <ul style="list-style: lower-alpha">
                    <li class="mb-3">we automatically collect some information about your visit to the Website. This
                        information helps us to make
                        improvements to Website content and navigation, and includes your IP address, the date, times and
                        frequency
                        with which you access the Website and the way you use and interact with its content.</li>
                    <li class="mb-3">we will collect your Data automatically via cookies, in line with the cookie settings
                        on your browser. For more
                        information about cookies, and how we use them on the Website, see the section below, headed
                        "Cookies".</li>
                </ul>
                <h4 class="my-4">Our Use of Data</h4>
                <li class="mb-2">Any or all of the above Data may be required by us from time to time in order to provide
                    you with the best possible
                    service and experience when using our Website. Specifically, Data may be used by us for the following
                    reasons:
                </li>
                <ul style="list-style: lower-alpha">
                    <li class="mb-3">internal record keeping;</li>
                    <li class="mb-3">improvement of our products / services;</li>
                    <li class="mb-3">transmission by email of marketing materials that may be of interest to you;</li>
                </ul>
                <span>in each case, in accordance with this Privacy Policy.</span>

                <li class="mb-3">We may use your Data for the above purposes if we deem it necessary to do so for our legitimate
                    interests. If you are
                    not satisfied with this, you have the right to object in certain circumstances (see the section headed
                    "Your rights"
                    below).
                </li>
                <li class="mb-3">For the delivery of direct marketing to you via e-mail, we'll need your consent, whether via an opt-in
                    or soft-opt-in:
                </li>
                <ul style="list-style: lower-alpha">
                    <li class="mb-3">soft opt-in consent is a specific type of consent which applies when you have previously engaged
                        with us (for
                        example, you contact us to ask us for more details about a particular product/service, and we are
                        marketing
                        similar products/services). Under "soft opt-in" consent, we will take your consent as given unless
                        you opt-out.</li>
                    <li class="mb-3">for other types of e-marketing, we are required to obtain your explicit consent; that is, you need
                        to take positive
                        and affirmative action when consenting by, for example, checking a tick box that we'll provide</li>
                    <li class="mb-3">if you are not satisfied with our approach to marketing, you have the right to withdraw consent at
                        any time. To
                        find out how to withdraw your consent, see the section headed "Your rights" below.
                    </li>
                </ul>

                <li class="mb-3">We may use your Data to show you Net Zero Foods Ltd adverts and other content on other websites. If you
                    do not
                    want us to use your data to show you Net Zero Foods Ltd adverts and other content on other websites,
                    please turn off
                    the relevant cookies (please refer to the section headed "Cookies" below).
                </li>
                <h4 class="my-4">
                    Who We Share Data With
                </h4>
                <li class="mb-3">We may share your Data with the following groups of people for the following reasons:</li>
                <ul style="list-style: lower-alpha">
                    <li>any of our group companies or affiliates - We share certain aspects of data in order to improve our
                        organisation
                        operating practices and products. ;
                    </li>
                    <li>
                        our employees, agents and/or professional advisors - In order for staff to process orders,
                        information and
                        maintain contact. ;
                    </li>
                </ul>
                <span>in each case, in accordance with this Privacy Policy.</span>
                <h4 class="my-4">
                    Keeping Data Secure
                </h4>
                <li class="mb-3">We will use technical and organisational measures to safeguard your Data, for example::</li>
                <ul style="list-style: lower-alpha">
                    <li>access to your account is controlled by a password and a user name that is unique to you
                    </li>
                    <li>
                        we store your Data on secure servers.
                    </li>
                </ul>
                <li class="mb-3">Technical and organisational measures include measures to deal with any suspected data breach. If you
                    suspect any
                    misuse or loss or unauthorised access to your Data, please let us know immediately by contacting us via
                    this e-mail
                    address: pascalsubois1@mail.com.</li>
                <li class="mb-3">If you want detailed information from Get Safe Online on how to protect your information and your
                    computers and
                    devices against fraud, identity theft, viruses and many other online problems, please visit
                    www.getsafeonline.org. Get
                    Safe Online is supported by HM Government and leading businesses.</li>

                <h4 class="my-4">
                    Data Retention
                </h4>
                <li class="mb-3">Unless a longer retention period is required or permitted by law, we will only hold your Data on our
                    systems for the
                    period necessary to fulfil the purposes outlined in this Privacy Policy or until you request that the
                    Data be deleted.</li>
                <li class="mb-3">Even if we delete your Data, it may persist on backup or archival media for legal, tax or regulatory
                    purposes.</li>
                <h4 class="my-4">
                    Your Rights
                </h4>
                <li class="mb-3">You have the following rights in relation to your Data:</li>
                <ul style="list-style: lower-alpha;">
                    <li><b>Right to access:</b> - the right to request (i) copies of the information we hold about you at
                        any
                        time, or (ii) that we
                        modify, update or delete such information. If we provide you with access to the information we hold
                        about you,
                        we will not charge you for this, unless your request is "manifestly unfounded or excessive." Where
                        we are legally
                        permitted to do so, we may refuse your request. If we refuse your request, we will tell you the
                        reasons why.</li>
                    <li><b>Right to correct:</b> - the right to have your Data rectified if it is inaccurate or incomplete.
                    </li>
                    <li><b>Right to erase:</b> - the right to request that we delete or remove your Data from our systems.
                    </li>
                    <li><b>Right to restrict our use of your Data -:</b> - the right to "block" us from using your Data or
                        limit the way in which
                        we can use it. </li>
                    <li><b>Right to data portability:</b> - the right to request that we move, copy or transfer your Data
                    </li>
                    <li><b>Right to object:</b> - the right to object to our use of your Data including where we use it for
                        our legitimate interests.</li>
                </ul>
                <li class="mb-3">To make enquiries, exercise any of your rights set out above, or withdraw your consent to the processing
                    of your Data
                    (where consent is our legal basis for processing your Data), please contact us via this e-mail address:
                    pascalsubois1@mail.com.
                </li>
                <li class="mb-3">If you are not satisfied with the way a complaint you make in relation to your Data is handled by us,
                    you may be able
                    to refer your complaint to the relevant data protection authority. For the UK, this is the Information
                    Commissioner's
                    Office (ICO). The ICO's contact details can be found on their website at https://ico.org.uk/.
                </li>
                <li class="mb-3">It is important that the Data we hold about you is accurate and current. Please keep us informed if your
                    Data changes
                    during the period for which we hold it.
                </li>
                <h4 class="my-4">Links to Other Websites</h4>
                <li class="mb-3">This Website may, from time to time, provide links to other websites. We have no control over such
                    websites and are
                    not responsible for the content of these websites. This Privacy Policy does not extend to your use of
                    such websites.
                    You are advised to read the Privacy Policy or statement of other websites prior to using them.
                </li>
                <h4 class="my-4">Changes of Business Ownership and Control</h4>
                <li class="mb-3">Net Zero Foods Ltd may, from time to time, expand or reduce our business and this may involve the sale
                    and/or the
                    transfer of control of all or part of Net Zero Foods Ltd. Data provided by Users will, where it is
                    relevant to any part of
                    our business so transferred, be transferred along with that part and the new owner or newly controlling
                    party will,
                    under the terms of this Privacy Policy, be permitted to use the Data for the purposes for which it was
                    originally
                    supplied to us.
                </li>
                <li class="mb-3">We may also disclose Data to a prospective purchaser of our business or any part of it. </li>
                <li>In the above instances, we will take steps with the aim of ensuring your privacy is protected.</li>
                <h4 class="my-4">Cookies</h4>
                <li class="mb-3">This Website may place and access certain Cookies on your computer. Net Zero Foods Ltd uses Cookies to
                    improve
                    your experience of using the Website and to improve our range of products. Net Zero Foods Ltd has
                    carefully
                    chosen these Cookies and has taken steps to ensure that your privacy is protected and respected at all
                    times.
                </li>
                <li class="mb-3">All Cookies used by this Website are used in accordance with current UK and EU Cookie Law.
                </li>
                <li class="mb-3">Before the Website places Cookies on your computer, you will be presented with a message bar requesting
                    your
                    consent to set those Cookies. By giving your consent to the placing of Cookies, you are enabling Net
                    Zero Foods Ltd
                    to provide a better experience and service to you. You may, if you wish, deny consent to the placing of
                    Cookies;
                    however certain features of the Website may not function fully or as intended.
                </li>
                <li class="mb-3">This Website may place the following Cookies:</li>
                <table class="table table-bordered ">
                    <tr>
                        <th>Type of Cookie </th>
                        <th>Purpose</th>
                    </tr>
                    <tr>
                        <td>Strictly necessary cookies </td>
                        <td>These are cookies that are required for the operation of
                            our website. They include, for example, cookies that
                            enable you to log into secure areas of our website, use a
                            shopping cart or make use of e-billing services.</td>
                    </tr>
                    <tr>
                        <td>Analytical/performance cookies </td>
                        <td>They allow us to recognise and count the number of
                            visitors and to see how visitors move around our website
                            when they are using it. This helps us to improve the way
                            our website works, for example, by ensuring that users
                            are finding what they are looking for easily.</td>
                    </tr>
                    <tr>
                        <td>Functionality cookies </td>
                        <td>These are used to recognise you when you return to our
                            website. This enables us to personalise our content for
                            you, greet you by name and remember your preferences
                            (for example, your choice of language or region). By
                            using the Website, you agree to our placement of
                            functionality cookie.</td>
                    </tr>
                    <tr>
                        <td>Targeting cookies</td>
                        <td>These cookies record your visit to our website, the pages
                            you have visited and the links you have followed. We
                            will use this information to make our website and the
                            advertising displayed on it more relevant to your
                            interests. We may also share this information with third
                            parties for this purpose.
                        </td>
                    </tr>
                </table>
                <li class="mb-3">You can find a list of Cookies that we use in the Cookies Schedule.</li>
                <li class="mb-3">You can choose to enable or disable Cookies in your internet browser. By default, most internet browsers
                    accept
                    Cookies but this can be changed. For further details, please see the help menu in your internet browser.
                    You can
                    switch off Cookies at any time, however, you may lose any information that enables you to access the
                    Website more
                    quickly and efficiently.
                </li>
                <li class="mb-3">You can choose to delete Cookies at any time; however, you may lose any information that enables you to
                    access the
                    Website more quickly and efficiently including, but not limited to, personalisation settings.
                </li>
                <li class="mb-3">It is recommended that you ensure that your internet browser is up-to-date and that you consult the help
                    and guidance
                    provided by the developer of your internet browser if you are unsure about adjusting your privacy
                    settings.
                </li>
                <li class="mb-3">For more information generally on cookies, including how to disable them, please refer to
                    aboutcookies.org. You will
                    also find details on how to delete cookies from your computer.
                </li>
                <h4 class="my-4">
                    General
                </h4>
                <li class="mb-3">
                    You may not transfer any of your rights under this Privacy Policy to any other person. We may transfer
                    our rights
                    under this Privacy Policy where we reasonably believe your rights will not be affected.
                </li>
                <li class="mb-3">
                    If any court or competent authority finds that any provision of this Privacy Policy (or part of any
                    provision) is invalid,
                    illegal or unenforceable, that provision or part-provision will, to the extent required, be deemed to be
                    deleted, and the
                    validity and enforceability of the other provisions of this Privacy Policy will not be affected.
                </li>
                <li class="mb-3">
                    Unless otherwise agreed, no delay, act or omission by a party in exercising any right or remedy will be
                    deemed a
                    waiver of that, or any other, right or remedy.
                </li>
                <li class="mb-3">
                    This Agreement will be governed by and interpreted according to the law of England and Wales. All
                    disputes arising
                    under the Agreement will be subject to the exclusive jurisdiction of the English and Welsh courts.
                </li>
                <h4 class="my-4">Changes to This Privacy Policy</h4>
                <li class="mb-3">
                    Net Zero Foods Ltd reserves the right to change this Privacy Policy as we may deem necessary from time
                    to time or
                    as may be required by law. Any changes will be immediately posted on the Website and you are deemed to
                    have
                    accepted the terms of the Privacy Policy on your first use of the Website following the alterations.
                </li>
              
                <span class="mt-2">This Privacy Policy was created on 01 May 2024.</span>
            </ol>
        </div>
        <button class="btn btn-dark px-4" id="saveIp">Accept</button>
        <script>
        $(document).ready(function() {
            $('#saveIp').click(function() {
                $.ajax({
                    url: 'https://api.ipify.org?format=json',
                    type: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        const ipAddress = data.ip;
                        saveIntoDb(ipAddress);
                    },
                    error: function(xhr, status, error) {
                        console.error('Error fetching IP address:', error);
                    }
                });
            });

            function saveIntoDb(Ip) {
                $.ajax({
                    type: "GET",
                    url: "{{ route('save.ip') }}",
                    data: {
                        ip: Ip
                    },
                    success: function (response) {
                        console.log(response);
                        if (response.status == true) {
                             toastr.success("Thanks for acception terms and condition!");
                             setInterval(() => {
                                window.location.href = "/";
                             }, 1000);
                        }
                    }
                });
            }
        });
    </script>
    </div>
@endsection
