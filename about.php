<?php
//SESSION START
session_start();
/* AUTOLOADER */
include './php/backend/includes/class-autoload.inc.php';
?>

<?php
$reauthuser = new ReAuth();
$reauthuser->reAuthUser();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0 maximum-scale=1.0, user-scalable=0">
    <title>Trixion - About</title>
    <link rel="stylesheet" href="./css/styles.css">
    <script src="https://kit.fontawesome.com/f95bd0d248.js" crossorigin="anonymous"></script>
    <!-- META TAGS -->
    <meta property="og:title" content="Trixion Planner">
    <meta property="og:site_name" content="trixion.net">
    <meta property="og:url" content="https://www.trixion.net">
    <meta property="og:description" content="Lost Ark fan-made site: · Daily Planner · Guild 'in-need' market · Guild Event Manager">
    <meta property="og:type" content="website">
    <meta property="og:image" content="../public/img/hexfield-logo.svg">
    <meta name="theme-color" content="#2a2f55">
    <!-- Favicon -->
    <link rel="apple-touch-icon" sizes="180x180" href="./favicon//apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="./favicon//favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="./favicon/favicon-16x16.png">
    <link rel="manifest" href="./favicon/site.webmanifest">
</head>

<body>

    <?php
    $main = new Main();
    if (isset($_SESSION["id_user"])) {
        $userSession = $_SESSION["id_user"];

        $userData = $main->getUserData($userSession);
        $userData = json_decode($userData, true);
    }
    ?>


    <!-- SideBar -->
    <div class="sidebar noselect">
        <div class="navbartop">
            <i id="hamburger" class="fa-solid fa-bars fa-2xl"></i>
        </div>
        <div class="logo">
            <span>Trixion</span>
            <img src="./public/img/hexfield-logo.svg">
        </div>
        <div class="wrapperlittle mqr">
            <div class="scrollwrapper">
                <a id="home"><img src="./public/img/faicons/house-solid.svg">Home</a>
                <!-- <a id="dashboard"><img src="./public/img/faicons/book-open-reader-solid.svg"> Dashboard</a> -->
                <a id="guildplanner"><img src="./public/img/faicons/sitemap-solid.svg">Guild Planner</a>
                <!-- <a id="guildmarket"><img src="./public/img/faicons/store-solid.svg">Guild Market</a>
        <a id="dailyplanner"><img src="./public/img/faicons/calendar-check-solid.svg">Daily Check</a> -->
                <a id="support"><img src="./public/img/faicons/life-ring-solid.svg">Support</a>
                <a id="account"><img src="./public/img/faicons/user-solid.svg">Account</a>
                <a class="selectedSidebar" id="about"><img src="./public/img/faicons/circle-question-solid.svg">About</a>
                <?php
                if (isset($userSession)) {
                ?>
                    <a href="./php/backend/includes/Logout.inc.php" id="logoutbtn">Logout</a>
                <?php
                }
                ?>

                <?php
                if (isset($userSession)) {
                    echo "<a id='usersidebar' class='usersidebar'>" . $userData[0]['username'] . "";
                    if (isset($userData[0]['id_guild'])) {
                        $guildData = $main->getGuildData($userData[0]['id_guild']);
                        $guildData = json_decode($guildData, true);

                        echo "<br>" . $guildData[0]['name'] . "</a>";
                    } else {
                        echo "</a>";
                    }
                } else {
                    echo "<a id='usersidebar' class='usersidebar'></a>";
                }
                ?>

            </div>
        </div>
    </div>
    <!-- Content -->
    <div class="content">
        <div id="main" class="main">
            <!-- Main Landing -->



            <div class="about noselect mqr">
                <h1>Trixion</h1>
                <span>
                    This site has been created with the purpose of helping LostArk users, making planning events easier.
                    <br>
                    This toolset has been made by Alexmofu#1917.
                    <br>
                    Any suggestions are welcome!
                </span>
            </div>

            <div class="about policy">
                <h1>Privacy Policy</h1>

                <p>Last updated: May 24, 2022</p>
                <div class="policysection">
                    <p>This Privacy Policy describes Our policies and procedures on the collection, use and disclosure of Your information when You use the Service and tells You about Your privacy rights and how the law protects You.</p>
                    <p>We use Your Personal data to provide and improve the Service. By using the Service, You agree to the collection and use of information in accordance with this Privacy Policy.</p>
                </div>
                <h1>Interpretation and Definitions</h1>
                <div class="policysection">
                    <h2>Interpretation</h2>
                    <p>The words of which the initial letter is capitalized have meanings defined under the following conditions. The following definitions shall have the same meaning regardless of whether they appear in singular or in plural.</p>
                    <h2>Definitions</h2>
                    <p style="text-align: center;">For the purposes of this Privacy Policy:</p>
                    <ul>
                        <li>
                            <p><strong class="policystrong">Account</strong> means a unique account created for You to access our Service or parts of our Service.</p>
                        </li>
                        <li>
                            <p><strong class="policystrong">Company</strong> (referred to as either &quot;the Company&quot;, &quot;We&quot;, &quot;Us&quot; or &quot;Our&quot; in this Agreement) refers to Trixion.</p>
                        </li>
                        <li>
                            <p><strong class="policystrong">Cookies</strong> are small files that are placed on Your computer, mobile device or any other device by a website, containing the details of Your browsing history on that website among its many uses.</p>
                        </li>
                        <li>
                            <p><strong class="policystrong">Country</strong> refers to: Spain</p>
                        </li>
                        <li>
                            <p><strong class="policystrong">Device</strong> means any device that can access the Service such as a computer, a cellphone or a digital tablet.</p>
                        </li>
                        <li>
                            <p><strong class="policystrong">Personal Data</strong> is any information that relates to an identified or identifiable individual.</p>
                        </li>
                        <li>
                            <p><strong class="policystrong">Service</strong> refers to the Website.</p>
                        </li>
                        <li>
                            <p><strong class="policystrong">Service Provider</strong> means any natural or legal person who processes the data on behalf of the Company. It refers to third-party companies or individuals employed by the Company to facilitate the Service, to provide the Service on behalf of the Company, to perform services related to the Service or to assist the Company in analyzing how the Service is used.</p>
                        </li>
                        <li>
                            <p><strong class="policystrong">Usage Data</strong> refers to data collected automatically, either generated by the use of the Service or from the Service infrastructure itself (for example, the duration of a page visit).</p>
                        </li>
                        <li>
                            <p><strong class="policystrong">You</strong> means the individual accessing or using the Service, or the company, or other legal entity on behalf of which such individual is accessing or using the Service, as applicable.</p>
                        </li>
                    </ul>
                </div>
                <h1>Collecting and Using Your Personal Data</h1>
                <div class="policysection">
                    <h2 style="color: var(--color-white);">Types of Data Collected</h2>
                    <h3>Personal Data</h3>
                    <p>While using Our Service, We may ask You to provide Us with certain personally identifiable information that can be used to contact or identify You. Personally identifiable information may include, but is not limited to: Email & Usage Data</p>

                    <h3>Usage Data</h3>
                    <p>Usage Data is collected automatically when using the Service.</p>
                    <p>Usage Data may include information such as Your Device's Internet Protocol address (e.g. IP address), browser type, browser version, the pages of our Service that You visit, the time and date of Your visit, the time spent on those pages, unique device identifiers and other diagnostic data.</p>
                    <p>When You access the Service by or through a mobile device, We may collect certain information automatically, including, but not limited to, the type of mobile device You use, Your mobile device unique ID, the IP address of Your mobile device, Your mobile operating system, the type of mobile Internet browser You use, unique device identifiers and other diagnostic data.</p>
                    <p>We may also collect information that Your browser sends whenever You visit our Service or when You access the Service by or through a mobile device.</p>
                </div>
                <div class="policysection">
                    <h2>Use of Your Personal Data</h2>
                    <p style="text-align: center">The Company may use Personal Data for the following purposes:</p>
                    <ul>
                        <li>
                            <p><strong class="policystrong">To provide and maintain our Service</strong>, including to monitor the usage of our Service.</p>
                        </li>
                        <li>
                            <p><strong class="policystrong">To manage Your Account:</strong> to manage Your registration as a user of the Service. The Personal Data You provide can give You access to different functionalities of the Service that are available to You as a registered user.</p>
                        </li>
                        <li>
                            <p><strong class="policystrong">To contact You:</strong> To contact You by email, telephone calls, SMS, or other equivalent forms of electronic communication, such as a mobile application's push notifications regarding updates or informative communications related to the functionalities, products or contracted services, including the security updates, when necessary or reasonable for their implementation.</p>
                        </li>
                        <li>
                            <p><strong class="policystrong">To manage Your requests:</strong> To attend and manage Your requests to Us.</p>
                        </li>
                    </ul>
                </div>

                <div class="policysection">
                    <h2>Retention of Your Personal Data</h2>
                    <p>The Company will retain Your Personal Data only for as long as is necessary for the purposes set out in this Privacy Policy. We will retain and use Your Personal Data to the extent necessary to comply with our legal obligations (for example, if we are required to retain your data to comply with applicable laws), resolve disputes, and enforce our legal agreements and policies.</p>
                    <p>The Company will also retain Usage Data for internal analysis purposes. Usage Data is generally retained for a shorter period of time, except when this data is used to strengthen the security or to improve the functionality of Our Service, or We are legally obligated to retain this data for longer time periods.</p>
                    <h2>Transfer of Your Personal Data</h2>
                    <p>Your information, including Personal Data, is processed at the Company's operating offices and in any other places where the parties involved in the processing are located. It means that this information may be transferred to — and maintained on — computers located outside of Your state, province, country or other governmental jurisdiction where the data protection laws may differ than those from Your jurisdiction.</p>
                    <p>Your consent to this Privacy Policy followed by Your submission of such information represents Your agreement to that transfer.</p>
                    <p>The Company will take all steps reasonably necessary to ensure that Your data is treated securely and in accordance with this Privacy Policy and no transfer of Your Personal Data will take place to an organization or a country unless there are adequate controls in place including the security of Your data and other personal information.</p>
                    <h2>Disclosure of Your Personal Data</h2>
                    <h3>Law enforcement</h3>
                    <p>Under certain circumstances, the Company may be required to disclose Your Personal Data if required to do so by law or in response to valid requests by public authorities (e.g. a court or a government agency).</p>
                    <h3>Other legal requirements</h3>
                    <p style="text-align: center;">The Company may disclose Your Personal Data in the good faith belief that such action is necessary to:</p>
                    <ul>
                        <li>Comply with a legal obligation</li>
                        <li>Protect and defend the rights or property of the Company</li>
                        <li>Prevent or investigate possible wrongdoing in connection with the Service</li>
                        <li>Protect the personal safety of Users of the Service or the public</li>
                        <li>Protect against legal liability</li>
                    </ul>
                    <h2>Security of Your Personal Data</h2>
                    <p>The security of Your Personal Data is important to Us, but remember that no method of transmission over the Internet, or method of electronic storage is 100% secure. While We strive to use commercially acceptable means to protect Your Personal Data, We cannot guarantee its absolute security.</p>
                    <h1>Children's Privacy</h1>
                    <p>Our Service does not address anyone under the age of 13. We do not knowingly collect personally identifiable information from anyone under the age of 13. If You are a parent or guardian and You are aware that Your child has provided Us with Personal Data, please contact Us. If We become aware that We have collected Personal Data from anyone under the age of 13 without verification of parental consent, We take steps to remove that information from Our servers.</p>
                    <p>If We need to rely on consent as a legal basis for processing Your information and Your country requires consent from a parent, We may require Your parent's consent before We collect and use that information.</p>
                    <h1>Links to Other Websites</h1>
                    <p>Our Service may contain links to other websites that are not operated by Us. If You click on a third party link, You will be directed to that third party's site. We strongly advise You to review the Privacy Policy of every site You visit.</p>
                    <p>We have no control over and assume no responsibility for the content, privacy policies or practices of any third party sites or services.</p>
                    <h1>Changes to this Privacy Policy</h1>
                    <p>We may update Our Privacy Policy from time to time. We will notify You of any changes by posting the new Privacy Policy on this page.</p>
                    <p>We will let You know via email and/or a prominent notice on Our Service, prior to the change becoming effective and update the &quot;Last updated&quot; date at the top of this Privacy Policy.</p>
                    <p>You are advised to review this Privacy Policy periodically for any changes. Changes to this Privacy Policy are effective when they are posted on this page.</p>
                    <p style="text-align: center">We may never share Your personal information</p>
                </div>
            </div>




            <div class="about policy mqr">
                <h1 class="noselect">Cookie Policy</h1>

                <div class="policysection">
                    <h4 class="noselect"><strong>What Are Cookies</strong></h4>

                    <p>As is common practice with almost all professional websites this site uses cookies, which are tiny files that are downloaded to your computer, to improve your experience. This page describes what information they gather, how we use it and why we sometimes need to store these cookies. We will also share how you can prevent these cookies from being stored however this may downgrade or 'break' certain elements of the sites functionality.</p>
                </div>

                <div class="policysection">
                    <h4 class="noselect"><strong>How We Use Cookies</strong></h4>

                    <p>We use cookies for a variety of reasons detailed below. Unfortunately in most cases there are no industry standard options for disabling cookies without completely disabling the functionality and features they add to this site. It is recommended that you leave on all cookies if you are not sure whether you need them or not in case they are used to provide a service that you use.</p>
                </div>

                <div class="policysection">
                    <h4 class="noselect"><strong>Disabling Cookies</strong></h4>

                    <p>You can prevent the setting of cookies by adjusting the settings on your browser (see your browser Help for how to do this). Be aware that disabling cookies will affect the functionality of this and many other websites that you visit. Disabling cookies will usually result in also disabling certain functionality and features of the this site. Therefore it is recommended that you do not disable cookies.</p>
                </div>

                <h1 class="noselect"><strong>The Cookies We Set</strong></h1>

                <div class="policysection">
                    <h4 class="noselect">Login related cookies</h4>
                    <p>We use cookies when you are logged in so that we can remember this fact. This prevents you from having to log in every single time you visit a new page. These cookies are typically removed or cleared when you log out to ensure that you can only access restricted features and areas when logged in.</p>
                </div>

                <div class="policysection">
                    <h4 class="noselect"><strong>Third Party Cookies</strong></h4>

                    <p>In some special cases we also use cookies provided by trusted third parties. The following section details which third party cookies you might encounter through this site.</p>

                    <p>From time to time we test new features and make subtle changes to the way that the site is delivered. When we are still testing new features these cookies may be used to ensure that you receive a consistent experience whilst on the site whilst ensuring we understand which optimisations our users appreciate the most.</p>
                </div>

                <div class="policysection">
                    <h4 class="noselect"><strong>More Information</strong></h4>

                    <p>Hopefully that has clarified things for you and as was previously mentioned if there is something that you aren't sure whether you need or not it's usually safer to leave cookies enabled in case it does interact with one of the features you use on our site.</p>

                    <p>However if you are still looking for more information then you can contact us through one of our preferred contact methods:</p>
                    <p class="noselect"><a href="mailto:alexmofu.dev@gmail.com">Contact email: Alexmofu.dev@gmail.com</a></p>
                    <p class="noselect"><a href="./support.php">Support Form</a></p>
                </div>


            </div>




        </div> <!-- // Main Landing -->
    </div>
    </div>
    <!-- JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="./js/main.js"></script>
</body>

</html>